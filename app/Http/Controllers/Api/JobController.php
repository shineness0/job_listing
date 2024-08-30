<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

 public function index() {
        $Jobs = Job::get();

        if($Jobs->count() > 0) {
            return JobResource::collection($Jobs);
        } else {
            return Response::json(['message' => 'No job available'], 200);
        }
    }

public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'type' => 'required|string',
        'location' => 'required',
        'description' => 'required',
        'salary'=> 'required',
        'company_name' => 'required',
        'company_description' => 'required',
        'company_email' => 'required',
        'company_phone' => 'required',
    ]);

    if($validator->fails()) {
        return Response::json([
            'error' => 'All fields are required'
        ], 400);
    }

    $Job = Job::create([
        'title' => $request->title,
        'type' => $request->type,
        'location' => $request->location,
        'description' => $request->description,
        'salary' => $request->salary,
        'company_name' => $request->company_name,
        'company_email' => $request->company_email,
        'company_phone' => $request->company_phone,
        'company_description' => $request->company_description,
    ]);

    return response()->json([
        'message' => 'Job created successfully',
        'data' => new JobResource($Job)
    ], 201);
}

public function show($id) {
    $Job = Job::find($id);
    if($Job) {
        return new JobResource($Job);
    } else {
        return Response::json(['message' => 'Job not found'], 404);
    }
}

public function update(Request $request, Job $job) {
   $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'type' => 'required|string',
        'location' => 'required',
        'description' => 'required',
        'salary'=> 'required|integer',
        'company_name' => 'required',
        'company_description' => 'required',
        'company_email' => 'required',
        'company_phone' => 'required',
    ]);

    if($validator->fails()) {
        return Response::json([
            'error' => 'All fields are required'
        ], 400);
    }

      $job->update([
        'title' => $request->title,
        'type' => $request->type,
        'location' => $request->location,
        'description' => $request->description,
        'salary' => $request->salary,
        'company_name' => $request->company_name,
        'company_email' => $request->company_email,
        'company_phone' => $request->company_phone,
        'company_description' => $request->company_description,
    ]);

    return response()->json([
        'message' => 'Job updated successfully',
        'data' => new JobResource($job)
    ], 201);
}

public function destroy(Job $job) {

    $job->delete();
    return Response::json(['message' => 'Job deleted successfully'], 200);
}
}
