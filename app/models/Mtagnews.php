<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Mtagnews extends Model
{
    protected $table = 'news_tag';

    protected $fillable = [
        'news_id','tag', 'created_by', 'updated_by'
    ];

    protected $primaryKey = 'tag_id';
    // protected $primarykey = 'role_id';


    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;
}
