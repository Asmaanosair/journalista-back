<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){
        return view('main');
    }
    /**
     * Display a listing of the categories.
     */
    public function showAll(){
        $categories=Category::all();
        return response()->json($categories);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        $category = new Category();
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='assets_admin/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $category->image=$path.$filName;
        }
        $category->category= $request->name;
        $category->save();
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return response()->json([$category]);
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
        $this->validate($request, [
            'name' => 'required|string|max:255',

        ]);
        $category = Category::find($id);
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='assets_admin/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $category->image=$path.$filName;
        }
        $category->category = $request->name;
        $category->save();
        return response()->json(compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

    }
}
