<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'chat_name' => $this->chat->name,
            'sender' => [
                'name' => $this->sender->name,
                'avatar_url' => $this->sender->getAvatar(),
            ]
        ];
    }
}
