<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scottybo\LaravelFacebookSdk\LaravelFacebookSdk;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
// use FacebookAds\Object\AdUser;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;

use Illuminate\Support\Facades\Auth;
use App\Model\UserFacebookAccount;
use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdFields;

use FacebookAds\Object\AdsInsights;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\Campaign;
use FacebookAds\Api;


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
        return redirect()->route('business_integration')->with('success','Facebook Account added Successfully.');
        // return redirect()->route('facebook_ads_api_list');
    }

    public function facebookApiList()
    {
        return view('business_app/content_template/facebook_ads_api_list');
    }

    public function facebookApiDetail(Request $request)
    {
        $facebook_account = UserFacebookAccount::where('user_id',Auth::User()->id)->first();

        $access_token   = 'EAAE0er30YYIBAMZAZBb106Ytq2yEXvxRfKArHNUJeZCZClKqZBgfkWA2RiZBtoCpKqVx8aiGvPauBWnBIsJNzLhfZBflDSkZAULv2J7X5mZBaW0jg6nV4PzDImEiZBKk06rrbJmhKqpPGWvsYR3TjJmcrtPYHAGeCXZB5n8WVWERMYQxgzLHyHtvqhPbkErHDAbF7qojQocxNRicc4XyCsZCdBBk';
        $ad_account_id  = 'act_965056857585201';
        $app_secret     = '5aefc7cdc4ad29edddfee262c002184a';
        $app_id         = '339176754274690';

        $api            = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());

        $fields = array(
          'name',
          'objective',
        );
        $params = array(
          'effective_status' => array('ACTIVE','PAUSED'),
        );
        echo json_encode((new AdAccount($ad_account_id))->getCampaigns(
          $fields,
          $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    }

    public function getCampaigns(Request $request,$ad_account_id)
    {
        $facebook_account = UserFacebookAccount::where('user_id',Auth::User()->id)->first();

        // $access_token   = 'EAAE0er30YYIBAMZAZBb106Ytq2yEXvxRfKArHNUJeZCZClKqZBgfkWA2RiZBtoCpKqVx8aiGvPauBWnBIsJNzLhfZBflDSkZAULv2J7X5mZBaW0jg6nV4PzDImEiZBKk06rrbJmhKqpPGWvsYR3TjJmcrtPYHAGeCXZB5n8WVWERMYQxgzLHyHtvqhPbkErHDAbF7qojQocxNRicc4XyCsZCdBBk';

        // $ad_account_id  = 'act_965056857585201';
        // $app_secret     = '5aefc7cdc4ad29edddfee262c002184a';
        // $app_id         = '339176754274690';

        // $api            = Api::init($app_id, $app_secret, $facebook_account->token);
        // $api->setLogger(new CurlLogger());

        // $fields = array(
        //   'name',
        //   'objective',
        // );
        // $params = array(
        //   'effective_status' => array(),
        // );
        // echo json_encode((new AdAccount($ad_account_id))->getCampaigns(
        //   $fields,
        //   $params
        // )->getResponse()->getContent(), JSON_PRETTY_PRINT);


        $access_token = 'EAAExzyNdRZBsBAGbteZBPBO3BChHgPYHmkaRRdWZA7pv259t60Xo1uy43OhvCc5zjAPxR65yGXz6ZCOPHvlol5VPSyxgEcOrWGzj1qZATLnFpKFJ6OjLR3TOL1ZCeJkA7deXBtGmzaYNZCp2frUROUYnn92imYHMCXwLdQ7dGjHcNUbWSA6LieVtZAYVPGmIVGiZAoGEebuJ2ewZDZD';
        $ad_account_id = 'act_1457434981299430';
        $app_secret = '1091f2d54100cbe6f31ef6663591c6dc';
        $app_id = '336240698017771';

        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());

        $fields = array(
          'name',
          'objective',
        );
        $params = array(
          'effective_status' => array(),
        );
        echo json_encode((new AdAccount($ad_account_id))->getCampaigns(
          $fields,
          $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);
        
        // $fields = array(
        //   // 'campaign_group_id',
        //   // 'campaign_group_name',
        //   'account_name',
        //   'account_id',
        // );
        // $params = array(
        //   'time_range' => array('since' => '2021-07-25','until' => '2021-08-24'),
        //   'filtering' => array(),
        //   'level' => 'campaign',
        //   'breakdowns' => array(),
        // );
        // echo json_encode((new AdAccount($ad_account_id))->getInsights(
        //   $fields,
        //   $params
        // )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    }

    public function getAdAccounts()
    {
        $facebook_account = UserFacebookAccount::where('user_id',Auth::User()->id)->first();

        // $access_token   = 'EAAE0er30YYIBALZCsOTWb2SIRkZBZB597brVIv3eWA517oP19wGEDmCI9GQUbw0f5FYCFcE8U6i2m5qRFezjavnKyLeISxWMUdIctrJ8lhZBXtVduKjjK1eCZAyyPXR87M1WJUUSqt6H9c9xNnD4ZCZCStIZAvK7e0v3p0grwdtwAbGaJZCrARHurtAIZAE59SoPYvBhXmVJ1cnRsJEji9jhtb';

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://graph.facebook.com/v12.0/me/adaccounts?access_token='.$facebook_account->token,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response,1);
        pp($response);
        return view('business_app\content_template\facebook_ad_account_list',$response);

    }
}
