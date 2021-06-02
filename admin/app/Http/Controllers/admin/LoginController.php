<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Role;
use App\SecretiantModel;
use App\AdministrativeModel;
use App\UnderSecretiantModel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Model\Ip_address;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Config;

class LoginController extends Controller
{
	public function index(){
		if(Auth::check()){
            if(Auth::user()->username == Config::get('constants.user_role.super-admin') || Auth::user()->username == Config::get('constants.user_role.sub-admin') || Auth::user()->username == Config::get('constants.user_role.admin')){
                return redirect('admin-panel');
            }else{
                return view('admin.login');
            }
		}else{
			return view('admin.login');
		}
    }

    public function userList(){
 
       $getdata = User::where('status',1)->whereIn('role_id',['3','2'])->get();
       
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

        $getdata = User::where('id',$id)->where('status',1)->get();
        $menu_active="1";

        $result = [
            'getdata'=>$getdata,
            'menu_active'=>$menu_active,
        ];
       
     
        return view('admin.super-admin.user-file.update-user', $result);


    }
/** update current user  */


public function UpdateUserDetail(Request $request){

    $dublicatCheck  = User::where('id',$request['id'])->where('status',1)->get();

    $request->validate([
    
        'name' => 'required',
        'last_name' => 'required',
        'bussiness_name' => 'required',
        'number' => 'required|integer',
        'shofiy_store_url' => 'required',
       
       
    ]);

    $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
        
        "name" => $request['name'],
        "username" => $request['name'],
        "last_name" => $request['last_name'],
        "bussiness_name" => $request['bussiness_name'],
        "number" => $request['number'],
        "shofiy_store_url" => $request['shofiy_store_url'],
        "role_id" => 2,
        'email'=>$request['email'],
        'password'=>$request['password']
       
       
    ]);
   
    return redirect('user-list')->with('success', 'Added  successfully'); 

}

    /** submit product url */
public function UpdateUser(Request $request){

    $dublicatCheck  = User::where('id',$request['id'])->where('status',1)->get();

    $getUserList = Role::where('id',$request['role_id'])->get();
  
    if(!empty($request['0']['password'])){

        $password= $dublicatCheck['0']['password'];

    } else{

        $password= bcrypt($request['passsword']);
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

    $getInsertedData = User::updateOrCreate(['id'=>$request['id']],[
        
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
        
        $userType = User::with('getUserType')->where('status',1)->where('email',$email)->first();
        
        if(isset($userType) && !empty($userType)){
           
            if( $userType->getUserType->role_name){
                $userType = $userType->getUserType->role_name;
                $valid = "Valid";
                $matchIPStatus = 'allow';
                $msg = "Your user type is ".$userType;
            }else{
                if(@$userType->role_id == 3){
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
                if(@$userType->role_id == 2){
                    $userType = $userType->getUserType->role_name;
                    $valid = "Valid";
                    $matchIPStatus = 'allow';
                    $msg = "Your user type is ".$userType;
                }else{
                    $userType = 'not match';
                    $valid = "Invalid";
                    $matchIPStatus = 'disallow';
                    $msg = "Please login in valid system";
                }
                if(@$userType->role_id == 4){
                    $userType = $userType->getUserType->role_name;
                    $valid = "Valid";
                    $matchIPStatus = 'allow';
                    $msg = "Your user type is ".$userType;
                }else{
                    $userType = 'not match';
                    $valid = "Invalid";
                    $matchIPStatus = 'disallow';
                    $msg = "Please login in valid system";
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
        $userType = User::with('getUserType')->where('status',1)->where('email',$request->email)->first();
        $result = $this->checkCredentialConditions($request->email);
        if($result['isValid'] == 'Valid'){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
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
			$roleData = User::create([
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
	  Auth::logout();
	  return redirect('login-panel')->withErrors(['You have successfully logout']);
	}

    public function deleteUser($id){
      
        $productid=User::findOrFail($id);
        $productid->delete();
        return back()
            ->with('success', 'User deleted successfully');
    }
}
