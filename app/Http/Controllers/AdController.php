<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::where(['deleted'=>0,'active'=>1])
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

            'price' => 'required|numeric'

        ], [

            'title.required' => 'Title is required',
            'title.unique' => 'Title already exists',

            'description.required' => 'Description is required',
            
            'price.required' => 'Price is required',

        ]);


        $input = request()->only(['title','description','price','category_id']);

        

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


        $input = request()->only(['active','title','description','price','category_id','user_id']);

        

        //$input['user_id'] = \Auth::user()->id;

        //\Log::info($input);

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

        /* Hard delete
        $ad->delete();
        */

        /* Soft delete */
        $ad->deleted=1;
        $ad->save();


        return back()->with('status',"'$ad->title' deleted!");
    }
}
