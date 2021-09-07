<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Model\User;
use App\Model\ShopifyProduct;
use App\Model\ShopifyProductVariant;
use PHPShopify\ShopifySDK;
use PDO;
use Config;
use DB;

class SyncShopifyProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::where('id',$this->user_id)->first();
        $config = array(
            'ShopUrl'    => $user->shopify_url,
            'AccessToken'=> $user->shopify_access_token,
        );
        $shopify    = new \PHPShopify\ShopifySDK($config);
        $products   = $shopify->Product->get();
        makeDBConnection($user->database_name);

        // Config::set("database.connections.".$user->database_name, [
        //     'driver'    => 'mysql',
        //     'url'       => env('DATABASE_URL'),
        //     'host'      => env('DB_HOST', '127.0.0.1'),
        //     'port'      => env('DB_PORT', '3306'),
        //     'database'  => $user->database_name,
        //     'username'  => env('DB_USERNAME', 'forge'),
        //     'password'  => env('DB_PASSWORD', ''),
        //     'unix_socket'       => env('DB_SOCKET', ''),
        //     'charset'           => 'utf8mb4',
        //     'collation'         => 'utf8mb4_unicode_ci',
        //     'prefix'            => '',
        //     'prefix_indexes'    => true,
        //     'strict'            => true,
        //     'engine'            => null,
        //     'options'           => extension_loaded('pdo_mysql') ? array_filter([
        //         PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        //     ]) : []
        // ]);

        $shopify_product_table = new ShopifyProduct();
        $shopify_product_variant_table = new ShopifyProductVariant();

        // $shopify_product_table->truncate();
        // $shopify_product_variant_table->truncate();
        
        foreach ($products as $key => $value) {
            $shopify_product = $shopify_product_table->where('product_id',$value['id'])->first();

            $shopify_product_insert_array = [
                'product_id'               => $value['id'],
                'title'                    => $value['title'],
                'body_html'                => $value['body_html'],
                'vendor'                   => $value['vendor'],
                'product_type'             => $value['product_type'],
                'shopify_created_at'       => $value['created_at'],
                'handle'                   => $value['handle'],
                'shopify_updated_at'       => $value['updated_at'],
                'shopify_published_at'     => $value['published_at'],
                'template_suffix'          => $value['template_suffix'],
                'status'                   => $value['status'],
                'published_scope'          => $value['published_scope'],
                'tags'                     => $value['tags'],
                'admin_graphql_api_id'     => $value['admin_graphql_api_id'],
            ];

            if(!empty($shopify_product)){
                $shopify_insert_array['updated_at'] = date('Y-m-d H:i:s');
                $shopify_product_table_id           = $shopify_product->id;
                $shopify_product_table->update(['id'=>$shopify_product_table_id],$shopify_product_insert_array);
            }else{
                $shopify_insert_array['created_at'] = date('Y-m-d H:i:s');
                $shopify_product_table_id = $shopify_product_table->insertGetId($shopify_product_insert_array);
            }


            foreach ($value['variants'] as $k => $val) {
                $variant_array = [
                    'variant_id'        =>  $val['id'],
                    'product_table_id'  =>  $shopify_product_table_id,
                    'product_id'        =>  $val['product_id'],
                    'title'             =>  $val['title'],
                    'product_title'     =>  $value['title'],
                    'price'             =>  $val['price'],
                    'sku'               =>  $val['sku'],
                    'position'                  =>  $val['position'],
                    'inventory_policy'          =>  $val['inventory_policy'],
                    'compare_at_price'          =>  $val['compare_at_price'],
                    'fulfillment_service'       =>  $val['fulfillment_service'],
                    'inventory_management'      =>  $val['inventory_management'],
                    'option1'                   =>  $val['option1'],
                    'option2'                   =>  $val['option2'],
                    'option3'                   =>  $val['option3'],
                    'shopify_created_at'        =>  $val['created_at'],
                    'shopify_updated_at'        =>  $val['updated_at'],
                    'taxable'                   =>  $val['taxable'],
                    'barcode'                   =>  $val['barcode'],
                    'grams'                     =>  $val['grams'],
                    'image_id'                  =>  $val['image_id'],
                    'weight'                    =>  $val['weight'],
                    'weight_unit'               =>  $val['weight_unit'],
                    'inventory_item_id'         =>  $val['inventory_item_id'],
                    'inventory_quantity'        =>  $val['inventory_quantity'],
                    'old_inventory_quantity'    =>  $val['old_inventory_quantity'],
                    'requires_shipping'         =>  $val['requires_shipping'],
                    'admin_graphql_api_id'      =>  $val['admin_graphql_api_id'],
                    'created_at'                => date('Y-m-d H:i:s')
                ];

                $shopify_product_variant_table->updateOrInsert(['variant_id'=>$val['id']],$variant_array);
            }
        }
    }
}
