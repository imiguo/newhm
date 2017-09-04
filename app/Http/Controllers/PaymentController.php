<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Plan;
use entimm\LaravelPerfectMoney\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaymentController
 *
 * @package \App\Http\Controllers
 */
class PaymentController extends Controller
{
    private $payments = [
        'perfectmoney' => 'Perfect Money',
    ];

    public function deposit()
    {
        $payments = $this->payments;
        $packages = Package::where('status', 1)->get();
        $memo = sprintf('Deposit to %s User %s', config('app.name'), auth()->user()->name);
        return view('front.payment.deposit', compact('memo', 'packages', 'payments'));
    }

    public function depositConfirm(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'package' => 'required|numeric',
            'payment' => 'required|string',
        ]);
        $amount = $request->get('amount');
        $packageId = $request->get('package');
        $plans = Plan::where('package_id', $packageId)->get();
        if ($amount < $plans->min('min')) {
            $amount = $plans->min('min');
        } elseif ($amount > $plans->max('max')) {
            $amount = $plans->max('max');
        }
        $payment = $this->payments[$request->get('payment')];
        $paymentAccount = Auth::user()->perfectmoney;
        return view('front.payment.deposit_confirm', compact('amount', 'payment', 'paymentAccount'));
    }

    public function withdraw()
    {
        return view('front.payment.withdraw');
    }

    public function withdrawProcess(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'msg' => 'required|string',
        ]);
        dd($request->all());
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
        if (Merchant::validatePayment($request)) {
            $amount = $request->input('PAYMENT_AMOUNT');
            $batchNum = $request->input('PAYMENT_BATCH_NUM');
            $payeer = $request->input('PAYER_ACCOUNT');
            return 'success';
        }
        return 'failure';
    }
}
