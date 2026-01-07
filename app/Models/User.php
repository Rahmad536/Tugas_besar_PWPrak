<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
protected $fillable = [
    'username',
    'email',
    'password',
    'role', // Added role
    'profile_image',
    'background_image',
    'bio',
];

public function isAdmin()
{
    return $this->role === 'admin';
}

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image 
            ? asset('storage/' . $this->profile_image) 
            : null;
    }

    // Method untuk mendapatkan URL background
    public function getBackgroundImageUrlAttribute()
    {
        return $this->background_image 
            ? asset('storage/' . $this->background_image) 
            : null;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
    'profile_image_url',
    'background_image_url',
];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
