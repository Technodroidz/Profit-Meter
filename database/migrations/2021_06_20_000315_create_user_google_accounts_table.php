<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGoogleAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_google_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->string('expires_in')->nullable();
            $table->string('google_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('avatar')->nullable();
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
        Schema::dropIfExists('business_user_google_accounts');
    }
}
