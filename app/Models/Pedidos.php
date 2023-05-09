<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Pedidos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'idLoja',
        'idUsuario',
        'deleted_at'
    ];
}
