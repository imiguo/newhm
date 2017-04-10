<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use PerfectMoney;

class PendingWithdrawsController extends Controller
{
    public function index()
    {
        $pendings = History::where('type', 'withdraw_pending')->get();
        return view('pending_withdraws.index', compact('pendings'));
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
            $pm = new PerfectMoney;
            $description = 'withdrawal from ' . config('app.name');
            $payment_id = $pending->id . '-' . time();
            $res = $pm->sendMoney(abs($pending->amount), $pending->investor->perfectmoney_account, $description, $payment_id);
            $pending->payment_batch_num = $res['data']['payment_batch_num'];
            if ($res['status'] == 'error') {
                Flash::error('error happened: ' . $res['message']);
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
                'ec' => config('perfectmoney.ec_id'),
                'payment_batch_num' => $pending->payment_batch_num,
            ]);
            $pending->delete();
            $successNum++;
        });
    }
}
