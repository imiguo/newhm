<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Illuminate\Support\Facades\Cache;
use Facades\entimm\LaravelPerfectMoney\PerfectMoney;
use entimm\LaravelPerfectMoney\PerfectMoneyException;

class PendingWithdrawsController extends Controller
{
    public function index()
    {
        $balance = Cache::remember('perfect_money.balance', 10, function () {
            try {
                $res = PerfectMoney::getBalance();
                $balance = '$ ' . $res['balance']['balance'];
            } catch (PerfectMoneyException $e) {
                $balance = '-- (' . $e->getMessage() . ')';
            } catch (\Exception $e) {
                $balance = '-- (unknown error)';
            }
            return $balance;
        });

        $pendings = History::where('type', 'withdraw_pending')->get();
        return view('pending_withdraws.index', compact('pendings', 'balance'));
    }

    public function process(Request $request)
    {
        $pendingIds = $request->get('pendingIds');
        $pendings = History::whereIn('id', $pendingIds ?: [])
            ->where('type', 'withdraw_pending')
            ->where('ec', config('hm.ec_id'))
            ->get();
        $successNum = 0;
        foreach ($pendings as $pending) {
            if (!$pending->investor->perfectmoney_account) continue;
            $description = 'withdrawal from ' . config('app.name');
            $payment_id = $pending->id . '-' . time();
            try {
                $res = PerfectMoney::sendMoney($pending->investor->perfectmoney_account, abs($pending->amount), $description, $payment_id);
                $pending->payment_batch_num = $res['payment_batch_num'];
            } catch (PerfectMoneyException $e) {
                Flash::error('error happened: ' . $e->getMessage());
                return redirect('/withdraw/pendings');
            }
            $this->withdrawResolved($pending, $successNum);
        }
        $failNum = count($pendings) - $successNum;
        if (! $failNum) {
            Flash::success('all process success!!!');
        } elseif (! $successNum)  {
            Flash::error('all process fail!!!');
        } else {
            Flash::info("$successNum process success,but $failNum process fail");
        }
        Cache::forget('perfect_money.balance');
        return redirect('/withdraw/pendings');
    }

    private function withdrawResolved($pending, &$successNum)
    {
        DB::transaction(function () use ($pending, &$successNum) {
            History::create([
                'user_id' => $pending->user_id,
                'amount' => $pending->amount,
                'actual_amount' => $pending->actual_amount,
                'type' => 'withdrawal',
                'date' => DB::raw('now()'),
                'description' => 'Withdrawal processed',
                'ec' => config('hm.ec_id'),
                'payment_batch_num' => $pending->payment_batch_num,
            ]);
            $pending->delete();
            $successNum++;
        });
    }
}
