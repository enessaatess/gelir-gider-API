<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currency';

    protected $data = [];

    protected $fillable = [
        'name',
        'id',
        'symbol',
        'price'
    ];

}
