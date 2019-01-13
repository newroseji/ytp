<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        $users = User::all();

        return view('admin.users',compact('users'));
    }

    public function create(){

        //dd('user create');
        return view('user.create'); 
    }

    public function store(Request $request)
    {

       
        $request->validate([

            'firstname' => ['required', 'string', 'max:255'],
            
            'lastname' => ['required', 'string', 'max:255'],
            'mobile' => ['required'],
            'street' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);

        


        $input = request()->only([
            'firstname',
            'middlename',
            'lastname',
            'email',
            'mobile',
            'home',
            'street',
            'area',
            'city',
            'password'
            ]);
        
        $input['password'] = bcrypt($input['password']);
        $input['email_verified_at'] = date('Y-m-d h:i:s');

        //\Log::info($input);

        $ad = new User();
        $new_user=$ad->create($input);

        //\Log::info($new_user);

        DB::table('users')->where('id',$new_user->id)->update(['email_verified_at'=>now()]);
      

        return redirect()->route('users.show', ['id' => $new_user->id])->with('status', $input['firstname'] . " created!");


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
        //\Log::info($id);
        
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

        //\Log::info($input);

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

        $user = User::find($id);

        $user->deleted=1;
        $user->active=0;
        $user->save();

        return back()->with('status',"'$user->firstname' deleted!");

    }
}
