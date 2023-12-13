<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'is_private',
        'secret'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }
}
