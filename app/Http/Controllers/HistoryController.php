<?php

namespace App\Http\Controllers;

use App\History;

class HistoryController extends Controller
{
    public function showDeposits()
    {
        $deposits = History::where('type', 'add_funds')->get();
        $total = 0;
        foreach ($deposits as $deposit) {
            $total += abs($deposit->amount);
        }
        return view('histories.deposits', compact('deposits', 'total'));
    }

    public function showWithdraws()
    {
        $withdraws = History::where('type', 'withdrawal')->get();
        $total = 0;
        foreach ($withdraws as $withdraw) {
            $total += abs($withdraw->amount);
        }
        return view('histories.withdraws', compact('withdraws', 'total'));
    }
}
