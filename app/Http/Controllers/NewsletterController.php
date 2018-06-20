<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Newsletter\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        Newsletter::subscribe($request->email);

        return back();
    }
    public function unsubscribe(Request $request)
    {
        Newsletter::unsubscribe($request->email);

        return back();
    }
}
