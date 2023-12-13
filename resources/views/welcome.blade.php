@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center w-screen h-screen">
    <div class="max-w-sm bg-neutral-700 rounded-md p-10 space-y-3">
        <h1 class="text-2xl text-center">Welecome to Chat App</h1>
        <form action="/gotologin" method="GET">
            @method('GET')
            @csrf
            <div class="flex items-center justify-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-8 rounded-sm">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection