<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category_user';

    protected $fillable = [
        'name',
        'id',
        'user_id',
        'category_select'
    ];

    public function users()
    {
        return $this->belongsToMany(App\User::class);
    }
    
}
