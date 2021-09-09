<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapchatAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapchat_ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('campaign_id')->nullable();
            $table->string('ad_id')->nullable();
            $table->string('snapchat_updated_at')->nullable();
            $table->string('snapchat_created_at')->nullable();
            
            $table->string('name')->nullable();
            $table->string('ad_squad_id')->nullable();
            $table->string('creative_id')->nullable();
            $table->string('ad_status')->nullable();
            $table->string('type')->nullable();
            $table->string('render_type')->nullable();
            $table->string('review_status')->nullable();
            
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
        Schema::dropIfExists('snapchat_ads');
    }
}
