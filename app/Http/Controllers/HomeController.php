<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\User;
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
        $user = User::find(\Auth::user()->id);
        \Log::info($user);

        $ads = $user->ads()->paginate(10);

        return view('user.home',compact('user','ads'));
    }

    public function mail(Request $request)
    {
        $params = $request->only(['txt_email']);
        $name = $params['txt_email'];
        Mail::to('newroseji@hotmail.com.com')->send(new TestSchMail($name));

        return back()->with('status',"Email sent to $name!");
           
       
    }

    public function admin(){

        $categories = Category::where('deleted',0)->get();
        $users = User::where('deleted',0)->get();
       
        return view('admin.index',compact('categories','users'));
    }
}
