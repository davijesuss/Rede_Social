<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'conteudo_post',
        'imagem_pos'
    ];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
