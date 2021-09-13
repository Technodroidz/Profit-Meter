<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmailTemplate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TempleteController extends Controller
{
    public function index(){

        $getTempleteData = EmailTemplate::all();
        $result = [
            'getTempleteData' => $getTempleteData,
        ];
        return view('admin.super-admin.main-templete.index', $result);
    
    }

    public function AddTemplete(){
     
        return view('admin.super-admin.main-templete.addUpdateTemplete');

    }

    public function editTemplete($id){

        $getmaster=EmailTemplate::where('id',$id)->get();

          $result = [
            'getdata'=>$getmaster,
        ];
    
        return view('admin.super-admin.main-templete.addUpdateTemplete',$result);
    }

    public function submitTemplete(Request $request){

        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'long_description' => 'required',
        ]);
      
        $getInsertedData = EmailTemplate::updateOrCreate(['id'=>$request['table_id']],[
            "name" => $request['name'],
            "subject" => $request['subject'],
            "description" => $request['long_description']
        ]);

        return redirect('templete')->with('message', 'Templete added  successfully'); 
    
    
    }

    public function viewTemplete(Request $request){

        $getTempleteData = EmailTemplate::where('id',$request->id)->first();

        $result = [
            'getTempleteData' => $getTempleteData,
        ];

        return response()->json($result);
       
    
    }

    public function deleteTemplete($id){
        $templete=EmailTemplate::findOrFail($id);
        $templete->delete();
        return back()
            ->with('success', 'Record deleted successfully');
    }
}
