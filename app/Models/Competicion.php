<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Competicion extends Model
{
    use HasFactory;
    protected $table = 'competiciones';
    public function categorias(){
        return $this->belongsToMany(Categoria::class,'competiciones_categoria', 'competicion_id', 'categoria_id');
    }
}
