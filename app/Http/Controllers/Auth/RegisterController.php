<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        if($request->has('avatar') && $request->file('avatar')){
            $avatar = $request->file('avatar');
            $avatarName = time().'_'. str_replace(' ', '_', $avatar->getClientOriginalName());
            $avatar->storeAs('avatars', $avatarName, 'public');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarName ?? null
        ]);

        Auth::login($user);

        event(new Registered($user));

        return redirect()->to('/home')->with('status', 'You registered successfully.');
    }
}
