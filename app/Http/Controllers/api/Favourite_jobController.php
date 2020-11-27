<?php

namespace App\Http\Controllers\api;

use App\Favourite_job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Favourite_jobController extends Controller
{
    public function store($job_id)
    {
        try {
            $user_id = auth('api')->user()->id;

            $favourite = Favourite_job::where([
                'user_id' => $user_id,
                '$job_id' => $job_id
            ]);

            if ($favourite->get()->count() == 0) {

                Favourite_job::create([
                    'user_id' => $user_id,
                    'job_id' => $job_id
                ]);
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => 'added to favourite'

                ], 201);
            } else {
                $favourite->delete();
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => 'remove from favourite'

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
}
