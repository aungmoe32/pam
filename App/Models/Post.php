<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model 
{

    protected $table = 'posts';


    public static function say()
    {
    }
    protected static function booted()
    {
        error_log('booted');
        static::deleted(function () {
            error_log("deleted");
        });
    }

}
