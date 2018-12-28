<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestSchMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function mail(Request $request)
    {
        $params = $request->only(['txt_email']);
        $name = $params['txt_email'];
        Mail::to('newroseji@hotmail.com.com')->send(new TestSchMail($name));

        return back()->with('status',"Email sent to $name!");
           
       
    }
}
