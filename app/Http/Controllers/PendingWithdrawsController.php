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
        foreach ($pendings as $pending) {
            if (!$pending->investor->perfectmoney_account) continue;
            $res = PerfectMoney::sendMoney($pending->investor->perfectmoney_account, abs($pending->amount));
            if ($res && !isset($res['ERROR'])) {
                DB::transaction(function () use ($pending) {
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
                });
            }
        }
        if (isset($res['ERROR'])) {
            Flash::error('error happened: ' . $res['ERROR']);
        } else {
            Flash::success('procoss withdraw pending success!!!');
        }
        return redirect('/withdraw/pendings');
    }
}
