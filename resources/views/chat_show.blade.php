@extends('layouts.app')
@section('content')
<div class="grid grid-cols-4">
    <div class="col-span-1 p-2">
        <ul class="flex flex-col items-center w-full space-y-1">
            @foreach ($participants as $participant)
                @if ($participant->id == auth()->user()->id)
                    <li class="bg-neutral-700 p-2 w-full hover:opacity-90 border-l-2 border-l-blue-600">
                        <div class="flex items-center space-x-1 p-1">
                            <div class="w-12 h-12 rounded-full">
                                <img src="{{$participant->getAvatar()}}" alt="{{ $participant->name }}" class="w-12 h-12 object-cover rounded-full">
                            </div>
                            <span>{{ $participant->name }}</span>
                        </div>
                    </li>
                @else
                    <li class="bg-neutral-700 p-2 w-full hover:opacity-90">
                        <div class="flex items-center space-x-1 p-1">
                            <div class="w-12 h-12 rounded-full">
                                <img src="{{$participant->getAvatar()}}" alt="{{ $participant->name }}" class="w-12 h-12 object-cover rounded-full">
                            </div>
                            <span>{{ $participant->name }}</span>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="col-span-3 flex flex-col h-[92.1vh] p-2">
        <div class="flex flex-col h-full bg-zinc-600 p-2 overflow-auto" id="messages-block">
            @if ($messages->count() > 0)
                @foreach ($messages as $message)
                    @if ($message->user_id == auth()->user()->id)
                        <div>
                            <div class="flex flex-row-reverse items-center space-x-1 w-fit float-right">
                                <div class="w-7 h-7 rounded-full mx-1">
                                    <img src="{{$message->sender->getAvatar()}}" alt="{{ $message->sender->name }}" class="w-7 h-7 object-cover rounded-full">
                                </div>
                                <pre class="my-4 p-2 bg-indigo-500 rounded-md w-fit">{{ $message->body }}</pre>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-1">
                            <div class="w-7 h-7 rounded-full">
                                <img src="{{$message->sender->getAvatar()}}" alt="{{ $message->sender->name }}" class="w-7 h-7 object-cover rounded-full">
                            </div>
                            <pre class="my-4 p-2 bg-stone-500 rounded-md w-fit">{{ $message->body }}</pre>
                        </div>
                    @endif
                @endforeach
            @else
                <p class="text-center text-sm">Start the conversation</p>
            @endif
        </div>
        <form action="{{ route('send_message', ['chatId' => $chat->id]) }}" method="POST">
            @csrf
            @method('POST')
            <div class="flex items-center">
                <input type="text" name="body" class="bg-zinc-700 p-2 rounded-sm focus:outline-none w-full">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-sm">Send</button>
            </div>
        </form>
    </div>
</div>
<x-model>
    <div class="bg-neutral-800 p-2 flex items-center justify-between">
        <h1>Create a new chat</h1>
        <button id="btn-close-model" class="bg-red-600 text-white py-1 px-2 text-md rounded-md hover:opacity-80">X</button>
    </div>
    <form action="{{ route('chats') }}" method="POST" class="w-full mt-4 p-4">
        @csrf
        @method('POST')
        <div class="flex flex-col items-center space-y-2 w-full">
            <x-input-field type="text" name="name" placeholder="Name" />
        </div>
        <button class="bg-blue-500 text-white py-2 px-4 rounded-sm my-2">Create</button>
    </form>
</x-model>

<script>
    const channelName = "{!! $chat->name !!}";
</script>
@endsection