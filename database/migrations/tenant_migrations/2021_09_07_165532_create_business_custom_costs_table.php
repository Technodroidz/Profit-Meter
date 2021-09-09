<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCustomCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_custom_costs', function (Blueprint $table) {
            $table->id();
            $table->string('custom_name')->nullable();
            $table->string('custom_slug')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('frequency')->nullable();
            $table->string('cost')->nullable();
            $table->unsignedInteger('accept_include_marketing')->default(1);

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
        Schema::dropIfExists('business_custom_costs');
    }
}
