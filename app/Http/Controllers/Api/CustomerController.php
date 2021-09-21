<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function Login(Request $request)
    {
        $user_status = "";
        $data        = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => 0,
                'message' => 'The provided credentials are incorrect.',
                
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $token = explode('|', $token);
       
        return response()->json(['token' => $token[1], 'login_id' => $token[0], 'name' => $user->name, 'email' => $user->email, 'success' => 1, 'message' => 'Login Successful'], 202);
    }

    public function Register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()[0]], 406);
        }

        $user = User::create([
            'name'     => $request->name,
            'role_id'  => 2,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('token')->plainTextToken;
        $token = explode('|', $token);
        return response()->json(['token' => $token[1], 'login_id' => $token[0], 'success' => 1, 'message' => 'Registration Successful'], 201);
    }

}
