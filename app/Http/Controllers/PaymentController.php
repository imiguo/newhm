<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use entimm\LaravelPerfectMoney\Facade\PerfectMoney;

/**
 * Class PaymentController
 *
 * @package \App\Http\Controllers
 */
class PaymentController extends Controller
{
    public function deposit()
    {
        $viewData = [
            'memo' => sprintf('Deposit to %s User %s', config('app.name'), auth()->user()->name),
        ];
        return view('front.payment.deposit', $viewData);
    }

    public function withdraw()
    {
        $viewData = [
            'memo' => sprintf('Deposit to %s User %s', config('app.name'), auth()->user()->name),
        ];
        return view('front.payment.withdraw', $viewData);
    }

    public function withdrawProcess(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
        ]);
    }

    public function success()
    {
        return view('front.payment.success');
    }

    public function failure()
    {
        return view('front.payment.failure');
    }

    public function callback(Request $request)
    {
        if (PerfectMoney::validatePayment($request)) {
            return 'success';
        }
        return 'failure';
    }
}