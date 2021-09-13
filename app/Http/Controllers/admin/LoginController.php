<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Admin;
use App\Model\Role;
use App\SecretiantModel;
use App\AdministrativeModel;
use App\UnderSecretiantModel;
use Mail; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Model\EmailTemplate;
use App\Model\UserSubscription;
use Illuminate\Support\Str;
use Config;

class LoginController extends Controller
{
	public function index(){
		if(Auth::guard('webadmin')->check()){
            if(Auth::guard('webadmin')->user()->role == Config::get('constants.user_role.super-admin') || Auth::guard('webadmin')->user()->role == Config::get('constants.user_role.sub-admin') || Auth::guard('webadmin')->user()->role == Config::get('constants.user_role.admin')){
                return redirect('admin-panel');
            }else{
                return view('admin.login');
            }
		}else{
			return view('admin.login');
		}
    }

    public function userList(){
 
       $getdata = User::where('deleted_at',null)->get();
       foreach ($getdata as $key => &$value) {
            $trial_subscription = UserSubscription::getTrialSubscription($value->id);
            $paid_subscription  = UserSubscription::getPaidSubscription($value->id);
            $user_subscribed    = 'Subscribed';
            $plan_name          = '';
            $subscription_date  = '';

            if(empty($paid_subscription) && empty($trial_subscription)){
                $user_subscribed    = 'Unsubscribed';
            }else{
                if(empty($paid_subscription) && !empty($trial_subscription)){
                    
                    $expire = strtotime($trial_subscription->expiry_date);
                    $today  = strtotime("today midnight");

                    $plan_name        = $trial_subscription->plan_name;

                    if($today > $expire){
                        $user_subscribed  = 'Trial Expired';
                        $subscription_date  = $trial_subscription->created_at;
                    }else{
                        $user_subscribed    = 'On Trial';
                        $subscription_date  = $trial_subscription->created_at;
                    }
                }
            }

            if(!empty($paid_subscription)){
                $plan_name = $paid_subscription->plan_name;
                $subscription_date  = $paid_subscription->created_at;

            }
            $value->plan_name = $plan_name;
            $value->subscription_status = $user_subscribed;
            $value->subscription_date   = $subscription_date;

       }
       return view('admin.super-admin.user-file.user-list',compact('getdata'));

    }

    public function addUser(){

        $menu_active="1";
      
        $getSerialData=SecretiantModel::latest()->get();
        $getUnderSecratiant=UnderSecretiantModel::latest()->get();
        $getAdminList=AdministrativeModel::latest()->get();
        $getUserList = Role::where('status',1)->get();

        $result = [
            'getSecretiantList'=>$getSerialData,
            'getUnderSecratiant'=>$getUnderSecratiant,
            'getAdminList'=>$getAdminList,
            'getUserList'=>$getUserList
        ];
       
        return view('admin.super-admin.user-file.add-update-user',$result);


    }

    public function userUpdate($id){

        $getdata = User::where('id',$id)->get();
        $menu_active="1";

        $result = [
            'getdata'=>$getdata,
            'menu_active'=>$menu_active,
        ];
       
     
        return view('admin.super-admin.user-file.update-user', $result);


    }
/** update current user  */


public function UpdateUserDetail(Request $request){

    $dublicatCheck  = User::where('id',$request['id'])->get();
   
    $request->validate([
        'name' => 'required',
        'last_name' => 'required',
        'number' => 'required|integer',
        'shofiy_store_url' => 'required',
    ]);

    if(!empty($request['password'])){
        try {
        $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
            "name" => $request['name'],
            "last_name" => $request['last_name'],
            "number" => $request['number'],
            "shopify_url" => $request['shofiy_store_url'],
            "password" => bcrypt($request['password']),
            "role_id" => 2,
        ]);
        $token = Str::random(64);
        $getSubscribData=EmailTemplate::where('page_type','forgot_password')->get();
        Mail::send('admin/email_template/forgot_password_email', ['token' => $token,'password'=>$request['password'],'getInsertedData'=>$getInsertedData,'getSubscribData'=>$getSubscribData], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Your Profit-Meter Password');
        });
        } catch(\Exception $e) {
       // return response($e->getMessage(), 422);
        }
    }else{
        try{
        $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
            "name" => $request['name'],
            "last_name" => $request['last_name'],
            "number" => $request['number'],
            "shopify_url" => $request['shofiy_store_url'],
            "role_id" => 2,
        ]);
        $token = Str::random(64);
    
        Mail::send('admin/email_template/forgot_password_email', ['token' => $token,'password'=>""], function($message) use($request){
            $message->to($request->email);
            $message->subject(' Your Profit-Meter Profile Updated');
        });
        } catch(\Exception $e) {
    // return response($e->getMessage(), 422);
        }
    }
    
   
    return redirect('user-list')->with('success', 'Update  successfully'); 

}

    /** submit product url */
