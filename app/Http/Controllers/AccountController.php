<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class AccountController extends Controller
{
    public function summary()
    {
        return view('front.account.summary');
    }

    public function edit()
    {
        return view('front.account.edit');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|max:60',
            'password' => 'nullable|min:6|confirmed',
            'perfectmoney' => 'max:30',
        ]);
        auth()->user()->fill(array_filter($request->only('full_name', 'password', 'perfectmoney')))->save();
        Flash::success('Your account data has been updated successfully.');
        return redirect()->back();
    }

    public function referrals()
    {
        return view('front.account.referrals');
    }

    public function link()
    {
        return view('front.account.link');
    }
}