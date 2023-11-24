<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'users_id',
        'conteudo_post',
        'imagem_post'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id','id');
    }
}
