@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center w-screen h-screen">
    <div class="max-w-sm md:w-[420px] bg-neutral-700 rounded-md p-10 space-y-3">
        <h1 class="text-2xl text-center mb-4">Sign Up</h1>
        <form action="{{ route('register') }}" method="POST" class="w-full" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="flex flex-col items-center space-y-2 w-full">
                <div class="flex flex-col items-center">
                    <button type="button" class="bg-gray-600 w-24 h-24 rounded-full hover:opacity-70" id="open-file">
                        <img src="assets/images/default.jpg" id="img-avatar" alt="default avatar" class="object-cover w-24 h-24 rounded-full">
                    </button>
                    <input type="file" name="avatar" id="avatar-file" hidden>
                </div>
                <x-input-field type="text" name="name" placeholder="Name" />
                <x-input-field type="email" name="email" placeholder="Email" />
                <x-input-field type="password" name="password" placeholder="Password" />
                <x-input-field type="password" name="password_confirmation" placeholder="Repeat Password" />
            </div>
            <button class="bg-blue-500 text-white py-2 px-4 rounded-sm my-2">Register</button>
        </form>
        <br />
        <p class="text-center text-sm text-blue-500"><a href="/login">Already have an account?</a></p>
    </div>
</div>
@endsection