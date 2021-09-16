<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnShopifyPercentageFeeInTransactionCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_costs', function (Blueprint $table) {
            $table->float('shopify_percentage_fee',8,4)->after('payment_gateway')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_costs', function (Blueprint $table) {
            //
        });
    }
}
