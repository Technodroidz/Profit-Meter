<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;
use Illuminate\Support\Facades\Auth;
use App\Model\BusinessCategory;
use App\Model\BusinessCustomCost;
use Illuminate\Support\Str;
class ExpenseController extends Controller
{
    public function productCost(Request $request)
    {
        $config = array(
            'ShopUrl' => Auth::User()->shopify_url,
            'AccessToken' => Auth::User()->shopify_access_token,
        );

        $shopify    = new \PHPShopify\ShopifySDK($config);
        
        $products = $shopify->Product->get();
        pp($products);
        $data = ['current_link' => 'product_cost','products'=>$products];

        return view('business_app/content_template/product_cost',$data);
    }

    public function shippingCost(Request $request)
    {
        $data = ['current_link' => 'shipping_cost'];

        return view('business_app/content_template/shipping_cost',$data);
    }

    public function handlingCost(Request $request)
    {
        $data = ['current_link' => 'handling_cost'];
        return view('business_app/content_template/handling_cost',$data);
    }

    public function transactionCost(Request $request)
    {
        $data = ['current_link' => 'transaction_cost'];
        return view('business_app/content_template/transaction_cost',$data);
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
            'category_id' => 'required',
            'cost' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            
        ]);
       
        if($request->inlineitem==='on'){
            $status=1;
          }
         else if(empty($request->inlineitem)){
            $status=2;
          } 
          if($request->inlineitem==='2'){
            $status=1;
          }
          if($request->inlineitem==='1'){
            $status=2;
          }
        //   print_r($request->all()); exit;

        $currentPackegName=Str::slug($request['name']);
        @$getDublicateData = BusinessCustomCost::where('custom_slug',$currentPackegName)->get();
       
 
        if(@$getDublicateData['0']['custom_slug']==$currentPackegName){
            $product = BusinessCustomCost::find(@$getDublicateData['0']['id']); //get the object of product you want to update
            $product->custom_name =  $request['name'];
            $product->frequency =  $request['frequency_name'];
            $product->category_id = $request['category_id'];
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
            "category_id" => $request['category_id'],
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
        } catch(\Exception $e) {
        }
        return back()
            ->with('success', 'Category deleted successfully');
    }
}
