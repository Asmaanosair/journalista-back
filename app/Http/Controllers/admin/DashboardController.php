<?php

namespace App\Http\Controllers\admin;

use App\Application_job;
use App\Article;
use App\Http\Controllers\Controller;
use App\Job;
use App\NewsLink;
use App\Organization;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');

    }
    function index(){
        return view('main');
    }
    function AllData(){
       $users=User::all()->where('role',1)->count();
       $organizations = Organization::all()->count();
       $articles= Article::all()->count();
       $news = NewsLink::all()->count();
       $jobs = Job::all()->count();
       $job_applications= Application_job::all()->count();
       return response()->json([
          'users'=> $users,
          'organizations'=>$organizations,
          'articles'=>$articles,
          'news'=>$news,
          'jobs'=>$jobs,
          'job_applications'=>$job_applications
           ]);
    }
}
