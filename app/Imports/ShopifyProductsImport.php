<?php

namespace App\Imports;

use App\Model\ShopifyProduct;
use App\Model\ShopifyProductVariant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Exceptions\AppException;

class ShopifyProductsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        $check_array = [
            0 => 'Title',
            1 => 'Variant',
            2 => 'SKU',
            3 => 'Price',
            4 => 'Profitrack Product Cost',
            5 => 'Profitrack Shipping Cost',
            6 => 'Profitrack Handling Cost'
        ];

        if(!isset($rows[0])){
            throw new AppException('File is in invalid format.');
        }

        if($check_array != $rows[0]->toArray()){
            throw new AppException('File is in invalid format.');
        }

        unset($rows[0]);
        foreach ($rows as $key => $row)
        {
            if(!empty($row[0])){
                $row_exists = ShopifyProduct::where('title',$row[0])->where('deleted_at',null)->first();

                if(empty($row_exists)){
                    $shopify_product_insert_array = [
                        'title' => $row[0],
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $shopify_product_table_id = ShopifyProduct::insertGetId($shopify_product_insert_array);
                }else{
                    $shopify_product_table_id = $row_exists->id;
                }

                if(!empty($row[1])){
                    $variant_row_exists = ShopifyProductVariant::where('title',$row[1])->where('product_title',$row[0])->where('deleted_at',null)->first();
                    if(!empty($variant_row_exists)){
                        $update_array = [
                            'title' => $row[1],
                            'sku'   => $row[2],
                            'price' => $row[3],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        ShopifyProductVariant::update(['title'=>$row[1]],$update_array);
                    }else{
                        $insert_array = [
                            'product_table_id' => $shopify_product_table_id,
                            'title' => $row[1],
                            'sku'   => $row[2],
                            'price' => $row[3],
                            'created_at' => date('Y-m-d H:i:s')
                        ];

                        ShopifyProductVariant::insert($insert_array);
                    }
                }
            }
        }
    }
}
