<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleAdCustomerIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_ad_customer_ids', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('name')->nullable();
            
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('calculation_active')->default(1);
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
        Schema::dropIfExists('google_ad_customer_ids');
    }
}
