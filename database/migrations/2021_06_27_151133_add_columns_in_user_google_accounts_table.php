<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUserGoogleAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_google_accounts', function (Blueprint $table) {
            $table->string('google_ads_developer_token')->nullable()->after('user_id');
            $table->string('google_ads_customer_id')->nullable()->after('google_ads_developer_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_user_google_accounts', function (Blueprint $table) {
            //
        });
    }
}
