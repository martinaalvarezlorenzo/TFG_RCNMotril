<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategoria extends Model
{
    use HasFactory;
    protected $table = 'user_categoria';

    protected $fillable = [
        'entrenador_id',
        'categoria_id',
    ];
}
