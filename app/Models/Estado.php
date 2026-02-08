<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = "table_estados";
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
