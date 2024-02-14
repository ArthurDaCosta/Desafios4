<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'título',
        'autor',
        'data_publicação',
        'gênero',
        'páginas',
    ];

    use HasFactory;
}
