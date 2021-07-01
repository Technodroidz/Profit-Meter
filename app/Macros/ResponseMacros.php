<?php

namespace App\Macros;

use Exception;

class ResponseMacros
{
    /**
     * Refuse an unauthenticated user
     * @return \Closure
     */
    public function refuse()
    {
        return function ($message = 'Unauthorised Token') {
            return $this->json(['success'=> false,'message' => $message, 'code' => 1401]);
        };
    }

    /**
     * Application Exception
     * @return \Closure
     */
    public function apiException()
    {
        return function(Exception $exception,$errors = [],$error_code= 1400,$http_code = 200){

            $response['success'] =false;

            $response['code'] = $error_code;
    
            $response['message'] = $exception->getMessage();
            // $response['data'] = (object)[];
            if(is_array($errors) && !empty($errors) && $error_code==1120){
                
                $response['message'] =$response['message'].='[#SPLIT]'.$errors['link'];
            }else{
                if(is_array($errors) && !empty($errors)){
                    $response['errors'] = $errors;
                }
            }
            return response()->json($response,$http_code);
        };
    }
     /**
     * Send a failure response
     * @return \Closure
     */
    public function failure()
    {
        return function ($message = 'Failure') {
            return $this->json(['message' => $message]);
        };
    }

    /**
     * Send a failure response
     * @return \Closure
     */
    public function success()
    {
        return function (string $message = "Success", int $code = 1000) {
            return  $this->json(['success'=> true,'message' => $message, 'code' => $code]);        };
    }

    /**
     * Send a failure response
     * @return \Closure
     */
    public function data()
    {
        return function (array $value = [],string $message = "Success", int $code = 1000) {
            return  $this->json(['success'=> true,'message' => $message, 'code' => $code,'data' => $value]);        };
    }

    
    /**
     * Forbid an unauthorized user
     * @return \Closure
     */
    public function forbid()
    {
        return function ($message = 'Unauthorized.') {
            return $this->json(['success'=> false,'message' => $message, 'code' => 1403]);
        };
    }


    public function routeNotFound()
    {
        return function ($message = 'Route Not Found') {
            return $this->json(['success'=> false,'message' => $message, 'code' => 1404]);
        };
    }

}