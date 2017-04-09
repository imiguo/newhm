<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequest;
use App\Support;
use Flash;

class SupportsController extends Controller
{
    public function create()
    {
        return view('front.support');
    }

    public function store(SupportRequest $request)
    {
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $data['name'] = '';
            $data['email'] = '';
        } else {
            $data['name'] = $request->get('name');
            $data['email'] = $request->get('name');
        }
        Support::create($data);
        Flash::success('Message has been successfully sent. We will back to you in next 24 hours. Thank you.');
        return redirect('/support');
    }
}
