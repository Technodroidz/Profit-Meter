<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;
use Illuminate\Support\Facades\Auth;
use App\Model\BusinessCategory;
use App\Model\BusinessCustomCost;
use Illuminate\Support\Str;
use App\Jobs\SyncShopifyProducts;
use App\Model\ShopifyProduct;
use App\Model\ShopifyProductVariant;
use App\Model\ShippingCostCountryRule;
use App\Model\ShippingCostSetting;
use App\Model\ShopifyProductVariantCost;
use App\Model\ShopifyProductVariantShippingCost;
use App\Model\TransactionCost;
use Validator;
use App\Exceptions\AppException;
use App\Imports\ShopifyProductsImport;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function importShopifyProducts(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'import_products'           => 'required|file',
                'extension'                 => 'required|in:csv,xlsx,xls'
            ];

            $validation_attributes = [
                'import_products'           => 'File'
            ];

            $validation_message = [];
            
            $validator = Validator::make(['import_products' => $request->import_products,'extension'=>strtolower($request->import_products->getClientOriginalExtension())], $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                Excel::import(new ShopifyProductsImport, request()->file('import_products'));
                $json_array = ['reload'=>true,'close_modal'=>true];
                return response()->data($json_array,'Import Successfull.');
            }
        }
    }

    public function productCost(Request $request)
    {
        // $config = array(
        //     'ShopUrl' => Auth::User()->shopify_url,
        //     'AccessToken' => Auth::User()->shopify_access_token,
        // );

        // $shopify    = new \PHPShopify\ShopifySDK($config);
        
        // $products = $shopify->Product->get();
        
        $data = ['current_link' => 'product_cost','country_list'=>country_list()];

        return view('business_app/content_template/product_cost',$data);
    }

    public function productListAjax(Request $request)
    {
        $products = ShopifyProduct::getShopifyProducts(false,true,$request->all());
        
        $data = [];
        foreach ($products as $key => $value) {
            $profitrack_product_cost = ShopifyProductVariantCost::where('variant_id',$value->id)->where('deleted_at',null)->get();
            
            if(!empty($profitrack_product_cost)){
                $profitrack_product_cost = $profitrack_product_cost->toArray();
                $profitrack_product_json = urlencode(json_encode(['product_json' => $profitrack_product_cost]));
            }else{
                $profitrack_product_json = urlencode(json_encode(['product_json' => '']));
            }

            $profitrack_shipping_cost = ShopifyProductVariantShippingCost::where('variant_id',$value->id)->where('deleted_at',null)->get();
            
            if(!empty($profitrack_shipping_cost)){
                $profitrack_shipping_cost = $profitrack_shipping_cost->toArray();
                $profitrack_shipping_json = urlencode(json_encode(['product_json' => $profitrack_shipping_cost]));
            }else{
                $profitrack_shipping_json = urlencode(json_encode(['product_json' => '']));
            }

            $row = [];
            $row[]  = $value->product_id;
            $row[]  = $value->variant_id;
            $row[]  = $value->product_title;
            $row[]  = $value->title;
            $row[]  = $value->price;
            $row[]  = $value->sku;
            $row[]  = $value->shopify_created_at;

            $product_detail = $value->product_title.' | '.$value->title.' - [ '.$value->sku.' ]';

            $row[]  = '<button type="button" class="add_prftrck_prdct_cst close" data-variant_id="'.$value->id.'" data-toggle="modal" data-target="#productCostModal" data-saved_product_json="'.$profitrack_product_json.'" data-records_populated="no" data-product_detail="'.$product_detail.'"><span aria-hidden="true">&plus;</span></button>';
            $row[]  = '<button type="button" class="add_prftrck_shp_cst close" data-variant_id="'.$value->id.'" data-toggle="modal" data-target="#shippingCostModal" data-saved_product_json="'.$profitrack_shipping_json.'" data-records_populated="no" data-product_detail="'.$product_detail.'"><span aria-hidden="true">&plus;</span></button>';
            $row[]  = '<p id="handling_cost_'.$value->id.'">'.$value->profitrack_handling_cost.'</p><button type="button" class="add_prftrck_hnd_cst close" data-variant_id="'.$value->id.'" data-toggle="modal" data-target="#handlingCostModal"><span aria-hidden="true">&plus;</span></button>';
            $data[] = $row;
        }

        $json_array = array(
            "draw"               => $request->draw,
            "recordsTotal"       => ShopifyProduct::getShopifyProducts('all',true,$request->all()),
            "recordsFiltered"    => ShopifyProduct::getShopifyProducts(true,true,$request->all()),
            "data"               => $data,
        );

        return json_encode($json_array);
    }

    public function shippingCost(Request $request)
    {
        $country_rules          = ShippingCostCountryRule::where('deleted_at',null)->get();
        $shipping_cost_setting  = ShippingCostSetting::get();
        if(!empty($shipping_cost_setting)){
            $shipping_cost_setting = $shipping_cost_setting->toArray();
            $shipping_cost_setting = make_key_value_pair($shipping_cost_setting);
        }else{
            $shipping_cost_setting = [];
        }

        $data = ['shipping_cost_setting' => $shipping_cost_setting,'country_list'=>country_list(),'country_rules'=> $country_rules,'current_link' => 'shipping_cost'];

        return view('business_app/content_template/shipping_cost',$data);
    }

    public function addCountryRule(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'country'           => 'required', 
                'shipping_cost'     => ['required','numeric','gt:0', 'regex:/^\d{0,4}(\.\d{0,2})?$/i'],
            ];

            $validation_attributes = [
                'country'           => 'Country', 
                'shipping_cost'     => 'Shipping Cost', 
            ];

            $validation_message = [
                'shipping_cost.regex' => 'Upto 4 digits before and 2 digits after decimal are allowed (xxxx.xx or xxxx).'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $country_rule_exists = ShippingCostCountryRule::where('country',$request->country)->where('deleted_at',null)->exists();
                if($country_rule_exists){
                    throw new AppException('Country rule with this country already exists');
                }
                $insert_array = [
                    'country' => $request->country,
                    'shipping_cost' => $request->shipping_cost,
                ];

                $insert_id = ShippingCostCountryRule::insertGetId($insert_array);

                $delete_button = '<button id = "country_rule_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    </button>
                                                    <button type="button" class="close country_rule_btn" aria-label="Close" data-url="'.route('delete_shipping_country_rule').'" data-request="inline-post-ajax" data-method="post" data-variable="country_rule_id" data-country_rule_id="'.$insert_id.'" data-show_error="#country_rule_error" data-disable_element_class=".country_rule_btn" data-loader="#country_rule_loader" data-swal_message="Are You Sure to Delete." data-remove_datatable_element="#country_rule_'.$insert_id.'">
                                                      <span aria-hidden="true"><i class="fa fa-trash"></i></span>
                                                    </button>';

                $json_array = ['close_modal'=>true,'datatable_row' => [$request->country,$request->shipping_cost,$delete_button]];
                // session()->flash('success', 'Country Rule Added successfully.');
                return response()->data($json_array,'Country Rule Added.');
            }
        }
        throw new AppException('Invalid http method');
    }

    public function deleteCountryRule(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'country_rule_id' => 'required' 
            ];

            $validation_attributes = [
            ];

            $validation_message = [];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                ShippingCostCountryRule::where('id',$request->country_rule_id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                return response()->data(['remove_datatable_row'=>true],'Country Rule Deleted');
            } 
        }
    }
    
    public function updateShippingCostSettings(Request $request){
        if($request->isMethod('post')){

            $validation_array = [
                'multiply_shipping_fee'     => 'in:0,1',
                'fallback_country_rule'     => 'in:0,1', 
                'multiply_handling_fee'     => 'in:0,1', 
                'shipping_fee_together'     => 'in:0,1', 
                'highest_shipping_fee'      => 'in:0,1', 
                'highest_handling_fee'      => 'in:0,1', 
            ];

            $validation_attributes = [];

            $validation_message = [];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $request = $request->all();

                $request['multiply_shipping_fee'] = @$request['multiply_shipping_fee']     ? 1 : 0;
                $request['fallback_country_rule'] = @$request['fallback_country_rule']     ? 1 : 0;
                $request['multiply_handling_fee'] = @$request['multiply_handling_fee']     ? 1 : 0;
                $request['shipping_fee_together'] = @$request['shipping_fee_together']     ? 1 : 0;
                $request['highest_shipping_fee']  = @$request['highest_shipping_fee']      ? 1 : 0;
                $request['highest_handling_fee']  = @$request['highest_handling_fee']      ? 1 : 0;

                foreach ($request as $key => $value) {
                    if($key != '_token'){
                        $insert_array = [
                            'key'   => $key,
                            'value' => $value,
                        ];
                        ShippingCostSetting::updateOrInsert(['key' => $key],$insert_array);
                    }
                }
                return response()->success('Shipping Settings Saved.');
            }
        }
        throw new AppException('Invalid http method');
    }

    public function handlingCost(Request $request)
    {
        $data = ['current_link' => 'handling_cost'];
        return view('business_app/content_template/handling_cost',$data);
    }
    
    public function addHandlingCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'variant_id'        => 'required',
                'handling_cost'     => ['required','numeric','gt:0', 'regex:/^\d{0,4}(\.\d{0,2})?$/i'], 
            ];

            $validation_attributes = [ 
            ];

            $validation_message = [
                'handling_cost.regex' => 'Upto 4 digits before and 2 digits after decimal are allowed (xxxx.xx or xxxx).'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{

                ShopifyProductVariant::where('id',$request->variant_id)->update(['profitrack_handling_cost' => $request->handling_cost]);

                $json_array = ['replace_html_element'=>'#handling_cost_'.$request->variant_id,'append_html'=>$request->handling_cost,'close_modal'=>true];
                return response()->data($json_array,'Handling Cost Updated.');
            }
        }
        throw new AppException('Invalid http method');
    }

    public function tax(Request $request)
    {
        $data = ['current_link' => 'tax'];
        $data['tax'] = ShippingCostSetting::where('deleted_at',null)->where('key','tax_rate')->first();
        return view('business_app/content_template/tax',$data);
    }

    public function updateTaxRate(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'tax_rate'     => 'required'
            ];

            $validation_attributes = [ 
            ];

            $validation_message = [];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $insert_array = [
                    'key'   => 'tax_rate',
                    'value' => $request->tax_rate,
                ];
                ShippingCostSetting::updateOrInsert(['key' => 'tax_rate'],$insert_array);
                return response()->success('Tax Rate Updated.');
            }
        }
        throw new AppException('Invalid http method');
    }

    public function transactionCost(Request $request)
    {
        $data = ['current_link' => 'transaction_cost'];
        $transaction_cost_list = TransactionCost::where('deleted_at',null)->get();
        foreach ($transaction_cost_list as $key => &$value) {
            $value->payment_gateway = payment_gateway_list($value->payment_gateway);
        }
        $data['transaction_cost'] = $transaction_cost_list;
        $data['payment_gateway_list'] = payment_gateway_list();

        return view('business_app/content_template/transaction_cost',$data);
    }

    public function addTransactionCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'payment_gateway'     => 'required',
                'shopify_percentage_fee'      => 'required|between:0,99.99',
                'percentage_fee'      => 'required|between:0,99.99',
                'fixed_fee'           => 'required|numeric|gt:0|regex:/^\d{0,4}(\.\d{0,2})?$/i',
            ];

            $validation_attributes = [ 
            ];

            $validation_message = [
                'fixed_fee.regex' => 'Upto 4 digits before and 2 digits after decimal are allowed (xxxx.xx or xxxx).'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $transaction_cost_exists = TransactionCost::where('payment_gateway',$request->payment_gateway)->where('deleted_at',null)->exists();
                if($transaction_cost_exists){
                    throw new AppException('Transaction Cost Exists for this Payment Gateway.');
                }
                $insert_array = [
                    'payment_gateway'   => $request->payment_gateway, 
                    'shopify_percentage_fee'    => $request->shopify_percentage_fee, 
                    'percentage_fee'    => $request->percentage_fee, 
                    'fixed_fee'         => $request->fixed_fee
                ];

                $id = TransactionCost::insertGetId($insert_array);

                $delete_button = '<button id = "transaction_cost_loader_'.$id.'" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </button>
                                            <button type="button" class="close transaction_cst_btn" aria-label="Close" data-url="'.route('delete_transaction_cost').'" data-request="inline-post-ajax" data-method="post" data-variable="transaction_cost_id" data-transaction_cost_id="'.$id.'" data-show_error="#transaction_cost_error" data-disable_element_class=".transaction_cst_btn" data-loader="#transaction_cost_loader_'.$id.'" data-swal_message="Are You Sure to Delete.">
                                              <span aria-hidden="true"><i class="fa fa-trash"></i></span>
                                            </button>';

                $json_array = ['datatable_row' => [ucfirst($request->payment_gateway),$request->shopify_percentage_fee,$request->percentage_fee,$request->fixed_fee,$delete_button],'close_modal'=>true,];
                return response()->data($json_array,'Transaction Cost Updated.');
            }
        }
        throw new AppException('Invalid http method');
    }

    public function deleteTransactionCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'transaction_cost_id' => 'required' 
            ];

            $validation_attributes = [
            ];

            $validation_message = [];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                TransactionCost::where('id',$request->transaction_cost_id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                return response()->data(['remove_datatable_row'=>true],'Transaction Cost Deleted');
            } 
        }
    }

    public function customCost(Request $request)
    {
      
        $data = ['current_link' => 'custom_cost'];
        $getCategorylist=BusinessCategory::where('status','1')->where('deleted_at',null)->get();
        $getBusinelist=BusinessCustomCost::where('deleted_at',null)->get();
        $result=[
          "data" => $data,
          'getCategorylist'=>$getCategorylist,
          'getBusinelist'=>$getBusinelist
        ];
        return view('business_app/content_template/custom_cost',$result);
    }

    public function submitCustomCost(Request $request)
    {
    
        $request->validate([
            'name' => 'required',
            'frequency_name' => 'required',
            // 'category_id' => 'required',
            'cost' => 'required',
            'start_date' => 'required',
            'end_date' => '',
            
        ]);
        

        if(isset($request->inlineitem) && $request->inlineitem == 1){
            $status=1;
        }
        else{
            $status=0;
        }

        $currentPackegName=Str::slug($request['name']);
        @$getDublicateData = BusinessCustomCost::where('custom_slug',$currentPackegName)->get();
       
 
        if(@$getDublicateData['0']['custom_slug']==$currentPackegName){
            $product = BusinessCustomCost::find(@$getDublicateData['0']['id']); //get the object of product you want to update
            $product->custom_name =  $request['name'];
            $product->frequency =  $request['frequency_name'];
            // $product->category_id = $request['category_id'];
            $product->cost =  $request['cost'];
            $product->start_date =  $request['start_date'];
            $product->end_date =  $request['end_date'];
            $product->accept_include_marketing =$status;
            $product->deleted_at = null;
            $product->save();
        }else{
            $getInsertedData = BusinessCustomCost::updateOrCreate(['id'=>$request['id']],[
                "custom_name" => $request['name'],
                "frequency" => $request['frequency_name'],
                // "category_id" => $request['category_id'],
                "cost" => $request['cost'],
                'custom_slug'=>Str::slug($request['name']),
                "start_date" => $request['start_date'],
                "end_date" => $request['end_date'],
                "accept_include_marketing" => $status,
            ]);
        }

        return redirect('business/expenses/custom-cost')->with('message', 'Custom cost added  successfully'); 
    }

    public function deleteCustomCost($id){
        try{
      
            $userDelete=BusinessCustomCost::findOrFail($id);
            $userDelete->update(['deleted_at'=>date('Y-m-d H:i:s')]);
        }catch(\Exception $e) {}

        return back()->with('success', 'Custom Cost deleted successfully');
    }

    public function syncShopifyData(Request $request)
    {
        if(isset($request->module_name) && $request->module_name == 'shopify_products'){
            SyncShopifyProducts::dispatch(Auth::User()->id);
            return response()->success('Request to sync Shopify Products initiated.Will be synced shortly.');
        }
    }

    public function addProductCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'product_cost' => ['required','numeric','gt:0', 'regex:/^\d{0,4}(\.\d{0,2})?$/i'], 
                'start_date'   => '', 
                'end_date'     => '', 
            ];

            $validation_attributes = [
            ];

            $validation_message = [
                'product_cost.regex' => 'Upto 4 digits before and 2 digits after decimal are allowed (xxxx.xx or xxxx).'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $insert_array = [
                    'variant_id'                => $request->variant_id,
                    'profitrack_product_cost'   => $request->product_cost,
                    'start_date'                => date('Y-m-d',strtotime($request->start_date)),
                    'end_date'                  => isset($request->end_date) ? date('Y-m-d',strtotime($request->end_date)) : null,
                    'created_at'                => date('Y-m-d H:i:s')
                ];

                $id = ShopifyProductVariantCost::insertGetId($insert_array);

                $json_array = ['append_html' => '<div id="product_cost_'.$id.'" class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="product_cost" value="'.$request->product_cost.'" readonly>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="start_date" value="'.$request->start_date.'" readonly="readonly">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="end_date" value="'.$request->end_date.'" readonly="readonly">
                        </div>
                        <div class="col-md-3">
                            <button id = "product_cost_loader_'.$id.'" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="close" aria-label="Close" data-url="'.route('delete_product_cost').'" data-request="inline-post-ajax" data-method="post" data-variable="product_cost_id" data-product_cost_id="'.$id.'" data-show_error="#product_cost_error" data-disable_element_class=".product_cst_btn_'.$id.'" data-loader="#product_cost_loader_'.$id.'" data-swal_message="Are You Sure to Delete." data-remove_element="#product_cost_'.$id.'">
                              <span aria-hidden="true"><i class="fa fa-trash"></i></span>
                            </button>
                        </div>
                    </div>'];
                return response()->data($json_array,'');
            } 
        }
    }

    public function deleteProductCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'product_cost_id' => 'required' 
            ];

            $validation_attributes = [
            ];

            $validation_message = [];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                ShopifyProductVariantCost::where('id',$request->product_cost_id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                return response()->success('');
            } 
        }
    }

    public function addShippingCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'variant_id' => 'required',
                'country' => 'required', 
                'shipping_cost'   => 'required|numeric|gt:0|regex:/^\d{0,4}(\.\d{0,2})?$/i',
            ];

            $validation_attributes = [
            ];

            $validation_message = [
                'shipping_cost.regex' => 'Upto 4 digits before and 2 digits after decimal are allowed (xxxx.xx or xxxx).'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                $country_already_exists = ShopifyProductVariantShippingCost::where('variant_id',$request->variant_id)->where('country',$request->country)->exists();

                if($country_already_exists){
                    throw new AppException('Shipping Cost already exists for this product and country.');
                }
                $insert_array = [
                    'variant_id'      => $request->variant_id,
                    'country'         => $request->country,
                    'shipping_cost'   => $request->shipping_cost,
                    'created_at'      => date('Y-m-d H:i:s')
                ];

                $id = ShopifyProductVariantShippingCost::insertGetId($insert_array);

                $json_array = ['append_html' => '<div id="shipping_cost_'.$id.'" class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="country" value="'.$request->country.'" readonly="readonly">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="shipping_cost" value="'.$request->shipping_cost.'" readonly>
                        </div>
                        <div class="col-md-3">
                            <button id = "shipping_cost_loader_'.$id.'" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="close" aria-label="Close" data-url="'.route('delete_shipping_cost_per_product').'" data-request="inline-post-ajax" data-method="post" data-variable="shipping_cost_id" data-shipping_cost_id="'.$id.'" data-show_error="#shipping_cost_error" data-disable_element_class=".shipping_cst_btn_'.$id.'" data-loader="#shipping_cost_loader_'.$id.'" data-swal_message="Are You Sure to Delete." data-remove_element="#shipping_cost_'.$id.'">
                              <span aria-hidden="true"><i class="fa fa-trash"></i></span>
                            </button>
                        </div>
                    </div>'];
                return response()->data($json_array,'');
            } 
        }
    }

    public function deleteShippingCost(Request $request)
    {
        if($request->isMethod('post')){
            $validation_array = [
                'shipping_cost_id' => 'required' 
            ];

            $validation_attributes = [
            ];

            $validation_message = [];
            
            $validator = Validator::make($request->all(), $validation_array,$validation_message,$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);
            }else{
                ShopifyProductVariantShippingCost::where('id',$request->shipping_cost_id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                return response()->success('');
            } 
        }
    }
}
