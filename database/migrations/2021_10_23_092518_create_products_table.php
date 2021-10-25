<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('order_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->string('title');
            $table->string('category');    
            $table->integer('price');    
            $table->integer('item_count');    
            $table->integer('total_price_of_each_count');    
            $table->integer('Total_price');    
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
        Schema::dropIfExists('products');
    }
}
