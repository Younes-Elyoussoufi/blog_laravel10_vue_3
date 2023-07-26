<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   public function is_login(){
    return response()->json([
      'is_login'=>auth()->check()
    ]);
   }

    public function register(Request $request){
          $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
          ]);

          if($validator->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator->errors()
            ];
            return response()->json($response,400);
          }

          $input=$request->all();
          $input['password']=bcrypt($input['password']);
          $user=User::create($input);

          $token=$user->createToken('MyToken')->plainTextToken;
 
          $response=[
            'user'=>$user,
            'success'=>true,
            'token'=>$token,
            'message'=>'user login with success'
             ];
          return response()->json($response,200);  
          
    }

    public function login(Request $request){

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           $user=Auth::user();
          
           $token=$user->createToken('MyToken')->plainTextToken;
 
           $response=[
             'user'=>$user,
             'success'=>true,
             'token'=>$token,
             'message'=>'user login with success'
              ];
           return response()->json($response,200);  
        }else{
            $response=[
                'message'=>'unthorized',
                'success'=>false,

            ];
            return response()->json($response,400);
        }

    }

    public function logout(Request $request){
        auth()->user()->tokens->each(function($token,$ket){
           $token->delete();
        });
     }
}
