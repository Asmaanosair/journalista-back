<?php

namespace App\Http\Controllers\api;

use App\Article;
use App\Http\Controllers\Controller;
use App\NewsLink;
use App\Organization;
use App\Post;
use App\Tag;
use App\Topic;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function Organization(){

        try {
            $data=Organization::paginate(20);
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
    public function Tags(){

        try {
            $data=Tag::select('tag')->paginate(20);
        //    $allData=[];
          //  $data=Article::select('tags')->paginate(20);
//            foreach ($data as $row){
//                $tags=explode(',',$row->tags);
//                array_push($allData,$tags);
//                //$data['tags']=$tags;
//            }
//            $data['tags']=$allData;
//
//            if(empty($data)){
//                $data['tags']=[];
//            }


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
    public function Topics(){

        try {
            $data=Topic::select('topic')->paginate(20);
          //  $data=Article::select('topics')->paginate(20);
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
    public function search(Request $request){
        try {
////            $data=Article::where([
////                ['title', 'LIKE', '%' . $request->search . '%'],
////            ]);
//////            $data->Join('topics', 'topics.article_id', '=', 'articles.id')->where('topics.topic', 'LIKE', '%' . $request->topic . '%')
//////                ->select('articles.*')->get();
////                $data->join('topics', function($join) use ($request)
////            {
////                $join->on('articles.id', '=', 'topics.article_id')
////                    ->where(['topics.topic', 'LIKE', '%'.$request->topic.'%'])->get();
////                   // ->orWhere('users.lastname', 'LIKE', '%'.$search.'%');
////            });
//            $data['articles']=DB::table('articles')
//                ->join('topics', 'topics.article_id', '=', 'articles.id')
//                ->join('tags', 'tags.article_id', '=', 'articles.id')
//                ->Where('articles.title', 'LIKE', '%' . $request->search . '%')
////                ->orWhere('topics.topic', 'LIKE', '%' . $request->topic . '%')
////                ->orWhere('tags.tag', 'LIKE', '%' . $request->tag . '%')
////                ->orWhere('articles.organization_id', 'LIKE', '%' . $request->organization_id . '%')
//                ->select('articles.*')
//                ->get();

//            if ($request->has('search')) {
//                $article->where('title', 'LIKE', '%' . $request->search . '%');
//            }
            $article=Article::where('title', 'LIKE', '%' . $request->search . '%');
            $news=NewsLink::where('title', 'LIKE', '%' . $request->search . '%');
            $rss=Post::where('rss_link', 'LIKE', '%' . $request->search . '%');
            if ($request->has('organization_id')) {
                $article->where('organization_id', $request->organization_id) ;
                $news->where('organization_id', $request->organization_id) ;
            }
                if ($request->has('topic')) {
                   $article->whereHas('topics', function ($query) use ($request) {
                        $query->whereIn('topics.topic',  [$request->topic ]);
                    });
                }
            if ($request->has('tags')) {
                $article->whereHas('tags', function ($query) use ($request) {
                    $query->whereIn('tags.tag',[$request->tag]);
                });
            }



            $data['article']=$article->get();
            $data['news']=$news->get();
            $data['rss']=$rss->get();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>$data
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
