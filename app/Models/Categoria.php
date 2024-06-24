<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Competicion;

class Categoria extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class,'user_categoria');
    }

    public function competiciones(){
        return $this->belongsToMany(Competicion::class,'competiciones_categoria');
    }
}
