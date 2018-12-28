<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function edit($id){

        $user = \App\User::find($id);

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
        $user = \App\User::find($id);

        $ads = $user->ads()->paginate(5);
        //dd($ads);
      
        return view('user.profile',compact('user','ads'));
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

        $user = \App\User::find($id);
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
