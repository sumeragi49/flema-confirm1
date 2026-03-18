<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class MailSendController extends Controller
{
    public function index()
    {
        $data = [];

        Mail::send('auth.send-email', $data, function($message){
            $message->to('server987@example.com', 'Test')->subject('This is a test mail');
        });

        return view('auth.verify-email');
    }
}
