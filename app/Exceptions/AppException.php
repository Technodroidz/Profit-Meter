<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AppException extends Exception
{
    protected  $error_obj;
    protected  $error_code;
    protected  $http_code;


/**
     * new App Exception
     * 
     * @return void
     */

     


     public function __construct(string $message = "Exception",$error_obj = null,int $error_code = 1400, int $http_code = 200)
     {
        $this->message =  $message;

        if(!empty($error_obj) && is_array($error_obj))
            $this->error_obj = $error_obj;

        $this->error_code = $error_code;
        $this->http_code = $http_code;
     }

      /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
    
        return  response()->apiException($this, $this->error_obj,$this->error_code,$this->http_code);

    }


    
}
