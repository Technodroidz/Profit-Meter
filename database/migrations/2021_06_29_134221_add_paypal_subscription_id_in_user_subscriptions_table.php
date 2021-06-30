<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaypalSubscriptionIdInUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->unsignedInteger('plan_id')->nullable()->after('id');
            $table->string('paypal_plan_id')->nullable()->after('plan_id');
            $table->string('paypal_subscription_id')->nullable()->after('paypal_plan_id');
            
            $table->string('paypal_subscription_status')->nullable()->after('status');
            $table->string('subscription_status')->default('pending')->after('paypal_subscription_status');
            $table->string('payment_gateway')->nullable()->after('subscription_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
        });
    }
}
