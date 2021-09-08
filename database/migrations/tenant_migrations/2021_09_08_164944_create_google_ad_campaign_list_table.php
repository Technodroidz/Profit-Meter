<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleAdCampaignListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_ad_campaign_list', function (Blueprint $table) {
            $table->id();
            $table->text('campaign_resource_name')->nullable();
            $table->text('campaign_status')->nullable();
            $table->text('campaign_name')->nullable();
            $table->text('campaign_id')->nullable();
            $table->text('metrics_clicks')->nullable();
            $table->text('cost_micros')->nullable();
            $table->text('impressions')->nullable();
            
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
        Schema::dropIfExists('google_ad_campaign_list');
    }
}
