<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'description',
        'id',
        'total',
        'user_id',
        'category_id',
        'currency_id',
        'transaction_date'
    ];

    public function userTransaction()
    {
        return $this->belongsToMany(App\User::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function currency()
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    }
}
