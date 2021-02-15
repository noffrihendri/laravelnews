<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventtables', function (Blueprint $table) {
            $table->id();
            $table->string('itemid',10)->unique();
            $table->string('name',255);
            $table->text('description');
            $table->string('brand',4);
            $table->string('sub_brand',4);
            $table->string('height');
            $table->string('width');
            $table->string('created_by');
            $table->string('updated_by');
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
        //
        Schema::dropIfExists('inventtables');
    }
}
