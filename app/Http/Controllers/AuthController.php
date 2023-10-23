<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users',
            'emailEnt' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors(),
                'mail' => true

            ];
            return response()->json(
                $response,
                200
            );
        }
        // Vérifiez si l'e-mail existe déjà dans la table companies
        $companyExists = Company::where('email', $request->emailEnt)->first();

        if (!$companyExists) {
            $response = [
                'success' => false,
                'message' => 'Cet e-mail n\'est pas enregistré dans la table companies',
                'mail' => false
            ];
            return response()->json($response, 200);
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        $user = new User;
        $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role = 'admin';
        $user->company_id = $companyExists->id;
        $user->job_id = '1';
        $user->password = $input['password'];
        $user->save();

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => "User register successfully"
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
                $user = Auth::user();
               // Stockez l'utilisateur connecté dans la session
                 session(['user' => $user]);
                 $user = $request->user();

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            

            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User login successfully"
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => "!!!!!! Ces coordonnees ne sont pas enregistrez : ressayez ou creer un compte"
            ];
            return response()->json($response);
        }
    }

}
