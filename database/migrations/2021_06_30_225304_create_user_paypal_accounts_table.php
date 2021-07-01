<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaypalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_paypal_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->enum('mode',['sandbox','live'])->default('sandbox');
            $table->string('sandbox_client_id')->nullable();
            $table->string('sandbox_client_secret')->nullable();
            $table->string('live_client_id')->nullable();
            $table->string('live_client_secret')->nullable();
            $table->string('payment_action')->nullable();
            $table->string('currency')->nullable();
            $table->string('notify_url')->nullable();
            $table->string('locale')->nullable();
            $table->string('invoice_prefix')->nullable();

            $table->tinyInteger('connected_status')->default(1);
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
        Schema::dropIfExists('user_paypal_accounts');
    }
}
