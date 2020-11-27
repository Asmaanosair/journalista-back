<?php

namespace App\Http\Controllers\admin;

use App\Events\HelpEvent;
use App\Http\Controllers\Controller;
use App\Notifications\HelpNotification;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(Request $request){

        try {
            $user=auth()->user();
            $data=[];
            foreach ($user->notifications->take(5) as $not) {
                $notification=$not->data;
                $notification['user']=User::select('name','email','image','phone_number','card_number')->findOrfail($not->data['user_id']);
                array_push($data,$notification);
            }
            event(new  HelpEvent($data));
            return response()->json($data);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
    public function all(Request $request){

        try {
            $user=auth()->user();
            $data=[];
            foreach ($user->notifications as $not) {
                $notification=$not->data;
                $notification['user']=User::select('name','email','image','phone_number','card_number')->findOrfail($not->data['user_id']);
                array_push($data,$notification);
            }
            event(new  HelpEvent($data));
            return response()->json($data);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
    public function delete(Request $request){

            $user=auth()->user();

           $user->notifications()->delete();

    }
    public function index(){
        return view('main');
    }
}
