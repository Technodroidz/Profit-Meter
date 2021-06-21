<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Vehicle;
use App\Model\VehicleType;
use App\Model\CabSearch;
use App\Model\ContactUs;

class MainController extends Controller
{
    public function contactUs(){

        return view('front.contactus');
    }

    public function submitContact(Request $request){

         $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $getContactData = ContactUs::create([

            'name' =>$request->name,
            'email' =>$request->email,
            'subject' =>$request->subject,
            'message' =>$request->message,
        ]);
        return redirect()->back();
    }
}