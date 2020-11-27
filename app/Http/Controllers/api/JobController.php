<?php

namespace App\Http\Controllers\api;

use App\Application_job;
use App\Http\Controllers\Controller;
use App\Job;
use App\Job_application;
use Illuminate\Http\Request;

class JobController extends Controller
{



    public function index()
    {
        try {
            $jobs = Job::paginate(10);
            if ($jobs) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => $jobs,

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



    public function show($id)
    {
        try {
            $job = Job::find($id);
            if ($job) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => $job
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



    public function applyJob($job_id)
    {
        try {
            $user_id = auth('api')->user()->id;
            $job_app = Application_job::created([
                'user_id', $user_id,
                'job_id' => $job_id
            ]);
            if ($job_app) {

                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => 'Succefully Sent Your Application '
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
