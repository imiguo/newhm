<?php

namespace App\Http\Controllers\Admin\Old;

use App\Http\Controllers\Controller;
use App\Models\Old\History;

class HistoryController extends Controller
{
    public function deposits()
    {
        $deposits = History::where('type', 'add_funds')->get();
        $total = 0;
        foreach ($deposits as $deposit) {
            $total += abs($deposit->amount);
        }
        return view('histories.deposits', compact('deposits', 'total'));
    }

    public function withdraws()
    {
        $withdraws = History::where('type', 'withdrawal')->get();
        $total = 0;
        foreach ($withdraws as $withdraw) {
            $total += abs($withdraw->amount);
        }
        return view('histories.withdraws', compact('withdraws', 'total'));
    }
}
