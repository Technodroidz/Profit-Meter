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
	Route::post('status-user-change','admin\LoginController@userStatusChange');
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
	Route::post('status-subscription','admin\SubscruptionPlanController@changeStatus');

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

	
	
	Route::get('paynow', 'front\PayPalController@getIndex');
	Route::get('paypal/ec-checkout', 'front\PayPalController@getExpressCheckout');
	Route::get('paypal/ec-checkout-success', 'front\PayPalController@getExpressCheckoutSuccess');
	Route::get('paypal/adaptive-pay', 'front\PayPalController@getAdaptivePay');
	Route::post('paypal/notify', 'front\PayPalController@notify');

	Route::get('pay-strip', 'front\StripController@subscription');
	Route::post('pay-strip', 'front\StripController@postSubscription');

	Route::post('/subscribe_process', 'CheckoutController@subscribe_process');
	Route::get('/strip-pay', 'front\StripController@Viewcharge');
	Route::post('/charge', 'front\StripController@charge');

	Route::get('/strip-pay-sub', 'front\StripController@ViewSubcharge');

	Route::post('/strip-subscribe_process', 'front\StripController@subscribe_process_sub');

	Route::get('/plans', 'front\PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'front\PlanController@show')->name('plans.show');
	Route::post('/subscription', 'front\SubscriptionController@create')->name('subscription.create');
	Route::post('/submit-payment', 'front\PlanController@payment')->name('submit-payment.create');



	Route::get('/report', 'admin\UserSubscriptionController@index');
	Route::get('report-add', 'front\HomeController@reportAdd');
	Route::post('report-submit', 'front\HomeController@SubmitReport');

	Route::get('/templete', 'admin\TempleteController@index');
	Route::get('add-templete', 'admin\TempleteController@AddTemplete');
	Route::get('edit-templete/{id}', 'admin\TempleteController@editTemplete');
	Route::post('submit-templete', 'admin\TempleteController@submitTemplete');
	Route::get('delete-templete/{id}', 'admin\TempleteController@deleteTemplete');

	Route::get('/view_pages', 'admin\PageController@index');
	Route::get('add-page', 'admin\PageController@AddPage');
	Route::get('edit-page/{id}', 'admin\PageController@editPage');
	Route::post('submit-page', 'admin\PageController@submitPage');
	Route::get('delete-page/{id}', 'admin\PageController@deletePage');
	Route::post('change-status-page', 'admin\PageController@changeStatus');

});

// Shopify Account Login

Route::match(['POST','GET'],'connect-shopify-account','ShopifyApp\AuthController@loginWithShopify')->name('connect_shopify_account')->middleware(['configure.multi_tenant_db','auth:web']);

Route::get('authenticate','ShopifyApp\AuthController@authenticate')->name('authenticate');

Route::group(['middleware' => ['check.auth.on.cred.screen']],function(){
	Route::match(['POST','GET'],'business/register','ShopifyApp\AuthController@register')->name('business_register');
	Route::match(['POST','GET'],'business/forgot-password','ShopifyApp\AuthController@forgotPassword')->name('business_forgot_password');
	Route::get('business/reset-password/{token}', 'ShopifyApp\AuthController@resetPassword')->name('business_reset_password/{token}');
	Route::post('business/reset-password', 'ShopifyApp\AuthController@updateResetPassword')->name('update_business_reset_password');
	Route::match(['POST','GET'],'business/login','ShopifyApp\AuthController@login')->name('login');
});


Route::get('business/logout','ShopifyApp\AuthController@logout')->middleware(['auth:web'])->name('business_logout');

