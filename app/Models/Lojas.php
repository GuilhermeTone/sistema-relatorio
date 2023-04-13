<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lojas extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nome',
    ];
}
