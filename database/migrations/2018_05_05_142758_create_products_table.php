<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('cbd')->nullable();
            $table->string('flavour')->nullable();
            $table->string('flavour_en')->nullable();
            $table->integer('price');
            $table->integer('price_lg')->nullable();
            $table->integer('stock');
            $table->integer('stock_lg')->nullable();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('description');
            $table->text('description_en');
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
