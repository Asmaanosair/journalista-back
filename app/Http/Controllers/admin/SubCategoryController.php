<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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
        $categories=SubCategory::all();
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
        ]);
        $category = new SubCategory();
        $category->name= $request->name;
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
        $category=SubCategory::find($id);
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
        $category = SubCategory::find($id);
        $category->name = $request->name;
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
        $category = SubCategory::find($id);
        $category->delete();

    }
}
