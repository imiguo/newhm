<?php

namespace App\Http\Controllers;

use App\History;
use App\Hub\PerfectMoney\PerfectMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $res = PerfectMoney::sendMoney($pending->user->perfectmoney_account, abs($pending->amount));
            if (isset($res['ERROR'])) {
                flash('error happened: ' . $res['ERROR'], 'danger');
            }
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
        return redirect('/withdraw/pendings');
    }
}
