<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'matricula', // Adicione o campo 'matricula' aqui
        'password',
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
        'matricula' => 'integer',
    ];

     // Relacionamento com os posts
     public function posts() {
        return $this->hasMany('App\Models\Post', 'users_id', 'id'); 
    }
    // Relacionamento com os comentários
    public function comments() {
        return $this->hasMany('App\Comment');
    }

 
   

    // Relacionamento com as amizades
    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'user1_id')->orWhere('user2_id');
    }
    
    public function perfil() {
        return $this->hasOne('App\Models\Perfil', 'user_id', 'id'); 
    }
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_likes', 'user_id', 'post_id')->withTimestamps();
    }
}
