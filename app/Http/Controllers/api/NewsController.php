<?php

namespace App\Http\Controllers\api;

use App\Article;
use App\Http\Controllers\Controller;
use App\NewsLink;
use App\Post;
use App\SubCategory;
use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{
    public function allNews(){

        try {
//            $data=DB::table('posts')
//                ->join('sub_categories', 'sub_categories.id', '=', 'posts.sub_category_id')
//                ->join('categories', 'categories.id', '=', 'posts.category_id')
//                ->select('posts.rss_link', 'categories.category', 'sub_categories.name')
//                ->paginate(20);
            $posts=[];
            $data=SubCategory::paginate(10);
            foreach ($data as $row){
                $data=SubCategory::find($row->id);
                $post=$data->post;
                $article=$data->article;
                $news_link=$data->newsLink;
                array_push($posts,$data);
            }
            if(empty($data)){
                $data=[];
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $posts,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
    public function News(Request $request){

        try {
            $data=DB::table('posts')->where('sub_category_id',$request->subcategory_id)
                ->join('sub_categories', 'sub_categories.id', '=', 'posts.sub_category_id')
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->select('posts.rss_link', 'categories.category', 'sub_categories.name')
                ->paginate(20);


            if(empty($data)){
                $data=[];
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
    public function Articles(Request $request){

        try {

            $data=DB::table('articles')->where('sub_category_id',$request->subcategory_id)
                ->join('sub_categories', 'sub_categories.id', '=', 'articles.sub_category_id')
                ->select('articles.*', 'sub_categories.name')
                ->paginate(20);

            if(empty($data)){
                $data=[];
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
    public function NewsLink(Request $request){

        try {

            $data['newsLink']=DB::table('news_links')->where('sub_category_id',$request->subcategory_id)
                ->join('sub_categories', 'sub_categories.id', '=', 'news_links.sub_category_id')
                ->select('news_links.*', 'sub_categories.name')
                ->paginate(20);

            if(empty($data)){
                $data=[];
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
    public function Article($id){

        try {

            $data=Article::findOrFail($id);

            if(empty($data)){
                $data=[];
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
}
