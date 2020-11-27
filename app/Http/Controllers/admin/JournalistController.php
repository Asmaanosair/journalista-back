<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class JournalistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){
        return view('main');
    }
    /**
     * Display a listing of the Journalists.
     */
    public function showAll(){
        $users=User::all()->where('role',1);
        return response()->json($users);
    }
    public function ChangeStatus($id,$status)
    {
        $users = User::find($id);
        $users->status = $status;
        $users->save();
        if ($status == 2) {
            $message = ' تم الحظر';
            return response()->json($message);
        }
            $message = ' تم قبول الاضافه';
        return response()->json($message);

    }
    public function Delete($id)
    {
        $users = User::find($id);
        $users->delete();
    }
}
