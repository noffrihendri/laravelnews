<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'auth_menu';
    
    protected $fillable = [
        'title', 'link', 'icon','parentid','created_by','updated_by'
    ];

    protected $primaryKey = 'menu_id';
    // protected $primarykey = 'role_id';


    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;



    public function module($loginrole){
        $sql = " SELECT * FROM `auth_menu` 
        join auth_menu_role on auth_menu_role.id_menu=auth_menu.menu_id 
        join auth_user_role on auth_user_role.role_id=auth_menu_role.id_role 
        where auth_user_role.role_id='$loginrole'
        ";

        return DB::select($sql,[1]);
    }
}
