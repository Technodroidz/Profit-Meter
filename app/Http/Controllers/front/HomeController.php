<?php


namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Carbon\Carbon;
use Session;
use Dirape\Token\Token;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\UserSubscription;
use Schema;
class HomeController extends Controller
{

    public function resisterUser(){
        return view('front.add-user');
    }

       /** submit product url */
public function SubmitUserForm(Request $request){

    $long_token=generateStringLogToken();
    $short_token=generateStringSortToken();
    $dbName=Str::slug($request['name'], '_');
   
    $request->validate([
        'email' => 'required|email|unique:users',
        'bussiness_name' => 'required',
        'last_name' => 'required',
        'name' => 'required',
        'number' => 'required',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6',
        'ur' => 'required',
    ]);
    

    $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
        
        "name" => $request['name'],
        "email" => $request['email'],
        "bussiness_name" => $request['bussiness_name'],
        "number" => $request['number'],
        "role" => 2,
        'users'=>'user',
        "last_name" => $request['last_name'],
        "shopify_url" => $request['ur'],
        "password" =>bcrypt($request['password']),
        'short_token'=>$short_token,
        'long_token'=>$long_token,
        "status" => 1,

    ]);
  
    $userName = 'dummy_'.$short_token;  // Your Database name to be created

    DB::statement("CREATE DATABASE $userName");

    $conn = mysqli_connect('localhost', 'root', '' , $userName);
    $query = '';

    // $sqlScript = file('db/dummy.sql');
    $sqlScript = public_path('db\dummy.sql');
    
    $sqlScript = file($sqlScript);
   
    foreach ($sqlScript as $line)	{
        
        $startWith = substr(trim($line), 0 ,2);
        $endWith = substr(trim($line), -1 ,1);
        
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }
            
        $query = $query . $line;
        if ($endWith == ';') {
            mysqli_query($conn,$query);
            $query= '';		
        }
    }

    return back()->with('message', 'Added  successfully'); 

}

public function reportAdd(){
        
    return view('front.add-report');
}

public function SubmitReport(Request $request){


   
    $request->validate([
        'email' => 'required|email',
        'first_name' => 'required',
        'last_name' => 'required',
        'plan_name' => 'required',
        'plan_duration' => 'required',
        'plan_amount' => 'required',
        'contact' => 'required',
        'expiry_date' => 'required',
        'creation_date' => 'required',
    ]);
    

    $getInsertedData = UserSubscription::updateOrCreate(['id'=>$request['id']],[
        
        "email" => $request['email'],
        "first_name" => $request['first_name'],
        "plan_name" => $request['plan_name'],
        "last_name" => $request['last_name'],
        "plan_amount" => $request['plan_amount'],
        "plan_duration" => $request['plan_duration'],
        "contact" => $request['contact'],
        "expiry_date" => $request['expiry_date'],
        "creation_date" => $request['creation_date'],

    ]);

    return back()->with('message', 'Report Added  successfully'); 

}
    
    
    
}
