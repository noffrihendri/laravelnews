<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Muser extends Model
{
    //
     protected $table = "users";

    protected $fillable = [
        'name', 'email', 'password', 'role', 'image', 'created_by'
    ];



         /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
