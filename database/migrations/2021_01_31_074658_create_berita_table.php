<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id('news_id');
            $table->string('news_title',255);
            $table->string('news_description',255);
            $table->string('news_category_id',4);
            $table->string('news_slug',500);
            $table->text('news_synopsys');
            $table->text('news_content');
            $table->string('news_level');
            $table->string('news_metatitle',255);
            $table->text('news_metadescription',500);
            $table->string('news_status',100);
            $table->string('created_by',100);
            $table->string('updated_by',100);
            $table->text('news_img');
            $table->string('is_active', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
        Schema::dropIfExists('news');
    }
}
