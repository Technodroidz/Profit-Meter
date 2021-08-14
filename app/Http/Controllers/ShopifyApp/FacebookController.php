<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scottybo\LaravelFacebookSdk\LaravelFacebookSdk;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use FacebookAds\Api;
// use FacebookAds\Object\AdUser;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;

use Illuminate\Support\Facades\Auth;
use App\Model\UserFacebookAccount;
use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdFields;

use FacebookAds\Object\AdsInsights;
use FacebookAds\Logger\CurlLogger;


class FacebookController extends Controller
{
    public function facebookLogin(Request $request)
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('facebook')->with($parameters)->redirect();
    }

    public function facebookCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        
        $user_object = $user->user;
        $insert_array = [
            'user_id'          => Auth::User()->id,
            'token'            => $user->token,
            'refresh_token'    => $user->refreshToken,
            'expires_in'       => $user->expiresIn,
            'facebook_id'      => $user->id,
            'name'             => $user->name,
            'email'            => $user->email,
            'avatar'           => $user->avatar,
            // 'gender'           => $user_object['gender']
        ];

        UserFacebookAccount::updateOrInsert(['user_id'=>Auth::User()->id],$insert_array);
        return redirect()->route('facebook_ads_api_list');
    }

    public function facebookApiList()
    {
        return view('business_app/content_template/facebook_ads_api_list');
    }

    public function facebookApiDetail(Request $request)
    {
        $facebook_account = UserFacebookAccount::where('user_id',Auth::User()->id)->first();
        // // Initialize a new Session and instantiate an Api object
        // Api::init(env('FACEBOOK_APP_ID'),env('FACEBOOK_APP_SECRET'),$facebook_account->token);

        // // The Api object is now available through singleton
        // $api = Api::instance();


        // $ad = new Ad('130130937619407');
        // $ad->getSelf(array(
        //     AdAccountFields::ID,
        //     AdAccountFields::NAME,
        // ));
        // pp($ad);

        // die;

        // $fields = array(
        //     AdAccountFields::ID,
        //     AdAccountFields::NAME,
        // );
        
        // $account = (new AdAccount($facebook_account->facebook_id))->getSelf($fields);

        // pp($account);
        // $me = new AdUser('me');
        // $my_adaccount = $me->getAdAccounts()->current();
        // pp($my_adaccount);


        $access_token = 'EAAE0er30YYIBACcOzOSG4rVEEw2HYTvxjl3hDKCRWC5ZCZBwWPZCnKtVEWW7LZC549UhMwRWOaijfofsi0tbXhZBayZBUCMFsZAKpjTowZAZBLcGX4bx57n2tBN4Pdgj6o1mxOrTEVEY6VNGieD9QaDOLgEVrGLaIKaJBlx9eHZAZATgCWXtDAu4zL6V8axUkd7xZBoZD';
        $ad_account_id = 'act_965056857585201';
        $app_secret = '5aefc7cdc4ad29edddfee262c002184a';
        $app_id = '339176754274690';

        $api = Api::init($app_id, $app_secret,$facebook_account->token);
        $api->setLogger(new CurlLogger());

        $fields = array(
          // 'results',
          // 'result_rate',
          // 'reach',
          // 'frequency',
          // 'impressions',
          // 'delivery',
          // 'spend',
          // 'impressions_gross',
          // 'impressions_auto_refresh',
          // 'attribution_setting',
          // 'quality_score_organic',
          // 'quality_score_ectr',
          // 'quality_score_ecvr',
          // 'cost_per_result',
          // 'cpp',
          // 'cpm',
          // 'actions:page_engagement',
          // 'actions:like',
          // 'actions:comment',
          // 'actions:post_engagement',
          // 'actions:post_reaction',
          // 'actions:onsite_conversion.post_save',
          // 'actions:post',
          // 'actions:photo_view',
          // 'actions:rsvp',
          // 'actions:checkin',
          // 'actions:full_view',
          // 'unique_actions:full_view',
          // 'ar_effect_share:ar_effect_share',
          // 'cost_per_action_type:page_engagement',
          // 'cost_per_action_type:like',
          // 'cost_per_action_type:post_engagement',
          // 'cost_per_action_type:rsvp',
          // 'unique_video_continuous_2_sec_watched_actions:video_view',
          // 'video_continuous_2_sec_watched_actions:video_view',
          // 'actions:video_view',
          // 'video_thruplay_watched_actions:video_view',
          // 'video_p25_watched_actions:video_view',
          // 'video_p50_watched_actions:video_view',
          // 'video_p75_watched_actions:video_view',
          // 'video_p95_watched_actions:video_view',
          // 'video_p100_watched_actions:video_view',
          // 'video_avg_time_watched_actions:video_view',
          // 'video_play_actions:video_view',
          // 'canvas_avg_view_time',
          // 'canvas_avg_view_percent',
          // 'cost_per_2_sec_continuous_video_view:video_view',
          // 'cost_per_action_type:video_view',
          // 'cost_per_thruplay:video_view',
          // 'actions:click_to_call_call_confirm',
          // 'actions:link_click',
          // 'unique_actions:link_click',
          // 'outbound_clicks:outbound_click',
          // 'unique_outbound_clicks:outbound_click',
          // 'website_ctr:link_click',
          // 'unique_link_clicks_ctr',
          // 'outbound_clicks_ctr:outbound_click',
          // 'unique_outbound_clicks_ctr:outbound_click',
          // 'clicks',
          // 'unique_clicks',
          // 'ctr',
          // 'unique_ctr',
          // 'instant_experience_clicks_to_open',
          // 'instant_experience_clicks_to_start',
          // 'instant_experience_outbound_clicks:outbound_click',
          // 'cost_per_action_type:link_click',
          // 'cost_per_unique_action_type:link_click',
          // 'cost_per_outbound_click:outbound_click',
          // 'cost_per_unique_outbound_click:outbound_click',
          // 'cpc',
          // 'cost_per_unique_click',
          // 'estimated_ad_recallers',
          // 'estimated_ad_recall_rate',
          // 'cost_per_estimated_ad_recallers',
          // 'actions:omni_achievement_unlocked',
          // 'cost_per_action_type:omni_achievement_unlocked',
          // 'action_values:omni_achievement_unlocked',
          // 'unique_actions:omni_achievement_unlocked',
          // 'cost_per_unique_action_type:omni_achievement_unlocked',
          // 'actions:add_payment_info',
          // 'cost_per_action_type:add_payment_info',
          // 'action_values:add_payment_info',
          // 'unique_actions:add_payment_info',
          // 'cost_per_unique_action_type:add_payment_info',
          // 'actions:omni_add_to_cart',
          // 'cost_per_action_type:omni_add_to_cart',
          // 'action_values:omni_add_to_cart',
          // 'unique_actions:omni_add_to_cart',
          // 'cost_per_unique_action_type:omni_add_to_cart',
          // 'actions:add_to_wishlist',
          // 'cost_per_action_type:add_to_wishlist',
          // 'action_values:add_to_wishlist',
          // 'unique_actions:add_to_wishlist',
          // 'cost_per_unique_action_type:add_to_wishlist',
          // 'actions:omni_activate_app',
          // 'cost_per_action_type:omni_activate_app',
          // 'action_values:omni_activate_app',
          // 'unique_actions:omni_activate_app',
          // 'cost_per_unique_action_type:omni_activate_app',
          // 'actions:omni_app_install',
          // 'cost_per_action_type:omni_app_install',
          // 'conversions:submit_application_total',
          // 'cost_per_conversion:submit_application_total',
          // 'conversion_values:submit_application_total',
          // 'conversions:schedule_total',
          // 'cost_per_conversion:schedule_total',
          // 'conversion_values:schedule_total',
          // 'actions:omni_initiated_checkout',
          // 'cost_per_action_type:omni_initiated_checkout',
          // 'action_values:omni_initiated_checkout',
          // 'unique_actions:omni_initiated_checkout',
          // 'cost_per_unique_action_type:omni_initiated_checkout',
          // 'conversions:contact_total',
          // 'cost_per_conversion:contact_total',
          // 'conversion_values:contact_total',
          // 'actions:omni_view_content',
          // 'cost_per_action_type:omni_view_content',
          // 'action_values:omni_view_content',
          // 'unique_actions:omni_view_content',
          // 'cost_per_unique_action_type:omni_view_content',
          // 'actions:omni_spend_credits',
          // 'cost_per_action_type:omni_spend_credits',
          // 'action_values:omni_spend_credits',
          // 'unique_actions:omni_spend_credits',
          // 'cost_per_unique_action_type:omni_spend_credits',
          // 'actions:omni_custom',
          // 'cost_per_action_type:omni_custom',
          // 'actions:app_engagement',
          // 'cost_per_action_type:app_engagement',
          // 'actions:app_story',
          // 'cost_per_action_type:app_story',
          // 'actions:app_use',
          // 'cost_per_action_type:app_use',
          // 'conversions:donate_total',
          // 'cost_per_conversion:donate_total',
          // 'conversion_values:donate_total',
          // 'actions:games.plays',
          // 'cost_per_action_type:games.plays',
          // 'actions:onsite_conversion.find_location',
          // 'conversions:ad_click_mobile_app',
          // 'cost_per_conversion:ad_click_mobile_app',
          // 'conversions:ad_impression_mobile_app',
          // 'cost_per_conversion:ad_impression_mobile_app',
          // 'actions:landing_page_view',
          // 'cost_per_action_type:landing_page_view',
          // 'unique_actions:landing_page_view',
          // 'cost_per_unique_action_type:landing_page_view',
          // 'actions:lead',
          // 'cost_per_action_type:lead',
          // 'action_values:lead',
          // 'actions:omni_level_achieved',
          // 'cost_per_action_type:omni_level_achieved',
          // 'action_values:omni_level_achieved',
          // 'unique_actions:omni_level_achieved',
          // 'cost_per_unique_action_type:omni_level_achieved',
          // 'conversions:find_location_total',
          // 'cost_per_conversion:find_location_total',
          // 'conversion_values:find_location_total',
          // 'actions:app_custom_event.fb_mobile_d2_retention',
          // 'cost_per_action_type:app_custom_event.fb_mobile_d2_retention',
          // 'unique_actions:app_custom_event.fb_mobile_d2_retention',
          // 'cost_per_unique_action_type:app_custom_event.fb_mobile_d2_retention',
          // 'actions:app_custom_event.fb_mobile_d7_retention',
          // 'cost_per_action_type:app_custom_event.fb_mobile_d7_retention',
          // 'unique_actions:app_custom_event.fb_mobile_d7_retention',
          // 'cost_per_unique_action_type:app_custom_event.fb_mobile_d7_retention',
          // 'actions:offline_conversion.other',
          // 'cost_per_action_type:offline_conversion.other',
          // 'action_values:offline_conversion.other',
          // 'actions:onsite_conversion.flow_complete',
          // 'cost_per_action_type:onsite_conversion.flow_complete',
          // 'action_values:onsite_conversion.flow_complete',
          // 'actions:onsite_conversion.click_to_call',
          // 'conversions:customize_product_total',
          // 'cost_per_conversion:customize_product_total',
          // 'conversion_values:customize_product_total',
          // 'purchase_roas:omni_purchase',
          // 'actions:omni_purchase',
          // 'cost_per_action_type:omni_purchase',
          // 'action_values:omni_purchase',
          // 'unique_actions:omni_purchase',
          // 'cost_per_unique_action_type:omni_purchase',
          // 'actions:omni_rate',
          // 'cost_per_action_type:omni_rate',
          // 'action_values:omni_rate',
          // 'unique_actions:omni_rate',
          // 'cost_per_unique_action_type:omni_rate',
          // 'actions:omni_complete_registration',
          // 'cost_per_action_type:omni_complete_registration',
          // 'action_values:omni_complete_registration',
          // 'unique_actions:omni_complete_registration',
          // 'cost_per_unique_action_type:omni_complete_registration',
          // 'actions:omni_search',
          // 'cost_per_action_type:omni_search',
          // 'action_values:omni_search',
          // 'unique_actions:omni_search',
          // 'cost_per_unique_action_type:omni_search',
          // 'conversions:subscribe_total',
          // 'cost_per_conversion:subscribe_total',
          // 'conversion_values:subscribe_total',
          // 'conversions:start_trial_total',
          // 'cost_per_conversion:start_trial_total',
          // 'conversion_values:start_trial_total',
          // 'actions:omni_tutorial_completion',
          // 'cost_per_action_type:omni_tutorial_completion',
          // 'action_values:omni_tutorial_completion',
          // 'unique_actions:omni_tutorial_completion',
          // 'cost_per_unique_action_type:omni_tutorial_completion',
          // 'actions:app_custom_event.fb_mobile_achievement_unlocked',
          // 'action_values:app_custom_event.fb_mobile_achievement_unlocked',
          // 'unique_actions:app_custom_event.fb_mobile_achievement_unlocked',
          // 'actions:app_custom_event.fb_mobile_add_payment_info',
          // 'actions:offsite_conversion.fb_pixel_add_payment_info',
          // 'actions:offline_conversion.add_payment_info',
          // 'action_values:app_custom_event.fb_mobile_add_payment_info',
          // 'action_values:offsite_conversion.fb_pixel_add_payment_info',
          // 'action_values:offline_conversion.add_payment_info',
          // 'unique_actions:app_custom_event.fb_mobile_add_payment_info',
          // 'actions:app_custom_event.fb_mobile_add_to_cart',
          // 'actions:offsite_conversion.fb_pixel_add_to_cart',
          // 'actions:offline_conversion.add_to_cart',
          // 'actions:onsite_conversion.add_to_cart',
          // 'action_values:app_custom_event.fb_mobile_add_to_cart',
          // 'action_values:offsite_conversion.fb_pixel_add_to_cart',
          // 'action_values:offline_conversion.add_to_cart',
          // 'unique_actions:app_custom_event.fb_mobile_add_to_cart',
          // 'actions:app_custom_event.fb_mobile_add_to_wishlist',
          // 'actions:offsite_conversion.fb_pixel_add_to_wishlist',
          // 'actions:offline_conversion.add_to_wishlist',
          // 'action_values:app_custom_event.fb_mobile_add_to_wishlist',
          // 'action_values:offsite_conversion.fb_pixel_add_to_wishlist',
          // 'action_values:offline_conversion.add_to_wishlist',
          // 'unique_actions:app_custom_event.fb_mobile_add_to_wishlist',
          // 'actions:app_custom_event.fb_mobile_activate_app',
          // 'action_values:app_custom_event.fb_mobile_activate_app',
          // 'unique_actions:app_custom_event.fb_mobile_activate_app',
          // 'actions:mobile_app_install',
          // 'actions:app_install',
          // 'conversions:submit_application_mobile_app',
          // 'conversions:submit_application_website',
          // 'conversions:submit_application_offline',
          // 'conversion_values:submit_application_mobile_app',
          // 'conversion_values:submit_application_website',
          // 'conversion_values:submit_application_offline',
          // 'conversions:schedule_mobile_app',
          // 'conversions:schedule_website',
          // 'conversions:schedule_offline',
          // 'conversion_values:schedule_mobile_app',
          // 'conversion_values:schedule_website',
          // 'conversion_values:schedule_offline',
          // 'actions:app_custom_event.fb_mobile_initiated_checkout',
          // 'actions:offsite_conversion.fb_pixel_initiate_checkout',
          // 'actions:offline_conversion.initiate_checkout',
          // 'action_values:app_custom_event.fb_mobile_initiated_checkout',
          // 'action_values:offsite_conversion.fb_pixel_initiate_checkout',
          // 'action_values:offline_conversion.initiate_checkout',
          // 'unique_actions:app_custom_event.fb_mobile_initiated_checkout',
          // 'conversions:contact_mobile_app',
          // 'conversions:contact_website',
          // 'conversions:contact_offline',
          // 'conversion_values:contact_mobile_app',
          // 'conversion_values:contact_website',
          // 'conversion_values:contact_offline',
          // 'actions:app_custom_event.fb_mobile_content_view',
          // 'actions:offsite_conversion.fb_pixel_view_content',
          // 'actions:offline_conversion.view_content',
          // 'actions:onsite_conversion.view_content',
          // 'action_values:app_custom_event.fb_mobile_content_view',
          // 'action_values:offsite_conversion.fb_pixel_view_content',
          // 'action_values:offline_conversion.view_content',
          // 'unique_actions:app_custom_event.fb_mobile_content_view',
          // 'actions:app_custom_event.fb_mobile_spent_credits',
          // 'actions:credit_spent',
          // 'action_values:app_custom_event.fb_mobile_spent_credits',
          // 'action_values:credit_spent',
          // 'unique_actions:app_custom_event.fb_mobile_spent_credits',
          // 'cost_per_unique_action_type:app_custom_event.fb_mobile_spent_credits',
          // 'actions:app_custom_event.other',
          // 'conversions:donate_mobile_app',
          // 'conversions:donate_website',
          // 'conversions:donate_offline',
          // 'conversion_values:donate_mobile_app',
          // 'conversion_values:donate_website',
          // 'conversion_values:donate_offline',
          // 'actions:offsite_conversion.fb_pixel_lead',
          // 'actions:offline_conversion.lead',
          // 'actions:onsite_conversion.lead_grouped',
          // 'action_values:offsite_conversion.fb_pixel_lead',
          // 'action_values:offline_conversion.lead',
          // 'action_values:onsite_conversion.lead_grouped',
          // 'actions:app_custom_event.fb_mobile_level_achieved',
          // 'action_values:app_custom_event.fb_mobile_level_achieved',
          // 'unique_actions:app_custom_event.fb_mobile_level_achieved',
          // 'conversions:find_location_mobile_app',
          // 'conversions:find_location_website',
          // 'conversions:find_location_offline',
          // 'conversion_values:find_location_mobile_app',
          // 'conversion_values:find_location_website',
          // 'conversion_values:find_location_offline',
          // 'conversions:customize_product_mobile_app',
          // 'conversions:customize_product_website',
          // 'conversions:customize_product_offline',
          // 'conversion_values:customize_product_mobile_app',
          // 'conversion_values:customize_product_website',
          // 'conversion_values:customize_product_offline',
          // 'website_purchase_roas:offsite_conversion.fb_pixel_purchase',
          // 'mobile_app_purchase_roas:app_custom_event.fb_mobile_purchase',
          // 'actions:app_custom_event.fb_mobile_purchase',
          // 'actions:offsite_conversion.fb_pixel_purchase',
          // 'actions:offline_conversion.purchase',
          // 'actions:onsite_conversion.purchase',
          // 'action_values:app_custom_event.fb_mobile_purchase',
          // 'action_values:offsite_conversion.fb_pixel_purchase',
          // 'action_values:offline_conversion.purchase',
          // 'action_values:onsite_conversion.purchase',
          // 'unique_actions:app_custom_event.fb_mobile_purchase',
          // 'actions:app_custom_event.fb_mobile_rate',
          // 'action_values:app_custom_event.fb_mobile_rate',
          // 'unique_actions:app_custom_event.fb_mobile_rate',
          // 'actions:app_custom_event.fb_mobile_complete_registration',
          // 'actions:offsite_conversion.fb_pixel_complete_registration',
          // 'actions:offline_conversion.complete_registration',
          // 'action_values:app_custom_event.fb_mobile_complete_registration',
          // 'action_values:offsite_conversion.fb_pixel_complete_registration',
          // 'action_values:offline_conversion.complete_registration',
          // 'unique_actions:app_custom_event.fb_mobile_complete_registration',
          // 'actions:app_custom_event.fb_mobile_search',
          // 'actions:offsite_conversion.fb_pixel_search',
          // 'actions:offline_conversion.search',
          // 'action_values:app_custom_event.fb_mobile_search',
          // 'action_values:offsite_conversion.fb_pixel_search',
          // 'action_values:offline_conversion.search',
          // 'unique_actions:app_custom_event.fb_mobile_search',
          // 'conversions:subscribe_mobile_app',
          // 'conversions:subscribe_website',
          // 'conversions:subscribe_offline',
          // 'conversion_values:subscribe_mobile_app',
          // 'conversion_values:subscribe_website',
          // 'conversion_values:subscribe_offline',
          // 'conversions:start_trial_mobile_app',
          // 'conversions:start_trial_website',
          // 'conversions:start_trial_offline',
          // 'conversion_values:start_trial_mobile_app',
          // 'conversion_values:start_trial_website',
          // 'conversion_values:start_trial_offline',
          // 'actions:app_custom_event.fb_mobile_tutorial_completion',
          // 'action_values:app_custom_event.fb_mobile_tutorial_completion',
          // 'unique_actions:app_custom_event.fb_mobile_tutorial_completion',
          // 'date_start',
          // 'date_stop',
          'account_id',
          'account_name',
          'campaign_group_name',
          'campaign_group_id',
          'campaign_name',
          'campaign_id',
          'adgroup_id',
          'adgroup_name',
          'objective',
          'buying_type',
          'start_time',
          'stop_time',
          'bid',
          'budget',
          // 'schedule',
          // 'split_test_split',
          // 'split_test_variable',
          // 'optimization_results',
          // 'cost_per_optimization_result',
          // 'last_significant_edit',
        );
        $params = array(
          'time_range' => array('since' => '2021-07-06','until' => '2021-08-05'),
          'filtering' => array(),
          'level' => 'campaign',
          'breakdowns' => array('ad_name'),
        );
        echo json_encode((new AdAccount($ad_account_id))->getInsights(
          $fields,
          $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    }


}
