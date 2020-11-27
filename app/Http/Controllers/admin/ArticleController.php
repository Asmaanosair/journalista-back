<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Organization;
use App\SubCategory;
use App\Tag;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');

    }
    public function show($id){
        $user=auth()->user();
        if($user->role==0){
            $data=Article::all()->where('organization_id',$id);
        }elseif($user->role==2){
            $organization_id=Organization::select('id')->where('user_id',$user->id)->first();
            $data=Article::all()->where('organization_id',$organization_id->id);
        }else{
            return abort(403, 'Unauthorized action.');
        }
        return response()->json(compact('data','user'));

    }
    /**
     * Display a listing of the Organization.
     */
    public function showAll(){
        return view('main');
    }
    public function create(){
        $sub=SubCategory::all();
        return response()->json($sub);
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
            'title' => 'required',
            'tag' => 'required',
            'topic' => 'required',
            'simpleDescription' => 'required',
            'article' => 'required',
            'image' => 'required',
            'subCategoryId' => 'required',
        ]);

        $article = new Article();
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='assets_admin/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $article->image=$path.$filName;
        }
        $id=Auth::user()->organization->id;
        $article->title= $request->title;
        $article->sub_category_id= $request->subCategoryId;
        $article->organization_id= $id;
        $article->simple_description= $request->simpleDescription;
        $article->article= $request->article;
        if($article->save()){
            $topic=new Topic();
            $topic->article_id=$article->id;
            $topic->topic=$request->topic;
            $topic->save();
            $tag=new Tag();
            $tag->article_id=$article->id;
            $tag->tag=$request->tag;
            $tag->save();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Article::find($id);
        $sub=SubCategory::all();
        return response()->json(compact('data','sub'));
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
        $article = Article::find($id);
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='assets_admin/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $article->image=$path.$filName;
        }
        $article->title= $request->title;
        $article->sub_category_id= $request->subCategoryId;
        $article->simple_description= $request->simpleDescription;
        $article->article= $request->article;
        $article->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

    }
    public function article($id)
    {
        $article = Article::find($id);
        return response()->json($article);

    }
}
