<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::where('deleted',0)->orderBy('updated_at','desc')->paginate(10);

        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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

            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $input = request()->only(['name','description']);
        
        $cat = new Category();
        $new_cat=$cat->create($input);
        \Log::info($new_cat);

        return redirect()->route('categories.show', ['id' => $new_cat->id])->with('status', $input['name'] . " created!");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
     
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([

            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $input = request()->only(['name','description']);
        
        $cat = Category::find($category->id);
        $cat->name = $input['name'];
        $cat->description = $input['description'];
        $cat->save();

        return back()->with('status','Category updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        \Log::info($category->id);
        $cat = Category::find($category->id);
        //$cat::updateOrCreate(['id'=>$id],$input);
        $cat->deleted=1;
        $cat->save();

        return back()->with('status',"'$cat->name' updated!");
    }
}
