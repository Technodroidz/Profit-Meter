<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_name')->nullable();
            $table->string('package_amount')->nullable();
            $table->string('package_name_slug')->nullable();
            $table->string('package_duration')->nullable();
            $table->text('short_decription')->nullable();
            $table->text('package_log_description')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_plan')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('subscription_plans');
    }
}
