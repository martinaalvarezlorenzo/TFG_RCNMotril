<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usu extends Model
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'correo_electronico', 'username', 'password'];
}
