<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        //$user = User::where(['id'=> \Auth::user()->id, 'deleted'=>0,'active'=>1])->orderBy('id','desc')->get();
        $user = User::find(\Auth::user()->id);
        \Log::info($user);

        $ads = $user->ads()->paginate(10);
        //dd($ads);
      
        return view('user.profile',compact('user','ads'));
    }

    public function edit($id){

        $user = User::find($id);

        return view('user.edit',compact('user'));

    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
      
        return view('user.show',compact('user'));
    }
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Log::info($id);
        
        $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',

            'phone' => 'nullable|string',
            'mobile' => 'required|string',
            'street' => 'required|string',
            'area' => 'required|string',
            'city' => 'required|string'
        ]);


        $input = request()->only(
            [
                'firstname',
                'middlename',
                'lastname',
                'phone',
                'mobile',
                'street',
                'area',
                'city'
            ]);

        \Log::info($input);

        $user = User::find($id);
        $user->updateOrCreate(['id'=>$id],$input);

        return back()->with('status','User profile updated!');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
