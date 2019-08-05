<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller
{

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 500);
        }

        try {
            \DB::beginTransaction();


            $user = new User();
            if($user->fillData($request->all())){
                \DB::commit();
                return response()->json([
                    'message' => "Registration Successful"
                ]);
            }
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return $e->getMessage();
        }
    }
}
