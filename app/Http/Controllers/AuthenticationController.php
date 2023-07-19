<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{

    public function register(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            // Hash::make($request->newPassword)
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        $user = User::create($request->all());
        return response()->json($user);
        // return response()->json('ok bisa');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user=User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('user login')->plainTextToken;
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    }

    public function me(Request $request){
        return response()->json(Auth::user());
    }
}
