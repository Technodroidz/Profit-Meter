<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopifyProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopify_product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant_id')->nullable();
            $table->unsignedInteger('product_table_id')->nullable();
            $table->string('product_id')->nullable();
            $table->text('title')->nullable();
            $table->string('product_title')->nullable();
            $table->text('price')->nullable();
            $table->text('profitrack_handling_cost')->nullable();
            $table->text('sku')->nullable();
            $table->text('position')->nullable();
            $table->text('inventory_policy')->nullable();
            $table->text('compare_at_price')->nullable();
            $table->text('fulfillment_service')->nullable();
            $table->text('inventory_management')->nullable();
            $table->text('option1')->nullable();
            $table->text('option2')->nullable();
            $table->text('option3')->nullable();
            $table->text('shopify_created_at')->nullable();
            $table->text('shopify_updated_at')->nullable();
            $table->text('taxable')->nullable();
            $table->text('barcode')->nullable();
            $table->text('grams')->nullable();
            $table->text('image_id')->nullable();
            $table->text('weight')->nullable();
            $table->text('weight_unit')->nullable();
            $table->text('inventory_item_id')->nullable();
            $table->text('inventory_quantity')->nullable();
            $table->text('old_inventory_quantity')->nullable();
            $table->text('requires_shipping')->nullable();
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
        Schema::dropIfExists('shopify_product_variants');
    }
}
