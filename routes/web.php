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

Route::get('admin-panel','admin\HomeController@adminPanel')->name('admin_panel');
Route::get('admin','admin\HomeController@adminPanel');
Route::post('admin-login','admin\LoginController@authenticate');
Route::get('check-user-id','admin\LoginController@checkUser');

Route::group(['middleware' => ['prevent-back-history','auth:webadmin']],function(){
  	
	Route::get('admin-login-panel','admin\LoginController@index');

	Route::get('user-list','admin\LoginController@userList');
	
	Route::get('add-user','admin\LoginController@addUser');

	Route::post('submit-user','admin\LoginController@submitUser');

	Route::get('edit-user/{id}','admin\LoginController@editUser');


	Route::get('user-delete/{id}','admin\LoginController@deleteUser');


	Route::get('logout','admin\LoginController@logout');

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
	Route::get('paymentgateway','admin\SettingController@paymentGateway');
	Route::POST('submit-payment-configration','admin\SettingController@submitPaymentsetting');
	Route::get('email','admin\SettingController@emailPage');
	Route::POST('submit-email-configration','admin\SettingController@submitEmailsetting');
	/** end url */

	Route::get('subscription','admin\SubscruptionPlanController@subscribepage');	

	/** end section */
	Route::post('submit-profile','admin\ProfileController@updateProfile');
	Route::post('submit-password-update','admin\ProfileController@updatePassword');
	/** end user */

	/** user list url   */
	
	/** Company Profile Update */
	Route::get('company-details','admin\ProfileController@CompanyDetail');
	Route::post('submit-update-company','admin\ProfileController@CompanyUpdateData');
	/** end  company */
		
	Route::get('user-register','front\HomeController@resisterUser');

	Route::post('submit-user-register','front\HomeController@SubmitUserForm');
	
	Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'front\PaypalController@payWithPaypal',));
	Route::post('paypal', array('as' => 'paypal','uses' => 'front\PaypalController@postPaymentWithpaypal',));
	Route::get('paypal', array('as' => 'status','uses' => 'front\PaypalController@getPaymentStatus',));

});

// Shopify Account Login
Route::match(['POST','GET'],'connect-shopify-account','ShopifyApp\AuthController@loginWithShopify')->name('connect_shopify_account');
Route::get('authenticate','ShopifyApp\AuthController@authenticate')->name('authenticate');

Route::group(['middleware' => ['restrict.registered.user']],function(){
	Route::match(['POST','GET'],'business/register','ShopifyApp\AuthController@register')->name('business_register');
	Route::match(['POST','GET'],'business/forgot-password','ShopifyApp\AuthController@forgotPassword')->name('business_forgot_password');
	Route::get('business/reset-password/{token}', 'ShopifyApp\AuthController@resetPassword')->name('business_reset_password/{token}');
	Route::post('business/reset-password', 'ShopifyApp\AuthController@updateResetPassword')->name('update_business_reset_password');
	Route::match(['POST','GET'],'business/login','ShopifyApp\AuthController@login')->name('login');
}); 


Route::get('business/logout','ShopifyApp\AuthController@logout')->middleware(['auth:web'])->name('business_logout');

Route::group(['middleware' => ['auth:web','restrict.registered.user']],function(){
	Route::get('/','ShopifyApp\DashboardController@dashboard')->name('home');
	// ->middleware(['auth.shopify'])

	Route::get('business/simulator','ShopifyApp\SimulatorController@simulator')->name('business_simulator');
	Route::get('business/lifetime-value','ShopifyApp\LifetimeValueController@lifetimeValue')->name('business_lifetime_value');

	Route::get('business/reports/products','ShopifyApp\ReportController@products')->name('business_report_products');
	Route::get('business/reports/orders','ShopifyApp\ReportController@orders')->name('business_report_orders');
	Route::get('business/reports/map','ShopifyApp\ReportController@map')->name('business_report_map');
	Route::get('business/reports/disputes','ShopifyApp\ReportController@disputes')->name('business_report_disputes');

	Route::get('business/expenses/product-cost','ShopifyApp\ExpenseController@productCost')->name('business_expenses_product_cost');
	Route::get('business/expenses/shipping-cost','ShopifyApp\ExpenseController@shippingCost')->name('business_expenses_shipping_cost');
	Route::get('business/expenses/handling-cost','ShopifyApp\ExpenseController@handlingCost')->name('business_expenses_handling_cost');
	Route::get('business/expenses/transaction-cost','ShopifyApp\ExpenseController@transactionCost')->name('business_expenses_transaction_cost');
	Route::get('business/expenses/custom-cost','ShopifyApp\ExpenseController@customCost')->name('business_expenses_custom_cost');

	Route::get('business/integration','ShopifyApp\IntegrationController@integration')->name('business_integration');
	Route::match(['POST','GET'],'business/settings/rules','ShopifyApp\SettingController@rules')->name('business_setting_rules');
	Route::get('business/settings/sync-status','ShopifyApp\SettingController@syncStatus')->name('business_setting_sync_status');
	Route::get('business/settings/account','ShopifyApp\SettingController@account')->name('business_setting_account');
	Route::post('user-profile-update','ShopifyApp\SettingController@updateUserProfile');
	Route::post('user-password-update','ShopifyApp\SettingController@updateUserPassword');

});


// Generate a login URL
Route::get('/facebook/login','ShopifyApp\FacebookController@facebookLogin');
// Endpoint that is redirected to after an authentication attempt
Route::get('/facebook/callback','ShopifyApp\FacebookController@facebookCallback');

Route::get('login/google', 'ShopifyApp\GoogleController@redirectToProvider')->name('connect_google');
Route::get('login/google/callback', 'ShopifyApp\GoogleController@handleProviderCallback')->name('google_callback');
Route::get('google-ads-data', 'ShopifyApp\GoogleController@fetchGoogleAds')->name('show_google_ads');



