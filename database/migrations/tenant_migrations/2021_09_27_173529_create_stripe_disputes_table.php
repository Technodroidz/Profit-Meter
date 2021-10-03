<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStripeDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_disputes', function (Blueprint $table) {
            $table->id();
            $table->string('object')->nullable();
            $table->string('amount')->nullable();
            $table->text('balance_transaction')->nullable();
            $table->text('charge')->nullable();
            $table->string('created')->nullable();
            $table->string('currency')->nullable();
            $table->tinyInteger('is_charge_refundable')->default(0);
            $table->tinyInteger('livemode')->default(0);
            $table->string('payment_intent')->nullable();
            $table->string('reason')->nullable();
            $table->string('dispute_status')->nullable();

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
        Schema::dropIfExists('stripe_disputes');
    }
}
