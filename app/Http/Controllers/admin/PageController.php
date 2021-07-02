<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PageController extends Controller
{
    public function index(){

        $getTempleteData = Page::all();
        $result = [
            'getTempleteData' => $getTempleteData,
        ];
        return view('admin.super-admin.main-page.index', $result);
    
    }

    public function AddPage(){
     
        return view('admin.super-admin.main-page.addUpdatePage');

    }

    public function editPage($id){

        $getmaster=Page::where('id',$id)->get();
          $result = [
            'getdata'=>$getmaster,
        ];
    
        return view('admin.super-admin.main-page.addUpdatePage',$result);
    }

    public function submitPage(Request $request){

        $request->validate([
            'long_description' => 'required',
        ]);
      
        $getInsertedData = Page::updateOrCreate(['id'=>$request['table_id']],[
            "long_description" => $request['long_description']
        ]);

        return redirect('view_pages')->with('message', 'Page added  successfully'); 
    
    }

  

    public function deletePage($id){
        $templete=Page::findOrFail($id);
        $templete->delete();
        return back()
            ->with('success', 'Record deleted successfully');
    }

    public function changeStatus(Request $request){

        $request->validate([
            'id' => 'required',
        ]);
      if($request->status==='true'){
        $status=1;
      } 
      if($request->status==='false'){
        $status=2;
      } 
     
        $getData = Page::updateOrCreate(['id'=>$request['id']],[
            "status" => $status,
        ]);
        $result=[
            'ststus'=>"200",
            'data'=>"change status",
        ];

        
        return response()->json($result);
       
    
    }

}