Route::group(['middleware' => ['auth:web','restrict.registered.user','configure.multi_tenant_db']],function(){
	Route::get('/','ShopifyApp\DashboardController@dashboard')->name('home');
	// ->middleware(['auth.shopify'])

	Route::get('business/simulator','ShopifyApp\SimulatorController@simulator')->name('business_simulator');
	Route::get('business/lifetime-value','ShopifyApp\LifetimeValueController@lifetimeValue')->name('business_lifetime_value');

	Route::get('business/reports/products','ShopifyApp\ReportController@products')->name('business_report_products');
	Route::get('business/reports/orders','ShopifyApp\ReportController@orders')->name('business_report_orders');
	Route::get('business/reports/map','ShopifyApp\ReportController@map')->name('business_report_map');
	Route::get('business/reports/disputes','ShopifyApp\ReportController@disputes')->name('business_report_disputes');

	Route::get('business/expenses/product-cost','ShopifyApp\ExpenseController@productCost')->name('business_expenses_product_cost');
	Route::post('sync-shopify','ShopifyApp\ExpenseController@syncShopifyData')->name('sync_shopify');
	Route::post('product-ajax-list','ShopifyApp\ExpenseController@productListAjax')->name('product_ajax_list');
	Route::post('add-handling-cost','ShopifyApp\ExpenseController@addHandlingCost')->name('add_handling_cost');
	Route::post('add-product-cost-per-product','ShopifyApp\ExpenseController@addProductCost')->name('add_product_cost');
	Route::post('delete-product-cost-per-product','ShopifyApp\ExpenseController@deleteProductCost')->name('delete_product_cost');
	Route::post('import-products','ShopifyApp\ExpenseController@importShopifyProducts')->name('import_products');

	Route::post('add-shipping-cost-per-product','ShopifyApp\ExpenseController@addShippingCost')->name('add_shipping_cost_per_product');
	Route::post('delete-shipping-cost-per-product','ShopifyApp\ExpenseController@deleteShippingCost')->name('delete_shipping_cost_per_product');

	Route::get('business/expenses/shipping-cost','ShopifyApp\ExpenseController@shippingCost')->name('business_expenses_shipping_cost');
	Route::post('business/expenses/add-shipping-country-rule','ShopifyApp\ExpenseController@addCountryRule')->name('add_shipping_country_rule');
	Route::post('business/expenses/delete-shipping-country-rule','ShopifyApp\ExpenseController@deleteCountryRule')->name('delete_shipping_country_rule');
	Route::post('business/expenses/save-shipping-cost-setting','ShopifyApp\ExpenseController@updateShippingCostSettings')->name('save_shipping_cost_setting');


	Route::get('business/expenses/handling-cost','ShopifyApp\ExpenseController@handlingCost')->name('business_expenses_handling_cost');

	Route::get('business/expenses/tax','ShopifyApp\ExpenseController@tax')->name('tax');
	Route::post('business/expenses/update-tax-rate','ShopifyApp\ExpenseController@updateTaxRate')->name('update_tax_rate');

	Route::get('business/expenses/transaction-cost','ShopifyApp\ExpenseController@transactionCost')->name('business_expenses_transaction_cost');
	Route::post('add-transaction-cost','ShopifyApp\ExpenseController@addTransactionCost')->name('add_transaction_cost');
	Route::post('delete-transaction-cost','ShopifyApp\ExpenseController@deleteTransactionCost')->name('delete_transaction_cost');

	Route::get('business/expenses/custom-cost','ShopifyApp\ExpenseController@customCost')->name('business_expenses_custom_cost');

	Route::post('business/expenses/custmor/cost/submit','ShopifyApp\ExpenseController@submitCustomCost')->name('business_expenses_custmor_cost_submit');
	Route::get('business/expenses/custom/cost/delete/{id}','ShopifyApp\ExpenseController@deleteCustomCost')->name('business_expenses_custom_cost_delete');
//	Route::get('business/expenses/custom-cost','ShopifyApp\ExpenseController@deleteCustomCost')->name('business_expenses_custom_cost');

	Route::get('business/integration','ShopifyApp\IntegrationController@integration')->name('business_integration');
	Route::post('business/integration/update-google-ads-setting','ShopifyApp\IntegrationController@updateGoogleAdsSettings')->name('update_google_ads_setting');

	Route::get('business/integration/google-ads-response','ShopifyApp\GoogleController@fetchGoogleAds')->name('google_ads_response');

	Route::post('business/integration/update-paypal-api-setting','ShopifyApp\IntegrationController@updatePaypalApiSettings')->name('update_paypal_api_settings');

	Route::get('business/integration/paypal/paypal-information','ShopifyApp\PaypalController@getBusinessUserPaypalInformation')->name('get_business_user_paypal_information');

	Route::match(['POST','GET'],'business/settings/rules','ShopifyApp\SettingController@rules')->name('business_setting_rules');
	Route::get('business/settings/sync-status','ShopifyApp\SettingController@syncStatus')->name('business_setting_sync_status');

	Route::match(['POST','GET'],'business/settings/sync-paypal-disputes','ShopifyApp\SettingController@syncPaypalDisputesData')->name('sync_paypal_disputes');
	Route::match(['POST','GET'],'business/settings/sync-google-ads','ShopifyApp\SettingController@syncGoogleAdsData')->name('sync_google_ads');
	Route::match(['POST','GET'],'business/settings/sync-snapchat-ads','ShopifyApp\SettingController@syncSnapchatAdsData')->name('sync_snapchat_ads');

	Route::get('business/settings/account','ShopifyApp\SettingController@account')->name('business_setting_account');
	Route::get('business/settings/upgrade_plan','ShopifyApp\SettingController@upgradePlan')->name('business_setting_upgrade_plan');
	
	Route::post('business/settings/subscribe-stripe-payment','ShopifyApp\StripeSubscriptionController@payment')->name('subscribe_stripe_payment');
	
	Route::post('business/settings/initiate-subscribe-paypal-payment','ShopifyApp\PaypalSubscriptionController@initiateSubscription')->name('initiate_subscribe_stripe_payment');
	Route::get('business/settings/capture-subscribe-paypal-payment','ShopifyApp\PaypalSubscriptionController@captureSubscription')->name('capture_subscribe_paypal_payment');

	Route::post('user-profile-update','ShopifyApp\SettingController@updateUserProfile');
	Route::post('user-password-update','ShopifyApp\SettingController@updateUserPassword');
	Route::get('business/category','ShopifyApp\BusinesCotegoryController@index')->name('business_category');
	Route::post('business/category/submit','ShopifyApp\BusinesCotegoryController@submitCategory')->name('business_category_submit');
	Route::post('business/category/status','ShopifyApp\BusinesCotegoryController@changeStatus')->name('business_category_status');
	Route::get('business/category/delete/{id}','ShopifyApp\BusinesCotegoryController@deleteCategory')->name('business_category_delete');
	Route::post('business/category/submit','ShopifyApp\BusinesCotegoryController@submitCategory')->name('business_category_submit');
	
	// Generate a login URL
	Route::get('facebook/login','ShopifyApp\FacebookController@facebookLogin')->name('facebook_login');
	// Endpoint that is redirected to after an authentication attempt
	Route::get('facebook/callback','ShopifyApp\FacebookController@facebookCallback')->name('facebook_callback');
	Route::get('facebook-ads-api-list','ShopifyApp\FacebookController@facebookApiList')->name('facebook_ads_api_list');
	Route::match(['POST','GET'],'facebook-ads-api-detail','ShopifyApp\FacebookController@facebookApiDetail')->name('facebook_ads_api_detail');
	Route::get('facebook/ad-account-list', 'ShopifyApp\FacebookController@getAdAccounts')->name('facebook_ad_account_list');
	Route::get('facebook/campaign-list/{account_id}', 'ShopifyApp\FacebookController@getCampaigns')->name('facebook_campaign_list');

	Route::get('login/google', 'ShopifyApp\GoogleController@redirectToProvider')->name('connect_google');
	Route::get('login/google/callback', 'ShopifyApp\GoogleController@handleProviderCallback')->name('google_callback');
	Route::get('google-ads-data', 'ShopifyApp\GoogleController@fetchGoogleAds')->name('show_google_ads');
	Route::get('google-ads-api-list', 'ShopifyApp\GoogleController@googleAdsApiList')->name('google_ads_api_list');
	Route::match(['POST','GET'],'google-ads-api-detail', 'ShopifyApp\GoogleController@googleAdsApiDetail')->name('google_ads_api_detail');
	Route::get('google/customer-id-list', 'ShopifyApp\GoogleController@getCustomerIdList')->name('customer_id_list');
	Route::get('google/campaign-list/{customer_id}', 'ShopifyApp\GoogleController@getCampaignList')->name('google_ads_campaign_list');

	Route::get('login/snapchat', 'ShopifyApp\SnapchatController@redirectToProvider')->name('connect_snapchat');
	Route::get('login/snapchat/callback', 'ShopifyApp\SnapchatController@handleProviderCallback')->name('snapchat_callback');
	Route::get('snapchat/snapchat-api-list', 'ShopifyApp\SnapchatController@snapchatApiList')->name('snapchat_api_list');
	Route::match(['POST','GET'],'snapchat/snapchat-api-detail', 'ShopifyApp\SnapchatController@snapchatApiDetail')->name('snapchat_api_detail');

	Route::get('snapchat/organisation-list', 'ShopifyApp\SnapchatController@organisationList')->name('organisation_list');
	Route::get('snapchat/ad-accounts/{organization_id}', 'ShopifyApp\SnapchatController@adAccountList')->name('ad_account_list');
	Route::get('snapchat/campaign-list/{ad_account_id}', 'ShopifyApp\SnapchatController@campaignList')->name('campaign_list');
	Route::get('snapchat/ads-list/{campaign_id}', 'ShopifyApp\SnapchatController@adsList')->name('ads_list');
	Route::get('snapchat/ad-account-invoice-list/{ad_account_id}', 'ShopifyApp\SnapchatController@adAccountInvoiceList')->name('ad_account_invoice_list');

	Route::get('login/paypal', 'ShopifyApp\PaypalController@redirectToProvider')->name('connect_paypal');
	Route::get('login/paypal/callback', 'ShopifyApp\PaypalController@handleProviderCallback')->name('paypal_callback');
	Route::get('paypal/diputes-list', 'ShopifyApp\PaypalController@disputeList')->name('paypal_dispute_list');
	
	Route::get('paypal/paypal-api-list', 'ShopifyApp\PaypalController@paypalApiList')->name('paypal_api_list');
	Route::match(['POST','GET'],'paypal/paypal-api-detail', 'ShopifyApp\PaypalController@paypalApiDetail')->name('paypal_api_detail');

	// Generate a login URL
	Route::get('stripe/login','ShopifyApp\StripeController@redirectToProvider')->name('stripe_login');
	// Endpoint that is redirected to after an authentication attempt
	Route::get('stripe/callback','ShopifyApp\StripeController@handleProviderCallback')->name('stripe_callback');
	Route::get('stripe/dispute-list','ShopifyApp\StripeController@disputesList')->name('stripe_disputes_list');

});





