<?php

namespace App\Http\Controllers\admin;

use App\Application_job;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(){
        return view('main');
    }
    public function ShowAll(){
        $data=DB::table('application_jobs')
                ->join('jobs', 'jobs.id', '=', 'application_jobs.job_id')
                ->join('users', 'users.id', '=', 'application_jobs.user_id')
                ->select('application_jobs.*', 'jobs.name')
                ->get();
          //  Application_job::all();
        return response()->json($data);
    }

    public function edit($id)
    {
        $orders=Application_job::find($id);
        return response()->json($orders);
    }
    public function show($id)
    {
        $orders=User::find($id);
        return response()->json($orders);
    }
    public function update(Request $request, $id)
    {
        $orders =Application_job::find($id);
        $orders->status= $request->status;
        $orders->save();
        return response()->json($orders);
    }


}
