<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapchatAdCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapchat_ad_campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ad_account_id')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('snapchat_updated_at')->nullable();
            $table->string('snapchat_created_at')->nullable();
            
            $table->string('name')->nullable();
            $table->string('campaign_status')->nullable();
            $table->string('objective')->nullable();
            $table->string('start_time')->nullable();
            $table->string('buy_model')->nullable();
            
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
        Schema::dropIfExists('snapchat_ad_campaigns');
    }
}
