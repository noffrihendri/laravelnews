<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';
    
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
        $sql = " SELECT * FROM `menu` 
        join role_menu on role_menu.id_menu=menu.menu_id 
        join user_role on user_role.role_id=role_menu.id_role 
        where user_role.role_id='$loginrole'
        ";

        return DB::select($sql,[1]);
    }
}
