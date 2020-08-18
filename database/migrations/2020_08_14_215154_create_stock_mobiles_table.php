<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_mobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_owner')->nullable();
            $table->integer('product')->nullable();
            $table->integer('quantity_available')->nullable();
            $table->integer('sold')->nullable();
            $table->date('date')->nullable();
            $table->integer('clear_status')->nullable();
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
        Schema::dropIfExists('stock_mobiles');
    }
}
