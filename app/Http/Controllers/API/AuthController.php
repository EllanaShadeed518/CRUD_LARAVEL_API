<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email |unique:users,email',
        'password'=>'required',
        'confirmpassword'=>'required',
    ]);
    if($validator->fails()){
        return response()->json(['msg'=>$validator->errors()]);
    }



           $user= User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            //create token
            $token=$user->createToken('personal access token')->plainTextToken;//when use sanctum use create token to create token for user who register and store this token in personal accsses token
            $user->token=$token;
            return response()->json(['msg'=>'user registered succsesfully',

            'user'=>$user,//or return data without resourse
        ]);}


        public function login(Request $request){
            $validator=Validator::make($request->all(),[

                'email'=>'required|email ',
                'password'=>'required',

            ]);
             if($validator->fails()){
                return response()->json(['msg'=>$validator->errors()]);
               }



                  $user=User::where('email','=',$request->email)->first();
                    //update token for user when who is register and on user table in db
                    if($user){
                    $token=$user->createToken('personal access token')->plainTextToken;//when use sanctum use create token to create token for user who register and store this token in personal accsses token
                    $user->token=$token;

                    return response()->json(['msg'=>'user login succsesfully',

                    'user'=>$user,
                ]);}

                else{

                    return response()->json(['msg'=>'user not found',


                ]);
                }
            }

            public function logout(Request $request){
             if($request->user()->currentAccessToken()->delete()){
               return response()->json(['msg'=>'user logout succsesfully',

                ]);}

            }
}
