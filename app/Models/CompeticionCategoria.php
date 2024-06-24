<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompeticionCategoria extends Model
{
    use HasFactory;
    protected $table = 'competiciones_categoria';
    protected $fillable = [
        'competicion_id',
        'categoria_id',
    ];
}
