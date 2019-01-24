<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Ad;
use App\Advisit;
use App\AdsPhoto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;

class AdController extends Controller
{
    protected $photo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdsPhoto $photo)
    {

        $this->middleware(['auth', 'verified'], ['except' => ['index','create','show']]);
        $this->photo = $photo;
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
    public function store(AdRequest $request)
    {


        $input = request()->only(['title','description','price','category_id','publish','expires','image']);

        $input['publish'] = Carbon::parse($input['publish']);
        $input['expires'] = Carbon::parse($input['expires']);

        

        $input['user_id'] = \Auth::user()->id;

        //\Log::info($input);

        $ad = new Ad();


        $new_ad=$ad->create($input);

        /*
        foreach ($request->photos as $photo) {
            $filename = $photo->store('photos');
            
            AdsPhoto::create([
                'ad_id' => $new_ad->id,
                'filename' => $filename
            ]);
        }
        */

        if ( $this->resizeUploadPhotos($request,$new_ad->id)){
            \Log::info('Uploaded');
        }
        else{
            \Log::info('Failed');
            return false;
        }

        //\Log::info($new_ad);

        return redirect()->route('ads.show', ['id' => $new_ad->id])->with('status', $input['title'] . " created!");
    }

    private function resizeUploadPhotos(&$request,$new_ad_id){

    //check if image exist
        if ($request->hasFile('image')) {
            $images = $request->file('image');

            //setting flag for condition
            $org_img = $thm_img = true;

            $desti_original = storage_path('app/public') .  '/images/originals';
            $desti_thumbnail = storage_path('app/public') .  '/images/thumbnails';

            \Log::info($desti_original);

            // create new directory for uploading image if doesn't exist
            if( ! File::exists($desti_original . '/')) {
                $org_img = File::makeDirectory($desti_original, 0777, true);
            }
            if ( ! File::exists($desti_thumbnail . '/')) {
                $thm_img = File::makeDirectory($desti_thumbnail, 0777, true);
            }

            // loop through each image to save and upload
            foreach($images as $key => $image) {

                //create new instance of Photo class
                $newPhoto = new $this->photo;

                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                //path of image for upload
                $org_path = $desti_original . '/' . $filename;
                $thm_path = $desti_thumbnail . '/' . $filename;

                $newPhoto->image     = '/images/originals/' .  $filename;
                $newPhoto->thumbnail = '/images/thumbnails/' . $filename;
                $newPhoto->ad_id = $new_ad_id;

                //don't upload file when unable to save name to database
                if ( ! $newPhoto->save()) {
                    return false;
                }

                // upload image to server
                if (($org_img && $thm_img) == true) {
                 Image::make($image)->fit(900, 500, function ($constraint) {
                     $constraint->upsize();
                 })->save($org_path);
                 Image::make($image)->fit(270, 160, function ($constraint) {
                     $constraint->upsize();
                 })->save($thm_path);
             }
         }
     }

     return true;
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

        // Now, increase the ad visit
        $ad_visit = new Advisit;
        $ad_visit->ad_id=$id;
        $ad_visit->user_id = !empty(\Auth::user()->id) ? \Auth::user()->id : null;
        $ad_visit->save();


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

            'price' => 'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);


        $input = request()->only(['title','description','price','category_id','user_id','publish','expires','image']);
        \Log::info('reading 2');

        if ( $this->resizeUploadPhotos($request,$id)){
            \Log::info('Uploaded');
        }
        else{
            \Log::info('Failed');
            return false;
        }

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
