<?php

namespace App\Http\Controllers\api;

use App\Events\HelpEvent;
use App\Http\Controllers\Controller;
use App\Notifications\HelpNotification;
use App\User;
use Illuminate\Http\Request;
use Notification;
use OneSignal;

class HelpController extends Controller
{
//    public function help(Request $request){
//
//        try {
//            $user=User::all();
//            event(new  HelpEvent( Notification::send($user ,new HelpNotification($request))));
//            return response()->json([
//                'code' => '1',
//                'status' => 'success',
//                'data' => 'تم ارسال طلب المساعده',
//
//            ], 201);
//        } catch (\Exception $exception) {
//            return response()->json([
//                'code' => '0',
//                'status' => 'failed',
//                'data' => ['message' => $exception->getMessage()],
//
//            ], 500);
//        }
//    }
//    public function help(Request $request){
//
//        OneSignal::sendNotificationToAll(
//             $request,
//            $url = null,
//            $data = null,
//            $buttons = null,
//            $schedule = null
//        );
//    }
    public function help(Request $request)
    {
        $user=User::all();
          Notification::send($user ,new HelpNotification($request));
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array
        (
            'to' => '/topics/682', // Mobile developer should register to this suscribe to /tobics/682 eg:  FirebaseMessaging.getInstance().subscribeToTopic("682");
            'notification' => array("body" => 'ارجو المساعده', "title" => "جورناليستا",)
        );
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=' . "AAAAGQIx4lQ:APA91bGhr9saRvX9J5gS6fVm4N2tZN7-nsmoPsVKwsDz_zFlfnzueAxQTgcTYnFkVRLIhce0lPcgYu4VEFfHjOVbt9i-E4Bn0q_BhnYCghNUZrxb9QhdcFr8xyJoOr2FiN0z952hDfvG",
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function notifications(Request $request){

        try {
            $user=auth()->user();
            $data=[];
           foreach ($user->notifications as $not) {
               $notification=$not->data;
               $notification['user']=User::select('name','email','image','phone_number','card_number')->findOrfail($not->data['user_id']);
                  array_push($data,$notification);
           }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,

            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
}
