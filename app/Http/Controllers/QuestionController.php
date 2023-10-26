<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function questions(){

        $questions = Question::all();
        return response($questions, 200);
    }

   public function create_question(Request $request){


    $validator = Validator::make($request->all(), [
        'title' => 'required',
        
                      
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

    $question = new Question();
    $question->title = $request->title;
    $question->company_id = $request->company_id;              
    $question->save();

    $response = [
        'success' => true,
        'message' => "question save successfully"
    ];
    return response()->json(
        $response,
        200
    );

}

    public function get_question($id){
        $question = Question::find($id);
        //dd($company);

        return response()->json([
            'question' => $question
        ]);
    }

public function edit_question(Request $request,$id){
    $validator = Validator::make($request->all(), [
        'title' => 'required',
                        
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

        $question = Question::find($id);
        $question->title = $request->title;
        $question->company_id = $request->company_id;       
        $question->save();

        $response = [
            'success' => true,
            'message' => "question save successfully"
        ];
        return response()->json(
            $response,
            200
        );
    }



    public function delete_question($id){

        $question = Question::find($id);
        $question->delete();
    }
}
