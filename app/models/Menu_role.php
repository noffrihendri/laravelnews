<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Menu_role extends Model
{
    protected $table = 'auth_menu_role';

    protected $fillable = [
        'id_role', 'id_menu', 'created_by','updated_by'
    ];

    protected $primaryKey = 'role_id';
    // protected $primarykey = 'role_id';


    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;
}
