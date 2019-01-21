<?php

namespace App\Http\Controllers;

use App\Ad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => ['index','create','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::where(['deleted'=>0])
        ->where('expires','>=',now())
        ->orderBy('updated_at','desc')
        ->orderBy('created_at','desc')
        ->paginate(10);

        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required|string|unique:ads',

            'description' => 'required|string',
            'category_id' => 'required',

            'price' => 'required|numeric',

            'expires' => 'required|date|after_or_equal:publish',
            'publish' => 'required|date',

        ], [

            'title.required' => 'Title is required',
            'title.unique' => 'Title already exists',

            'description.required' => 'Description is required',
            
            'price.required' => 'Price is required',

        ]);


        $input = request()->only(['title','description','price','category_id','publish','expires']);

        $input['publish'] = Carbon::parse($input['publish']);
        $input['expires'] = Carbon::parse($input['expires']);

        

        $input['user_id'] = \Auth::user()->id;

        //\Log::info($input);

        $ad = new Ad();
        $new_ad=$ad->create($input);
        //\Log::info($new_ad);

        return redirect()->route('ads.show', ['id' => $new_ad->id])->with('status', $input['title'] . " created!");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::find($id);
        return view('ads.show',compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ad::find($id);
        return view('ads.edit',compact('ad'));
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
        //dump($request);
        $request->validate([

            'title' => 'required|string',
            'user_id' => 'required',
            'description' => 'required|string',
            'category_id' => 'required',

            'price' => 'required|numeric'

        ], [

            'title.required' => 'Title is required',
            'title.unique' => 'Title already exists',

            'description.required' => 'Description is required',
            
            'price.required' => 'Price is required',

        ]);


        $input = request()->only(['title','description','price','category_id','user_id','publish','expires']);

        

        //$input['user_id'] = \Auth::user()->id;

        //\Log::info($input);

        $input['publish'] = Carbon::parse($input['publish']);
        $input['expires'] = Carbon::parse($input['expires']);

        $ad = Ad::updateOrCreate(['id'=>$id],$input);
        $ad->save($input);

        return redirect()->route('ads.show', ['id' => $ad->id])->with('status', "'$ad->title' updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);

        $delete=false;

        if($ad->deleted){
            $ad->deleted=0;
            $delete=false;
        }
        else{
            $ad->deleted=1;
            $delete=true;
        }

        /* Hard delete
        $ad->delete();
        */

        /* Soft delete */
        
        $ad->updated_at=now();
        $ad->save();


        return back()->with(
            ['status'=>"Ad '$ad->title' " . ($delete ? ' deleted!' : ' restored!'),'type'=>($delete ? 'error' : 'success')]
        );
    }
}
