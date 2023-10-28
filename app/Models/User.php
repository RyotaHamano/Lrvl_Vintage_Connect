<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'most_favorite',
        'introduction',
        'is_admission',
        'deleted_post_items',
        'deleted_comments',
        'disabled_tags',
        'is_admin',
        'user_image_path'
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
    ];
    
    public function post_items(){
        return $this->hasMany(PostItem::Class);
    }
    
    public function tags(){
        return $this->hasMany(Tag::Class);
    }
    
    public function comments(){
        return $this->hasMany(Comment::Class);
    }
    
    public function followings(){
        return $this->belongsToMany(User::Class, 'relationships', 'followed_id', 'follow_id');
    }
    
    //フォロワー取得
    public function followers(){
        return $this->belongsToMany(User::Class, 'relationships', 'follow_id', 'followed_id');
    }

}
