<?php

namespace App\Http\Controllers\Admin\Old;

use App\Http\Controllers\Controller;
use App\Models\Old\History;
use App\Services\MailService;
use entimm\LaravelPerfectMoney\PerfectMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Laracasts\Flash\Flash;
use entimm\LaravelPerfectMoney\PerfectMoneyException;

class PaymentsController extends Controller
{
    public function withdrawList()
    {
        $balance = Cache::remember('perfectmoney.balance', 10, function () {
            try {
                $res = (new PerfectMoney)->getBalance();
                $balance = '$ ' . $res[config('perfectmoney.marchant_id')];
            } catch (PerfectMoneyException $e) {
                $balance = '-- (' . $e->getMessage() . ')';
            } catch (\Exception $e) {
                $balance = '-- (unknown error)' . $e->getMessage();
            }
            return $balance;
        });

        $pendings = History::where('type', 'withdraw_pending')->get();
        return view('payments.withdraw_list', compact('pendings', 'balance'));
    }

    public function withdrawProcess(Request $request)
    {
        $pendingIds = $request->get('pendingIds');
        $pendings = History::whereIn('id', $pendingIds ?: [])
            ->where('type', 'withdraw_pending')
            ->where('ec', config('hm.ec_id'))
            ->get();
        $successNum = 0;
        foreach ($pendings as $pending) {
            if (!$pending->user->perfectmoney_account) continue;
            $description = 'withdrawal from ' . config('app.name');
            $payment_id = $pending->id . '-' . time();
            try {
                $res = (new PerfectMoney)->sendMoney($pending->user->perfectmoney_account, abs($pending->amount), $description, $payment_id);
                $pending->payment_batch_num = $res['payment_batch_num'];
            } catch (PerfectMoneyException $e) {
                Flash::error('error happened: ' . $e->getMessage());
                return redirect('/old/withdraw/pendings');
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
        Cache::forget('perfectmoney.balance');
        return redirect('/old/withdraw/pendings');
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

            $mailData = [
                'name' => $pending->user->name,
                'amount' => abs($pending->amount),
                'batch' => $pending->payment_batch_num,
                'account' => $pending->user->perfectmoney_account,
                'currency' => 'PerfectMoney',
            ];
            MailService::templateSend($pending->user, 'withdraw_user_notification', $mailData);
        });
    }
}
