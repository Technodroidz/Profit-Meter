<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_disputes', function (Blueprint $table) {
            $table->id();
            $table->string('dispute_id')->nullable();
            $table->string('create_time')->nullable();
            $table->string('update_time')->nullable();
            $table->string('reason')->nullable();
            $table->string('dispute_status')->nullable();
            $table->string('dispute_state')->nullable();
            $table->string('dispute_amount_currency_code')->nullable();
            $table->string('dispute_amount_value')->nullable();
            $table->string('dispute_life_cycle_stage')->nullable();
            
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
        Schema::dropIfExists('paypal_disputes');
    }
}
