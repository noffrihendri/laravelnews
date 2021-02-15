<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProdukPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('itemid',15);
            $table->date('from_date');
            $table->date('to_date');
            $table->float('price',10,2);
            $table->float('discount',4,2);
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
        Schema::dropIfExists('produk_price');
    }
}
