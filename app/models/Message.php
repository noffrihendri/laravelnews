<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['message'];

    //RELASI KE TABLE USER UNTUK MENGAMBIL SIAPA PEMILIK PESAN TERSEBUT
    public function user()
    {
        //KITA GUNAKAN BELONGSTO KARENA USER BERTINDAK SEBAGAI DATA INDUK
        return $this->belongsTo(User::class);
    }
}
