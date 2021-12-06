<?php

namespace App\Models;

// use App\Traits\HasSecurePassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends \Eloquent implements Authenticatable
{
    // use HasSecurePassword;
    use AuthenticableTrait;
    
    /**
     * Validation rules
     *
     * @var array
     */
    protected $table = 'user';

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
        'name', 'email', 'surname', 'password', 'password_confirmation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function categories()
    {
        return $this->ManyTo(Category::class);
    }

}
