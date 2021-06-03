<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\TidSystem;
use App\Model\MasterCategory;
use App\TIDReportModel;
use App\ContractModel;
use Config;

class homeController extends Controller
{
    public function adminPanel(){
        if(Auth::check()){
            return view('admin.super-admin.index');
		}else{
            return view('admin.login');
		}
    }   



    public function masterCategory(){

        $getmaster=MasterCategory::latest()->get();

          $result = [
            'getdata'=>$getmaster,
        ];
      
        return view('admin.super-admin.master-category',$result);

    }

    public function addmasterCategory(){

        return view('admin.super-admin.add-update-master-category');

    }

    public function editmasterCategory($id){

        $getmaster=MasterCategory::where('id',$id)->get();

          $result = [
            'getdata'=>$getmaster,
        ];
    
        return view('admin.super-admin.add-update-master-category',$result);

    }

    public function deletemasterCategory($id){

     
        $serviceclient=MasterCategory::findOrFail($id);
        $serviceclient->delete();
        return back()
            ->with('success', 'client deleted successfully');
      
    }

    public function submitMasterCotegory(Request $request){

        $request->validate([
            'master_category_name' => 'required',
           
        ]);
       
        $getInsertedData = MasterCategory::updateOrCreate(['id'=>$request['id']],[
            "master_category_name" => $request['master_category_name'],
            "status" => 0,
        ]);
        
        // $result = [
        //     'status' => 'Success',
        //     'getInsertedData'=>$getInsertedData,
        // ];
       
        return redirect('master-category')->withErrors(['You have successfully logout']); 

    }

    public function contractList(){

        $getContract=ContractModel::latest()->get();
        
        $menu_active="1";
                 $result = [
                   'getdata'=>$getContract,
                   'menu_active'=>$menu_active,
           ];

        return view('admin.super-admin.contract_list',$result);

    }

    public function addContract(){
        $menu_active="1";
        return view('admin.super-admin.add-update-contract',compact('menu_active'));
    }


    public function editContract($id){
        $getmaster=ContractModel::where('id',$id)->get();
        $menu_active="1";
        $result = [
            'getdata'=>$getmaster,
            'menu_active'=>$menu_active,
        ];
        return view('admin.super-admin.add-update-contract',$result);
    }

    public function submitContract(Request $request){


        $request->validate([
            'contract_name' => 'required',
            'contract_date' => 'required',
           
        ]);
       
        $getInsertedData = ContractModel::updateOrCreate(['id'=>$request['id']],[
            "contarct_name" => $request['contract_name'],
            "createDate" => $request['contract_date'],
        ]);
      
       
        return redirect('contract-list')->with('success', 'Contract added  successfully'); 
    
    
    }


public function deleteContract($id){
   
    $productid=ContractModel::findOrFail($id);
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
  
}
}
