<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class OrganizationController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(){
        return view('main');
    }
    /**
     * Display a listing of the Organization.
     */
    public function showAll(){
        $data=Organization::all();
         return response()->json($data);
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
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|numeric',
            'card_number' => 'required',
            'activity' => 'required',
            'nationality' => 'required|string|max:191',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->phone_number= $request->phone;
        $user->card_number= $request->card;
        $user->nationality= $request->nationality;
        $user->password=  Hash::make($request->password);
        $user->role = 2;
        if($user->save()){
            $organization=new Organization();
            $organization->name=$user->name;
            $organization->user_id=$user->id;
            $organization->activity=$request->activity;
            $organization->save();
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
        $data=Organization::with('user')->where('user_id',$id)->first();
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
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'card' => 'required',
            'nationality' => 'required|string|max:191',
        ]);
        $user = User::find($id);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->phone_number= $request->phone;
        $user->card_number= $request->card;
        $user->nationality= $request->nationality;
        if($user->save()){
            $organization=Organization::where('user_id',$user->id)->first();
            $organization->name=$user->name;
            $organization->activity=$request->activity;
            $organization->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = User::find($id);
        $organization->delete();

    }
}
