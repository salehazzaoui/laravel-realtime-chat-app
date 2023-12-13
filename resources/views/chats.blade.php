@extends('layouts.app')
@section('content')
<div class="grid grid-cols-3">
    <div class="col-span-1"></div>
    <div class="col-span-1 p-2">
        @if ($chats->count() > 0)
            <x-alert />
            <ul class="flex flex-col items-center w-full space-y-1">
                @foreach ($chats as $chat)
                    <li class="bg-neutral-700 p-1 w-full hover:opacity-90">
                        <div class="flex items-center justify-between p-2">
                            <span>{{ $chat->name }}</span>
                            @if ($chat->participants()->where('user_id', auth()->user()->id)->exists())
                                <a href="chats/{{$chat->id}}" class="bg-blue-500 text-white p-2 rounded-sm hover:opacity-90">Go</a>
                            @else
                                <form action="{{ route('chat_join', [ 'chatId' => $chat->id ]) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="flex items-center space-x-1">
                                        <x-input-field type="password" name="secret" placeholder="Secret" />
                                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-sm hover:opacity-90">Join</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No chat yet</p>
        @endif
    </div>
    <div class="col-span-1"></div>
</div>
<x-model>
    <div class="bg-neutral-800 p-2 flex items-center justify-between">
        <h1>Create a new chat</h1>
        <button id="btn-close-model" class="bg-red-600 text-white py-1 px-2 text-md rounded-md hover:opacity-80">X</button>
    </div>
    <form action="{{ route('chats') }}" method="POST" class="w-full mt-4 p-4">
        @csrf
        @method('POST')
        <div class="flex flex-col items-start space-y-2 w-full">
            <x-input-field type="text" name="name" placeholder="Name" />
            <div class="flex items-center space-x-1 my-2">
                <label for="is_private">Private</label>
                <input type="checkbox" name="is_private" id="private" class="bg-neutral-800 text-white p-2 rounded-sm focus:outline-none w-full @error('is_private') border border-red-500 @enderror" />
            </div>
            <input type="password" name="secret" placeholder="Secret" hidden id="secret" class="bg-neutral-800 text-white p-2 rounded-sm focus:outline-none w-full @error('secret') border border-red-500 @enderror" />
        </div>
        <button class="bg-blue-500 text-white py-2 px-4 rounded-sm my-2">Create</button>
    </form>
</x-model>

<script>
const privateCheckBox = document.getElementById('private');
const secretInput = document.getElementById('secret');

privateCheckBox?.addEventListener('click', (e) => {
    if(privateCheckBox.checked){
        secretInput.removeAttribute('hidden');
    }else{
        secretInput.setAttribute('hidden', 'true');
    }
});
</script>
@endsection