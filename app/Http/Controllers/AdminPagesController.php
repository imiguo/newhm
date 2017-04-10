<?php

namespace App\Http\Controllers;

use PerfectMoney;

class AdminPagesController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
