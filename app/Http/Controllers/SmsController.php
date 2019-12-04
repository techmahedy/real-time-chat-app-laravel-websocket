<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function show()
    {
        return view('sms');
    }
    public function send(Request $request)
    {

        smsapi()->countryCode('+88')->sendMessage($request->mobile, "Message");
        \Session::flash('success', 'Message sent');

        return redirect()->back();
    }
}
