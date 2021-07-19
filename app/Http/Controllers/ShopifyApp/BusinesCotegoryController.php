<?php

namespace App\Http\Controllers\ShopifyApp;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPShopify\ShopifySDK;
use Illuminate\Support\Str;
use Log;
use App\Model\User;
use App\Model\BusinessCategory;
use App\Model\MultiTenantModel;

class BusinesCotegoryController extends Controller
{
    public function index(Request $request)
    {
        
        $data = ['current_link' => 'cotegory'];
        $getCategorylist=BusinessCategory::where('deleted_at',null)->get();
        $result=[
          "data" => $data,
          'getCategorylist'=>$getCategorylist,
        ];
        return view('business_app/content_template/cotegory_page',$result);
    }

    public function submitCategory(Request $request)
    {
       
      
        $request->validate([
            'name' => 'required',
        ]);

        $currentPackegName=Str::slug($request['name']);
        @$getDublicateData = BusinessCategory::where('slug_name',$currentPackegName)->get();

        if(@$getDublicateData['0']['slug_name']==$currentPackegName){
          $product = BusinessCategory::find(@$getDublicateData['0']['id']); //get the object of product you want to update
          $product->category_name =  $request['name'];
          $product->deleted_at = null;
          $product->save();
        }else{
        $getInsertedData = BusinessCategory::updateOrCreate(['id'=>$request['id']],[
          "category_name" => $request['name'],
          "slug_name"=>str::slug($request['name']),
        ]); 
        
        }

        return redirect('business/category')->with('message', 'Category added  successfully'); 
    }

    public function changeStatus(Request $request){

     $request->validate([
            'id' => 'required',
     ] );

      if($request->status==='true'){
        $status=1;
      } 
      if($request->status==='false'){
        $status=2;
      } 
     
        $getData = BusinessCategory::updateOrCreate(['id'=>$request['id']],[
            "status" => $status,
        ]);
        $result=[
            'ststus'=>"200",
            'data'=>"change status",
        ];

        
        return response()->json($result);
       
    
    }
    public function deleteCategory($id){
      try{
        
        $userDelete=BusinessCategory::findOrFail($id);
        $userDelete->update(['deleted_at'=>date('Y-m-d H:i:s')]);
        } catch(\Exception $e) {
    //return response($e->getMessage(), 422);
        }
        return back()
            ->with('success', 'Category deleted successfully');
    }

}
