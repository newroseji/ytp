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

    public function profile(){

        return view('user.profile');
    }

    public function mail()
    {
        
        $name = 'Niraj Byanjankar';
        Mail::to('newroseji@hotmail.com.com')->send(new TestSchMail($name));
        
        return redirect('profile')->with('status', 'Email sent!');;   
       
    }
}
