<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Mnews extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'news_title', 'news_description', 'news_slug', 'news_synopsys','news_content','news_level','news_metatitle', 'news_metadescription', 'news_img', 'is_active','news_status', 'created_by', 'updated_by'
    ];

    protected $primaryKey = 'news_id';
    // protected $primarykey = 'role_id';


    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;

}
