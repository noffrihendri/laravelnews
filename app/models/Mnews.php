<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mnews extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'news_title', 'news_category_id', 'news_description', 'news_slug', 'news_synopsys','news_content','news_level','news_metatitle', 'news_metadescription', 'news_img', 'is_active','news_status', 'created_by', 'updated_by'
    ];

    protected $primaryKey = 'news_id';
    // protected $primarykey = 'role_id';


    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = true;


    public function news_recomendasi($wherein)
    {
        $sql = " SELECT * FROM `news` 
        where news_id in (
            select news_id from news_tag where tag in ('$wherein')
            group by news_id 
        )
        order by created_at desc
        LIMIT 3
        ";
    
        return DB::select($sql);
    }
}