public function UpdateUser(Request $request){

    $dublicatCheck  = Admin::where('id',$request['id'])->where('status',1)->get();

    $getUserList = Role::where('id',$request['role_id'])->get();
  
    if(!empty($request['0']['password'])){

        $password= $dublicatCheck['0']['password'];

    } else{

        $password= bcrypt($request['password']);
    }

    if(@$dublicatCheck['0']['email']== $request['email']){

    $request->validate([
        'role_id' => 'required|integer',
        'position' => 'required',
        'secretariant' => 'required',
        'adminstration_unit' => 'required',
        'under_secretarian' => 'required',
      
    ]);
   }else{
    $request->validate([
        'email' => 'required|email|unique:users',
        'role_id' => 'required|integer',
        'position' => 'required',
        'secretariant' => 'required',
        'adminstration_unit' => 'required',
        'under_secretarian' => 'required',
        'passsword' => 'required',
       
    ]);
   }

    $getInsertedData = Admin::updateOrCreate(['id'=>$request['id']],[
        
        "name" => $request['name'],
        "username" => $request['name'],
        "email" => $request['email'],
        "role_id" => $request['role_id'],
        "position" => $request['position'],
        "secretariant" => $request['secretariant'],
        "adminstration_unit" => $request['adminstration_unit'],
        "under_secretarian" => $request['under_secretarian'],
        'users'=>$getUserList['0']['role_name'],
        "password" =>$password,
        "status" => 1,
    ]);
  
   
    return redirect('user-list')->with('success', 'Added  successfully'); 

}
/**end funtion */
    public function checkUser(Request $request){
    	$result = $this->checkCredentialConditions($request->email);
    	return response()->json($result);
    }

    public function checkCredentialConditions($email){
        
        $userType    = Admin::with('getUserType')->where('status',1)->where('email',$email)->first();
        $valid_roles = Config::get('constants.user_role');
        
        if(isset($userType) && !empty($userType)){
           
            if( $userType->getUserType->role_name){
                $userType = $userType->getUserType->role_name;
                $valid = "Valid";
                $matchIPStatus = 'allow';
                $msg = "Your user type is ".$userType;
            }else{
                if(in_array($userType->getUserType->role_name,$valid_roles)){
                    $userType = $userType->getUserType->role_name;
                    $valid = "Valid";
                    $matchIPStatus = 'allow';
                    $msg = "Your user type is ".$userType;
                }else{
                    $userType = 'not match';
                    $valid = "Invalid";
                    $matchIPStatus = 'disallow';
                    $msg = "Please login in valid system Dilip";
                }
            }
        }else{
            $userType = 'not match';
            $valid = "Invalid";
            $matchIPStatus = 'disallow';
            $msg = "Please Enter valid email id";
        }

        $result = array(
            'user_type' => $userType,
            'ipCheck'   => $matchIPStatus,
            'isValid'   => $valid,
            'msg'       => $msg,
        );

        return $result;

    }

    public function authenticate(Request $request)
    {
        $userType = Admin::with('getUserType')->where('status',1)->where('email',$request->email)->first();
        $result = $this->checkCredentialConditions($request->email);
        if($result['isValid'] == 'Valid'){
            $credentials = $request->only('email', 'password');
            if (Auth::guard('webadmin')->attempt($credentials)) {
                $result_status['status']="valid";
                return response()->json($result_status);
            }else{
                $result_status['status']="invalid";
                return response()->json($result_status);
                //return Redirect::back()->withErrors(['Wrong email and password']);
            }
        }else{
            $result_status['status']="invalid";
            return response()->json($result_status);
        }
    }

    public function register(Request $request){
        $attribute = array(
            'gst_no' => 'GST Number',
			'name' => 'User Name ',
            'email' => 'Email Id',
            'password'=> 'Password',
		 );

		$validator = Validator::make($request->all(), [
            'gst_no' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
		]);
		
		$validator->setAttributeNames($attribute);

		if ($validator->fails()) {
			if(isset($request->user_id) && !empty($request->user_id)){
				return redirect()->back()->with('message', \Config::get('constants.Messages.success'));
			}
            return redirect('role-form')
                        ->withErrors($validator)
                        ->withInput();
        }else{
			$roleData = Admin::create([
				"name" => $request->name,
				"gst_no" => $request->gst_no,
				"email" => $request->email,
				"role_id" => 3,
				"username" => 'vendor',
				"password" => bcrypt($request->password),
			]);
			return redirect()->back()->with('message', \Config::get('constants.Messages.success'));
		}
		return Redirect::back()->withErrors(['msg', 'The Message']);
    }

    public function logout(Request $request) {
	  Auth::guard('webadmin')->logout();
	  return redirect('admin-login-panel')->withErrors(['You have successfully logout']);
	}

    public function deleteUser($id){
      try{
        $userDelete=User::findOrFail($id);
        
        $userDelete->forceDelete();
        Mail::send('admin/email_template/user_delete_account', ['userData' => $userDelete,'password'=>""], function($message) use($userDelete){
            $message->to($userDelete['email']);
            $message->subject(' Your account has been deleted');
        });
        } catch(\Exception $e) {
    //return response($e->getMessage(), 422);
        }
        return back()
            ->with('success', 'User deleted successfully');
    }

    public function userStatusChange(Request $request){
        $changeStatus=User::findOrFail($request->id);
        if($changeStatus){
         try{

            $status=0;
            if($request->status=="true"){
                $status=1;
            }
            $changeStatus->update([
                'status'=>$status,
             ]);

             Mail::send('admin/email_template/user_account_status', ['userData' => $changeStatus], function($message) use($changeStatus){
                $message->to($changeStatus['email']);
                $message->subject(' Your account status');
            });
           
             return response()->json($changeStatus);
            } catch(\Exception $e) {
                return response($e->getMessage(), 422);
            }
        }
        return response()->json(['error'=>'get error'],422);

    }

}
