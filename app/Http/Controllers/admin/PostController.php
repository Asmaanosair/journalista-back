<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\SubCategory;
use Illuminate\Http\Request;
use DB;

class PostController extends Controller
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
        $subCategories=SubCategory::all();
        $posts=DB::table('posts')
            ->join('sub_categories', 'sub_categories.id', '=', 'posts.sub_category_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.category', 'sub_categories.name')
            ->get();
        return response()->json(compact('posts','categories','subCategories'));
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
            'categoryId' => 'required',
            'subCategoryId' => 'required',
        ]);
        $post = new Post();
        $post->rss_link= $request->name;
        $post->category_id= $request->categoryId;
        $post->sub_category_id= $request->subCategoryId;
        $post->save();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts=Post::find($id);
        return response()->json($posts);
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
            'categoryId' => 'required',
            'subCategoryId' => 'required',
        ]);
        $post = Post::find($id);
        $post->rss_link= $request->name;
        $post->category_id= $request->categoryId;
        $post->sub_category_id= $request->subCategoryId;
        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

    }
}
