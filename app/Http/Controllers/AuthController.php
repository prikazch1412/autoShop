<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    // register
    function register(Request $request) {
        $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        $user = new User();
        $data = $request->all();
        $data["password"] = Hash::make($request->password);
        $user->create($data);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $authUser = Auth::user();
        $tokenResult = $authUser->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => 'Bearer '.$tokenResult->accessToken,
            'user' => $authUser
        ]);
    }

    // login
    function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'account_role_id' => 1]) || Auth::attempt(['email' => $request->email, 'password' => $request->password, 'account_role_id' => 2])) {
            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            return response()->json([
                'access_token' => 'Bearer '.$tokenResult->accessToken,
                'user' => $user
            ]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    // loginAdmin
    function loginAdmin(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'account_role_id' => 3])) {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            return response()->json([
                'access_token' => 'Bearer '.$tokenResult->accessToken
            ]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
