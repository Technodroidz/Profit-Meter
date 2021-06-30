<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserGoogleAccount;
use App\Exceptions\AppException;
use Auth;
use Illuminate\Support\Facades\Validator;

class IntegrationController extends Controller
{
    public function integration(Request $request)
    {
        $google_account = UserGoogleAccount::getGoogleAccountByUserid(Auth::User()->id);
        $data = ['current_link' => 'integration','google_account' => $google_account];
        
        return view('business_app/content_template/integration',$data)->render();
        echo json_encode($html);
    }

    public function updateGoogleAdsSettings(Request $request)
    {
        if($request->isMethod('post')){

            $validation_array = [
                'customer_id'      => 'required',            
                'developer_token'  => 'required'         
            ];

            $validation_attributes = [
                'customer_id'                      => 'Customer ID',
                'developer_token'                  => 'Developer Token'
            ];
            
            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                throw new AppException($validation_message);   
            }else{
                $insert_array = [
                    'google_ads_customer_id'       => $request->customer_id,
                    'google_ads_developer_token'   => $request->developer_token,
                ];
                
                UserGoogleAccount::where('user_id',Auth::User()->id)->update($insert_array);

                $google_account = UserGoogleAccount::getGoogleAccountByUserid(Auth::User()->id);
                $data = ['current_link' => 'integration','google_account' => $google_account];
                
                $html_view = view('business_app/ajax_template/google_app_integration',$data)->render();

                $json_array = ['close_modal' => true,'replace_html' => true,'html_view' => $html_view];
                return response()->data($json_array);
            }
        }

        return response()->routeNotFound();
    }
}
