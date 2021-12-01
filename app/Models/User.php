<?php

namespace App\Models;

// use App\Traits\HasSecurePassword;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // use HasSecurePassword;
    
    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'name'     => 'required|max:255',
        'surname'     => 'required|max:255',
        'email'    => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'password_confirmation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password_digest',
    ];


    public function categories()
    {
        return $this->belongsToMany(App\Category::class);
    }

}
