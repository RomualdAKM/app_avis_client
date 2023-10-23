<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    public function jobs(){

        $jobs = Job::all();
        return response($jobs, 200);
    }
    public function create_job(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
                          
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,
                200
            );
        }

        $client = new Job();
        $client->name = $request->name;
        $client->description = $request->description;       
        $client->save();

        $response = [
            'success' => true,
            'message' => "job save successfully"
        ];
        return response()->json(
            $response,
            200
        );

    }

    public function edit_job(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
                          
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,
                200
            );
        }

        $job = Job::find($id);
        $job->name = $request->name;
        $job->description = $request->description;       
        $job->save();

        $response = [
            'success' => true,
            'message' => "job save successfully"
        ];
        return response()->json(
            $response,
            200
        );
        
    }

    public function get_job($id){

        $job = Job::find($id);
        //dd($company);

        return response()->json([
            'job' => $job
        ]);
    }

    public function delete_job($id){
        // dd($id);
         $job = Job::find($id);
         $job->delete();
        }
}
