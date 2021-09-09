<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapchatOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapchat_organisations', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_id')->nullable();
            $table->string('snapchat_updated_at')->nullable();
            $table->string('snapchat_created_at')->nullable();
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('locality')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('tax_id')->nullable();
            $table->text('address_line_1')->nullable();
            $table->string('administrative_district_level_1')->nullable();
            $table->string('accepted_term_version')->nullable();
            $table->string('marketing_optin')->nullable();
            $table->string('contact_phone_optin')->nullable();
            $table->string('notifications_enabled')->nullable();
            $table->string('type')->nullable();
            $table->string('state')->nullable();
            
            $table->string('my_display_name')->nullable();
            $table->string('my_invited_email')->nullable();
            $table->string('my_member_id')->nullable();
            $table->string('createdByCaller')->nullable();

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
        Schema::dropIfExists('snapchat_organisations');
    }
}
