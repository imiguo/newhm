<?php

namespace App\Http\Controllers;

use App\History;
use App\Hub\PerfectMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;

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
            ->where('ec', config('perfectmoney.ec_id'))
            ->get();
        $successNum = 0;
        foreach ($pendings as $pending) {
            if (!$pending->investor->perfectmoney_account) continue;
            $res = PerfectMoney::sendMoney($pending->investor->perfectmoney_account, abs($pending->amount));
            if (isset($res['ERROR'])) {
                Flash::error('error happened: ' . $res['ERROR']);
                return redirect('/withdraw/pendings');
            }
            if ($res && !isset($res['ERROR'])) {
                DB::transaction(function () use ($pending, &$successNum) {
                    History::create([
                        'user_id' => $pending->user_id,
                        'amount' => $pending->amount,
                        'actual_amount' => $pending->actual_amount,
                        'type' => 'withdrawal',
                        'date' => DB::raw('now()'),
                        'description' => 'Withdrawal processed',
                        'ec' => config('perfectmoney.ec_id'),
                    ]);
                    $pending->delete();
                    $successNum++;
                });
            }
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
}
