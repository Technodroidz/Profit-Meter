<?php 

use App\Model\PermitedTable;
use App\Model\User;
use App\AdministrativeModel;
use App\UnderSecretiantModel;
use App\SecretiantModel;
use App\InvoiceModel;
use App\DeviceModel;

    function pp($arr, $die="true")
    {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
            if($die == 'true')
            {
                die();
            }
    }
    function _print_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    // Single image upload function start here

    function uploadSingleImages($image,$folderName){

        $name = $folderName."/profitmetear".rand().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/'.$folderName);
        $image->move($destinationPath, $name);
        return $name;
    }

    // single image upload function End here

    // multiple image upload function start here

    function uploadMultipleImages($arrayImage,$folderName){
    	$images=array();
    	foreach($arrayImage as $file){
            $name=$file->getClientOriginalName(); // this code for save images in original name
    		$destinationPath = public_path('/images/'.$folderName);
            $file->move($destinationPath,$name);
            $images[]=$name;
        }
        return $images;
    }

    // multiple image upload function End here

    // delete image function start here 

    function deleteImage($fileName){
    	File::delete("images/admin/seo_user/gif.gif");  //with full path
    	return 0;
    }

    // delete image function End here 

    // export in excel function is start here

    function customExportExcel($fileName,$testingSheet,$dataArray){
        
        Excel::create($fileName, function($excel) use ($dataArray,$testingSheet){
            $excel->setTitle('Customer Data');
            $excel->sheet($testingSheet, function($sheet) use ($dataArray){
                $sheet->fromArray($dataArray, null, 'A1', false, false);
            });
        })->download('xlsx');
        
    }

    // export in excel function is End here

    //date final format function start here for view time
    function customFrontendDateChange($date){
        return date('d/m/Y h:i A',strtotime($date));
    }
    //date final format function End here for view time

    // submit Date time format in DB Start

    function customBackendDateChange($date){
        return date('Y-m-d h:i:s',strtotime($date));
    }

    //Submit DAte time format in DB End

    function getUniqqueId(){
        $number = mt_rand(1000000000, 9999999999); 
        return "OMPINV".$number;
    }

    /** genrate unic count */
    function getUniqqueCounterId(){
        $number = mt_rand(10000, 99999); 
        return $number;
    }

    /** Get user name */
    function getuserName($id){
        $name = User::select('name')->where('id',$id)->get();
        return $name['0']['name'];
    }


    function generateStringLogToken()
    {
        $number =(Str::random(15));
        return $number.mt_rand(10000, 99999);
    }

    function generateStringSortToken()
    {
        $var = Str::random(5);
        return $var;
    }

    function get_message_from_validator_object($validator_object)
    {
        $array = json_decode(json_encode($validator_object),1);
        $message = '';
        $message_array = [];
        $i = 0;
        foreach ($array as $key => $value) {
            foreach ($value as $k => $val) {
                if(!in_array($val,$message_array)){
                    $message_array[] = $val;
                    $tilde    = $i == 0 ? '':" ";
                    $message .= $tilde.$val;
                    $i++;
                }
            }
        }
        return $message;
    }

    function refresh_snapchat_access_token($refresh_token)
    {
        $client_id      = env('SNAPCHAT_CLIENT_ID');
        $client_secret  = env('SNAPCHAT_CLIENT_SECRET');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://accounts.snapchat.com/login/oauth2/access_token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'client_id='.$client_id.'&client_secret='.$client_secret.'&refresh_token='.$refresh_token.'&grant_type=refresh_token',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response,1);
        return $response;
    }

?>