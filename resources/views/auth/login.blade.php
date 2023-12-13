@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center w-screen h-screen">
    <div class="max-w-sm md:w-[420px] bg-neutral-700 rounded-md p-10 space-y-3">
        <h1 class="text-2xl text-center mb-4">Sign In</h1>
        <x-alert />
        <form action="{{ route('login') }}" method="POST" class="w-full">
            @csrf
            @method('POST')
            <div class="flex flex-col items-center space-y-2 w-full">
                <x-input-field type="email" name="email" placeholder="Email" />
                <x-input-field type="password" name="password" placeholder="Password" />
            </div>
            <button class="bg-blue-500 text-white py-2 px-4 rounded-sm my-2">Login</button>
        </form>
        <br />
        <p class="text-center text-sm text-blue-500"><a href="/register">Do you have an account?</a></p>
    </div>
</div>
@endsection