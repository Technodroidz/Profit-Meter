<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopify_products', function (Blueprint $table) {
            $table->id();
            $table->text('product_id')->nullable();
            $table->text('title')->nullable();
            $table->text('body_html')->nullable();
            $table->string('vendor')->nullable();
            $table->text('product_type')->nullable();
            $table->text('shopify_created_at')->nullable();
            $table->text('handle')->nullable();
            $table->text('shopify_updated_at')->nullable();
            $table->text('shopify_published_at')->nullable();
            $table->text('template_suffix')->nullable();
            $table->text('status')->nullable();
            $table->text('published_scope')->nullable();
            $table->text('tags')->nullable();
            $table->text('admin_graphql_api_id')->nullable();
            
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
        Schema::dropIfExists('shopify_products');
    }
}
