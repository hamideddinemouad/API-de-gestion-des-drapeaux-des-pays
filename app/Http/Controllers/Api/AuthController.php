<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        $credentials = ['email' => $request->email, 'password' => $request->password];
       if (Auth::attempt($credentials)){
        $user = User::where('email', $request->email)->first();
        //now i generate token to then send with the response in the api to give feedback if logged in or not
        $token = $user->createToken('auth_token');
        // dd($token);
        return response()->json(['token' => $token->plainTextToken]);
       }
    }
    public function logout(LogoutRequest $request){
        $request->user()->currentAccessToken()->delete();
        // $token = $request->header('authorization');
        // $token = Str::replace('Bearer ', '', $token);
        // // dd($token);
        // dd(hash('sha256', $token));
        // $tokenrecord = DB::table('personal_access_tokens')->where('token' , )->first();
        // dd($tokenrecord);
        return response()->json(['message' => 'Logged out']);
    }
    public function register (RegisterRequest $request){
        
        try{
            User::create(['name' => $request->name,
                    'email' => $request->email, 
                    'password' => Hash::make($request->password)]);
                    return response()->json(['message' => 'register success']);
                }
        catch(Exception $e){

            return response()->json(['message' => $e]);
        }
    //
    }}
