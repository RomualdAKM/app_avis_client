<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function structures()
    {
        $companies = Company::all();

        return response($companies, 200);
        // return response()->json([
        //     'customers' => $companies
        // ]);
    }

    public function create_company(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'adresse' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assurez-vous que l'image est valide
            'ifu' => 'required|numeric',
            
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $logo = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $logo = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = public_path('images/companies');
            $image->move($upload_path, $logo);
        } else {
            $logo = null;
        }

        $company = new Company();
       
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->adresse = $request->adresse;    
        $company->ifu = $request->ifu;
        $company->image = $logo; // Associez le nom du fichier

        $company->save();

        $response = [
            'success' => true,
            'message' => "Company registered successfully"
        ];

        return response()->json($response, 200);
        }


        public function get_structure($id){
           // dd($id);
            $company = Company::find($id);
            //dd($company);

            return response()->json([
                'company' => $company
            ]);
        }
        public function get_info_structure($id){
           //dd($id);
            $company = Company::find($id);
            //dd($company);

            return response()->json([
                'company' => $company
            ]);
        }

        public function edit_structure(Request $request, $id){

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'adresse' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assurez-vous que l'image est valide
                'ifu' => 'required|numeric',
                
            ]);
        
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                return response()->json($response, 200);
            }
            $logo = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $logo = time() . '.' . $image->getClientOriginalExtension();
                $upload_path = public_path('images/companies');
                $image->move($upload_path, $logo);
            } else {
                $logo = null;
            }

            $company = Company::find($id);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->adresse = $request->adresse;    
            $company->ifu = $request->ifu;
            $company->image = $logo; // Associez le nom du fichier
    
            $company->save();
    
            $response = [
                'success' => true,
                'message' => "Company mofify successfully"
            ];
    
            return response()->json($response, 200);

            

        }

        public function delete_structure($id){
           // dd($id);
            $company = Company::find($id);
            $company->delete();
           }
}
