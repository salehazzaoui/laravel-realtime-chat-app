<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAvatar()
    {
        return $this->avatar ? Storage::disk('public')->url('avatars/'.$this->avatar) : config('app.url').'/assets/images/default.jpg';
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Chat::class, 'participants')->withTimestamps();
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }
}
