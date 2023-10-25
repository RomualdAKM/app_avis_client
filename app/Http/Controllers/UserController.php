<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function create_user(Request $request){
       
          
          $idUser = $request->idAuthUser;
          $users = User::where('id',$idUser)->first();
               // dd($users->company_id);
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'adresse' => 'required',
            'jobId' => 'required',
                          
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
       
        // Generate the QR code with the email as the filename
        $email = $request->email;
        
        $qrcode = QrCode::size(200)->generate("https://www.akilischool.com", public_path("codes-qr/$email.svg"));

        $user = new User();
        $user->name = $request->name;
        $user->firstname = $request->firstname;       
        $user->email = $request->email;       
        $user->phone = $request->phone;       
        $user->adresse = $request->adresse;       
        $user->password = $request->phone;       
        $user->role = 'user';       
        $user->qrcode = "$email.svg";       
        $user->company_id = $users->company_id;       
        $user->job_id = $users->job_id;       
        $user->save();

        $response = [
            'success' => true,
            'message' => "User save successfully"
        ];
        return response()->json(
            $response,
            200
        );

    }

    public function users(){
        $users = User::all();
        return response($users, 200);
    }


    public function get_qrcodeuser($id){
        $qrcodeuser = User::where('id',$id)->first('qrcode');
        //dd($qrcodeuser);
        return response($qrcodeuser, 200);
    }
}
