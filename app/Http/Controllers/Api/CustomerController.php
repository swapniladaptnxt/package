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
        // dd($token);

        // if ($user->role_id == 4) {
        //     $user_status = 'rider';
        // }
        // if ($user->role_id == 3) {
        //     $user_status = 'store';
        // }
        // if ($user->role_id == 2) {
        //     $user_status = 'customer';
        // }
        $typ = $user_status . "_status";
        return response()->json(['token' => $token[1], 'login_id' => $token[0], 'name' => $user->name, 'email' => $user->email, $typ => $user->status, 'success' => 1, 'message' => 'Login Successful'], 202);
    }

}
