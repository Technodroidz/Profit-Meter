<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->enum('financial_status',['pending','authorized'])->nullable();
            $table->tinyInteger('zero_value_order')->default(0);
            $table->tinyInteger('cancelled_order')->default(0);
            $table->text('order_tags')->nullable();
            $table->tinyInteger('pos')->default(0);
            $table->tinyInteger('draft_order')->default(0);
            $table->text('order_channels')->nullable();
            $table->text('customer_tags')->nullable();
            $table->tinyInteger('refund_order_cost_to_zero')->default(0);
            $table->tinyInteger('assign_original_order_date_to_refund')->default(0);

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
        Schema::dropIfExists('rules');
    }
}
