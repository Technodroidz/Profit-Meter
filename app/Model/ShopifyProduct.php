<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShopifyProduct extends Model
{
    protected $connection ='';
    // protected $table = 'tenant_user';

    public function __construct($database_name = '')
    {
        $this->connection = $database_name ? $database_name : Auth::User()->database_name;
    }

    public static function getShopifyProducts($count,$filter,$request)
    {
        $query = ShopifyProduct::select('shopify_product_variants.*','shopify_products.title as product_title','shopify_products.body_html','shopify_products.product_type','shopify_products.shopify_created_at as product_created_at')
            ->join('shopify_product_variants','shopify_products.product_id','=','shopify_product_variants.product_id');

        if($count === 'all'){
            return $query->count();

        }elseif($count === true && $filter === true){
            return $query->orderBy('shopify_created_at','desc')->offset($request['start'])->limit($request['length'])->count();

        }elseif($count === false && $filter === true){
            return $query->orderBy('shopify_product_variants.shopify_created_at','desc')->offset($request['start'])->limit($request['length'])->get();
        }
    }
}
