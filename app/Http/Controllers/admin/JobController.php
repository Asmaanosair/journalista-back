<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Job;
use App\Organization;
use Illuminate\Http\Request;

class JobController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(){
            $user=auth()->user();
          $data=Job::all();
        return response()->json(compact('user','data'));
    }
    public function show($id){
        $user=auth()->user();
        if($user->role==0){
            $data=Job::all()->where('organization_id',$id);
        }elseif($user->role==2){
            $organization_id=Organization::select('id')->where('user_id',$user->id)->first();
            $data=Job::all()->where('organization_id',$organization_id->id);
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
            'name' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'location' => 'required',
            'experience' => 'required',
            'salary' => 'required',

        ]);

        $job = new Job();
        $job->name= $request->name;
        $job->description= $request->description;
        $job->requirments= $request->requirements;
        $job->organization_id= $organization_id->id;
        $job->location= $request->location;
        $job->experience= $request->experience;
        $job->salary= $request->salary;
        $job->save();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Job::find($id);
        return response()->json($data);
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
            'name' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'location' => 'required',
            'experience' => 'required',
            'salary' => 'required',

        ]);

        $job = Job::find($id);
        $job->name= $request->name;
        $job->description= $request->description;
        $job->requirments= $request->requirements;
        $job->location= $request->location;
        $job->experience= $request->experience;
        $job->salary= $request->salary;
        $job->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Job::find($id);
        $article->delete();

    }
}
