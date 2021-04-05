<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MnewsCategory extends Model
{
    protected $table = 'news_category';

    protected $fillable = [
        'category', 'created_by' 
    ];

    protected $primaryKey = 'category_id';
    // protected $primarykey = 'role_id';


    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;
}
