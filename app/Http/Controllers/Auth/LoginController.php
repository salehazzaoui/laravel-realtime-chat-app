<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->to('/login')->with('error', 'No user with this email');
        }
        if(!Hash::check($request->password, $user->password)){
            return redirect()->to('/login')->with('error', 'Password incorrect');
        }
        Auth::login($user);

        return redirect()->to('/home')->with('status', 'Logged in successfully');
    }
}
