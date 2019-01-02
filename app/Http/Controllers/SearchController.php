<?php

namespace App\Http\Controllers;

use App\User;
use App\Ad;
use App\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        //dd($request->only(['q']));

        $input = $request->only(['q']);

        $q = $input['q'];

        $results['q'] = $q;
        $results['users']=[];
        $results['ads']=[];
        $results['categories']=[];

        $user = User::where ( 'firstname', 'LIKE', '%' . $q . '%' )
            ->orWhere( 'middlename', 'LIKE', '%' . $q . '%' )
            ->orWhere( 'lastname', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'email', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'phone', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'mobile', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'street', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'area', 'LIKE', '%' . $q . '%' )
            ->orWhere ( 'city', 'LIKE', '%' . $q . '%' )
            ->get ();

        if (count ( $user ) > 0)
            $results['users']=$user;
     
            

        $ad = Ad::where ( 'title', 'LIKE', '%' . $q . '%' )
            ->orWhere( 'description', 'LIKE', '%' . $q . '%' )
            
            ->get ();

            if (count ( $ad ) > 0)
                $results['ads']=$ad;

        $category = Category::where ( 'name', 'LIKE', '%' . $q . '%' )
                ->orWhere( 'description', 'LIKE', '%' . $q . '%' )
                
                ->get ();
        if (count ( $category ) > 0)
            $results['categories'] = $category;  

            
        return view ( 'search.index', compact('results'));

        }
}
