<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model 
{

    // protected $table = 'posts';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function todos(){
        return $this->hasMany(Todo::class);
    }



    // protected static function booted()
    // {
    //     static::deleted(function () {
    //     });
    // }

}
