<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapchatAdAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapchat_ad_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('organisation_id')->nullable();
            $table->string('ad_account_id')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('account_status')->nullable();
            $table->string('billing_type')->nullable();
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
        Schema::dropIfExists('snapchat_ad_accounts');
    }
}
