<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'],function(){
  	
	Route::get('login-panel','admin\LoginController@index');

	Route::get('user-list','admin\LoginController@userList');
	
	Route::get('add-user','admin\LoginController@addUser');

	Route::post('submit-user','admin\LoginController@submitUser');

	Route::get('edit-user/{id}','admin\LoginController@editUser');

	Route::get('check-user-id','admin\LoginController@checkUser');

	Route::get('user-delete/{id}','admin\LoginController@deleteUser');

	Route::post('login','admin\LoginController@authenticate');

	Route::get('logout','admin\LoginController@logout');

	Route::get('admin-panel','admin\HomeController@adminPanel');
	Route::get('user-update/{id}','admin\LoginController@userUpdate');
	Route::post('submit-user-update','admin\LoginController@UpdateUserDetail');
	/**Subsriptionpage url */
	Route::get('subscruption','admin\SubscruptionPlanController@subscribepage');
	Route::POST('submit-subscruption','admin\SubscruptionPlanController@submitsubscribepage');
	Route::get('subscruption-user-delete/{id}','admin\SubscruptionPlanController@deleteSubscription');
	Route::get('subscription-user-edit/{id}','admin\SubscruptionPlanController@editSubscription');

	Route::get('business','admin\BussinesController@businneuser');
	Route::post('submit-business','admin\BussinesController@submitBussiness');
	Route::get('bussiness-user-edit/{id}','admin\BussinesController@editBussiness');
	Route::get('busssiness-user-delete/{id}','admin\BussinesController@deleteBussiness');

	
	Route::get('profile','admin\ProfileController@profilePage');
	

	/** user setting url  */
	Route::get('paymentgatway','admin\SettingController@paymentGatway');
	Route::POST('submit-payment-configration','admin\SettingController@submitPaypalsetting');
	Route::get('email','admin\SettingController@emailPage');
	Route::POST('submit-email-configration','admin\SettingController@submitEmailsetting');
	/** end url */

	Route::get('subscribtion','admin\SubscruptionPlanController@subscribepage');

	/** end section */
	Route::post('submit-profile','admin\ProfileController@updateProfile');
	Route::post('submit-password-update','admin\ProfileController@updatePassword');
	/** end user */

	/** user list url   */
	
	/** Company Profile Update */
	Route::get('company-details','admin\ProfileController@CompanyDetail');
	Route::post('submit-update-company','admin\ProfileController@CompanyUpdateData');
	/** end  company */
		
});

Route::group(['middleware' => 'prevent-back-history'],function(){
  	
	Route::get('/','admin\HomeController@adminPanel');

	Route::get('user-register','front\HomeController@resisterUser');

	Route::post('submit-user-register','front\HomeController@SubmitUserForm');
	
	Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'front\PaypalController@payWithPaypal',));
	Route::post('paypal', array('as' => 'paypal','uses' => 'front\PaypalController@postPaymentWithpaypal',));
	Route::get('paypal', array('as' => 'status','uses' => 'front\PaypalController@getPaymentStatus',));
	
});



