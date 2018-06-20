<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

class ContactsController extends Controller
{
    public function index() {
        return view('contacts');
    }

    public function send(Request $request) {
        $data = array(
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,

        );
        Mail::send(new ContactForm($data));
        return view('home');
    }
}
