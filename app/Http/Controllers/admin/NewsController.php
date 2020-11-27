<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\NewsLink;
use App\Organization;
use App\SubCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){
            $user=auth()->user();
            if($user->role==0){
                $news=NewsLink::all();
            }elseif($user->role==2){
                $organization_id=Organization::select('id')->where('user_id',$user->id)->first();
                $news=NewsLink::all()->where('organization_id',$organization_id->id);
            }else{
                return abort(403, 'Unauthorized action.');
            }

            $sub=SubCategory::all();
            return response()->json(compact('news','sub','user'));

    }
    /**
     * Display a listing of the categories.
     */
    public function showAll(){
        return view('main');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=auth()->user()->id;
        $organization_id=Organization::select('id')->where('user_id',$user)->first();
        $this->validate($request, [
            'title' => 'required',
            'simpleDescription' => 'required',
            'link' => 'required',
            'subCategoryId' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        $news = new NewsLink();
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='assets_admin/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $news->image=$path.$filName;
        }
        $news->simple_description= $request->simpleDescription;
        $news->title= $request->title;
        $news->news_link= $request->link;
        $news->sub_category_id= $request->subCategoryId;
        $news->organization_id=$organization_id->id;
        $news->save();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news=NewsLink::find($id);
        return response()->json($news);
    }
    public function showData($id)
    {
        $news=NewsLink::find($id);
        return response()->json($news);
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
            'title' => 'required',
            'simpleDescription' => 'required',
            'link' => 'required',
        ]);
        $news = NewsLink::find($id);
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='assets_admin/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $news->image=$path.$filName;
        }
        $news->simple_description= $request->simpleDescription;
        $news->title= $request->title;
        $news->news_link= $request->link;
        $news->sub_category_id= $request->subCategoryId;
        $news->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = NewsLink::find($id);
        $news->delete();

    }
    public function show($id)
    {
       return view('main');

    }
}
