<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Http\Requests\CreateChatRequest;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['participants'])->get();
        return view('chats', [
            'chats' => $chats
        ]);
    }

    public function createChat(CreateChatRequest $request)
    {
        $user = User::find(auth()->user()->id);
        if($request->is_private){
            $chat = $user->chats()->create([
                'name' => $request->name,
                'is_private' => true,
                'secret' => Hash::make($request->secret)
            ]);
        }else{
            $chat = $user->chats()->create([
                'name' => $request->name
            ]);
        }
        $chat->participants()->attach(auth()->user());
        
        return redirect()->to('/home')->with('status', 'chat created.');
    }

    public function show($id)
    {
        $chat = Chat::with(['messages', 'participants'])->findOrFail($id);
        $isParticipant = $chat->participants()->where('user_id', auth()->user()->id)->exists();
        if(!$isParticipant){
            if($chat->is_private){
                return back()->with('error', 'This chat is private');
            }else{
                $chat->participants()->attach(auth()->user());
                $chat = Chat::with(['messages', 'participants'])->findOrFail($id);
            }
        }
        $messages = $chat->messages;
        $participants = $chat->participants;
        return view('chat_show', [
            'chat' => $chat,
            'participants' => $participants,
            'messages' => $messages,
        ]);
    }

    public function sendMessage(SendMessageRequest $request, $chatId)
    {
        $user = User::find(auth()->user()->id);
        $chat = Chat::find($chatId);
        if(!$chat){
            $chat = Chat::create([
                'name' => Str::uuid()
            ]);
            $chat->participants()->attach($user);
        }
        $isParticipant = $chat->participants()->where('user_id', $user->id)->exists();
        if(!$isParticipant){
            $chat->participants()->attach($user);
        }
        $message = $user->messages()->create([
            'body' => $request->body,
            'chat_id' => $chat->id
        ]);
        $data = [
            'id' => $message->id,
            'body' => $message->body,
            'chat_name' => $message->chat->name,
            'sender' => [
                'name' => $message->sender->name,
                'avatar_url' => $message->sender->getAvatar(),
            ]
        ];
        SendMessage::dispatch($data);

        return redirect()->to('chats/'.$chat->id);

    }
}
