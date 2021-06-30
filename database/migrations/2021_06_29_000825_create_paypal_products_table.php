<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('image_url')->nullable();
            $table->string('home_url')->nullable();
            $table->string('create_time')->nullable();
            $table->string('update_time')->nullable();
            $table->text('links')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('paypal_products');
    }
}
