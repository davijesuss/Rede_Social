<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfis';
    protected $fillable = [
        'biografia',
        'semestre',
        'imagem_perfil',
        'email',
        'telefone',
        'instagram',
        'curso'
    ];
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id'); 
    }
}
