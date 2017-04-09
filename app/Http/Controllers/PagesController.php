<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        return view('front.index');
    }

    public function rules()
    {
        return view('front.rules');
    }

    public function faq()
    {
        return view('front.faq');
    }

    public function aboutus()
    {
        return view('front.aboutus');
    }

    public function howtoinvest()
    {
        return view('front.howtoinvest');
    }
}
