<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token['token'] = $user->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token['token'], "user" => $user], 201);


        // $user = new User();
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->password = bcrypt($request->input('password'));
        // $user->save();
        // return response()->json(['message' => 'User created successfully', "result" => $user], 201);
    }
    public function login(Request $request) {
        return "Login function";
    }
}
