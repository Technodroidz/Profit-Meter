<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShopifyProduct extends Model
{
    protected $connection ='tenant';
    // protected $table = 'tenant_user';

    public function __construct()
    {
        // $this->connection = null !== Auth::User() ? Auth::User()->database_name : $database_name;
    }

    public static function getShopifyProducts($count,$filter,$request)
    {
        $query = ShopifyProduct::select('shopify_product_variants.*','shopify_products.title as product_title','shopify_products.body_html','shopify_products.product_type','shopify_products.shopify_created_at as product_created_at')
            ->join('shopify_product_variants','shopify_products.id','=','shopify_product_variants.product_table_id');
        if(!empty($request['search']['value']))
        {
            $query = $query ->where('shopify_product_variants.title','like', '%'.$request['search']['value'].'%');
            $query = $query ->orwhere('shopify_products.title','like', '%'.$request['search']['value'].'%');
            $query = $query ->orwhere('shopify_product_variants.sku','like', '%'.$request['search']['value'].'%');
            $query = $query ->orwhere('shopify_product_variants.product_id','like', '%'.$request['search']['value'].'%');
        }

        if($count === 'all'){
            return $query->count();
        }elseif($count === true && $filter === true){
            return $query->orderBy('shopify_created_at','desc')->offset($request['start'])->limit($request['length'])->count();

        }elseif($count === false && $filter === true){
            return $query->orderBy('shopify_product_variants.shopify_created_at','desc')->offset($request['start'])->limit($request['length'])->get();
        }
    }
}
