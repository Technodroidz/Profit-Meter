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
            $table->text('paypal_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('token')->nullable();
            $table->text('token_id')->nullable();
            $table->text('refresh_token')->nullable();
            $table->text('expires_in')->nullable();
            $table->text('sub')->nullable();
            $table->string('paypal_email_verified')->nullable();

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
