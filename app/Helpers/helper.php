<?php 

use App\Model\PermitedTable;
use App\Model\User;
use App\AdministrativeModel;
use App\UnderSecretiantModel;
use App\SecretiantModel;
use App\InvoiceModel;
use App\DeviceModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

    function makeDBConnection($database_name='')
    {
        config([
            'database.connections.tenant.database' => $database_name,
        ]);

        DB::purge('tenant');

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }

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

    function country_list()
    {
        return array("Worldwide","Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
    }

    function payment_gateway_list($gateway_alias = '')
    {
        $array = [
            'affirm'=>'Affirm',
            'afterpay'=>'Afterpay',
            'amazon_marketplace'=> 'Amazon MaketPlace',
            'amazon_payments'=> 'Amazon Payments',
            'authorize.net'=> 'Authorize.Net',
            'bitpay'=> 'BitPay',
            'braintree'=> 'Braintree',
            'bread'=> 'Bread',
            'checkout_finland'=> 'Checkout Finland',
            'coinbase'=> 'Coinbase',
            'conekta'=> 'Conekta',
            'cyber_source'=> 'Cyber Source',
            'ebay_paypal'=> 'eBay/Paypal',
            'epay'=> 'Epay',
            'eway'=> 'eWay',
            'first_data'=> 'First Data',
            'google_express'=> 'Google Express',
            'google_express'=> 'Google Express',
            'klama'=> 'Klama',
            'laybuy'=> 'Laybuy',
            'mercado_pago'=> 'Mercado Pago',
            'mollie'=>'Mollie',
            'nmi'=>'NMI',
            'other'=>'Other',
            'payflow'=>'Payflow',
            'paypal'=>'PayPal',
            'paytrail'=>'Paytrail',
            'payu'=>'PayU',
            'quadpay'=>'QuadPay',
            'quickpay'=>'QuickPay',
            'sagepay'=>'SagePay',
            'sezzle'=>'Sezzle',
            'shopify_payments'=>'Shopify Payments',
            'spring'=>'Spring',
            'stripe'=>'Stripe',
            'viabill'=>'ViaBill',
            'visa'=>'Visa',
            'wanelo'=>'Wanelo',
        ];

        if(!empty($gateway_alias)){
            return $array[$gateway_alias];
        }else{
            return $array;
        }
    }

    function make_key_value_pair($db_array)
    {
        $result_array = [];
        foreach ($db_array as $key => $value) {
            // pp($value);
            foreach ($value as $k => $v) {
                if($k == 'key'){
                    if(!in_array($value['key'],$result_array)){
                        $result_array[$v] = $value['value'];
                    }
                }
            }
        }
        return $result_array;
    }

?>