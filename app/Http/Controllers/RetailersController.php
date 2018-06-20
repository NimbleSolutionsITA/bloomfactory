<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RetailerRequest;

class RetailersController extends Controller
{

    public function index() {
        return view('retailers');
    }

    public function send(Request $request) {
        $data = array(
            'name'    => $request->name,
            'city'   => $request->city,
            'email'   => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,

        );
        Mail::send(new RetailerRequest($data));
        return view('home');
    }
}
