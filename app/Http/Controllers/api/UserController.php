<?php

namespace App\Http\Controllers\api;

use App\Events\UserRegister;
use App\Http\Controllers\Controller;
use App\SendCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use JWTAuth;
class UserController extends Controller
{
    //===================================== Start Register =================================
    //  when user registered and enter phone number i will send message to phone by Nexmo api
    // but should enter valid number like this -> 201008131721 with out plus

    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|numeric|unique:users',
            'card_number' => 'required|unique:users',
            'nationality' => 'required|string|max:191',
            'password' => 'required|string|min:8'

        ]);

        try {
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }

            // $code =  SendCode::sendCode($request->phone_number);
            $code =  '123456';
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'card_number' => $request->card_number,
                'nationality' => $request->nationality,
                'code' => $code,
                'role' => 1,
                'password' => Hash::make($request->password)

            ]);
            event(new  UserRegister($user));



            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }

    //===================================== Start Verification Code =================================
    // Check Code which user was entered it is the same in database or not
    // if yes  i will active it  and return code valid
    // if not will return error not code not valid

    public function verification($id, $code)
    {
        try {
            $user = User::findOrFail($id);
            if ($code !== $user->code) {
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => ['message' => 'Invalid Code'],

                ], 400);
            }
            $user->active = 1;
            $user->save();
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => compact('user', 'token'),

            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }


    //===================================== Start Creating Pin For User ===============================

    // When User enter pin code i will check value of pin in database
    // if it is Null or Not
    // if Null it is first time for user and save it in databse
    // if not Null will check the pin code is valid or not

    public function pin($id, $pin)
    {

        try {
            $user = User::find($id);
            if ($user->pin == Null) {
                $user->pin = $pin;
                $user->save();
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' => $user,

                ], 201);
            } else {
                $user = User::where([
                    'id' => $id,
                    'pin' => $pin
                ])->first();
                if (!$user) {
                    return response()->json([
                        'code' => '0',
                        'status' => 'Pin Code Invalid',
                        'data' => ['message' => 'The Pin Code Is Invalid'],

                    ], 401);
                } else {
                    $user = $user;
                    return response()->json([
                        'code' => '1',
                        'status' => 'Pin Code Valid',
                        'data' => $user,
                    ], 201);
                }
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }

    //===================================== Start Login User ====================================

    // login by check email and password is correct and active valu database is 1


    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }


            if (auth()->attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
               'active' => 1,
                'role' => 1,
            ])) {

                $user = auth()->user();
                $token = JWTAuth::fromUser($user);
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' => compact('token', 'user'),
                ], 201);
            } else {
                return response()->json([
                    'code' => '0',
                    'status' => 'The User Not Found',
                    'data' => ['message' => 'The User Not Found'],

                ], 401);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }


    //===================================== Start Get Profile For User ===============================


    public function getProfile()
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => 'User Not Found',

                ], 400);
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }



    //===================================== Start Edit Profile For User ===============================



    public function editProfile(Request $request)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => 'User Not Found',

                ], 400);
            }
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:191',
                'facebook' => 'required|string|max:255',
                'instagram' => 'required|string|max:255',
                'twitter' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone_number' => 'required|numeric',
                'card_number' => 'required',
                'nationality' => 'required|string|max:191',
            ]);

            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }
            if($request->image!=null)
            {
                $filName=time().".".$request->image->getClientOriginalExtension();
                $path='assets_admin/images/';
                $imagePath= $request->file('image')->move($path,$filName);
                $user->image=$path.$filName;
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'card_number' => $request->card_number,
                'nationality' => $request->nationality,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
            ]);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
    public  function getAllUsers(){
        try {
            $users=User::select('latitude','longitude','image','id','facebook','twitter','instagram')->where('role',1)->get();

            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $users,

            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
    public  function getLocation(Request $request){
        $validation = Validator::make($request->all(), [
            'lat' => 'required',
            'long' => 'required'
        ]);
        try {
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }
            $user = auth()->user();
            $user->latitude = $request->lat;
            $user->longitude = $request->long;
            $user->save();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

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
