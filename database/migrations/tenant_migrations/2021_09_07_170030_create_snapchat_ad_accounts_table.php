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
            $table->string('ad_account_id')->nullable();
            $table->unsignedInteger('organisation_id')->nullable();
            $table->string('snapchat_updated_at')->nullable();
            $table->string('snapchat_created_at')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('ad_account_status')->nullable();
            $table->string('currency')->nullable();
            $table->string('timezone')->nullable();
            $table->string('advertiser_organization_id')->nullable();
            $table->string('billing_center_id')->nullable();
            $table->string('billing_type')->nullable();
            $table->string('agency_representing_client')->nullable();
            $table->string('client_paying_invoices')->nullable();

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
