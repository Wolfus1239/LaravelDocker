<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisterController extends SanctumPersonalAccessToken
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => Str::random(60),
        ]);

        return response()->json(['token' => $user->api_token], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $request->bearerToken();
        if (Auth::attempt($credentials)) {
            return response()->json(['auth_token' => Auth::user()->api_token], 200);
        } else {
            if(!empty($token)){
              $db_token = DB::table('users')->where('api_token', '=',$token)->first();
               if(!empty($db_token->api_token) == $token){
                   return response()->json(['auth_token' => $request->bearerToken()], 200);
               }
            }else {
                return response()->json(['message' => 'token is invalid']);
            }
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

    }

}
