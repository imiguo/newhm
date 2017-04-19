<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MailService;

class TestController extends Controller
{
    public function index()
    {
        dd(env('APP_ENV'));
    }

    public function mail()
    {
        MailService::templateSend((object)['name' => 'tester', 'email' => '1194316669@qq.com'], 'withdraw_user_notification', [
            'name' => 'tester',
            'amount' => '0',
            'batch' => '888888',
            'account' => 'u1888888',
            'currency' => 'PerfectMoney',
        ]);
        return 'ok';
    }
}
