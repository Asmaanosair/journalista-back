<?php

namespace App\Http\Controllers\api;

use App\Chat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{

//==================================== Start Get All Chat =======================================

    public function getAllChat()
    {

        try {
            $user_id = auth('api')->user()->id;
            $chats = Chat::where(function ($query) use ($user_id) {
                $query->where('user_id', '=', $user_id);
            })->orWhere(function ($query) use ($user_id) {
                $query->where('friend_id', '=', $user_id);
            })->get();

            if ($chats) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => $chats
                ], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
//==================================== Start Get Chat =======================================

    public function getChat($friend_id)
    {

        try {
            $user_id = auth('api')->user()->id;
            $chats = Chat::where(function ($query) use ($user_id, $friend_id) {
                $query->where('user_id', '=', $user_id)->where('friend_id', '=', $friend_id);
            })->orWhere(function ($query) use ($user_id, $friend_id) {
                $query->where('user_id', '=', $friend_id)->where('friend_id', '=', $user_id);
            })->get();


            if ($chats) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => $chats
                ], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }


//==================================== Start Send Chat =======================================

    public function sendChat(Request $request)
    {

        try {
            $user_id = auth('api')->user()->id;
            $chat = Chat::create([
                'user_id' => $user_id,
                'friend_id' => $request->friend_id,
                'message' => $request->chat
            ]);
            if ($chat) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => 'chat saved'
                ], 201);
            }
            return response()->json([
                'code' => '0',
                'status' => 'error',
                'error_message' => 'chat not saved'
            ], 400);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
}
