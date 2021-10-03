<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Model\User;
use PHPShopify\ShopifySDK;

class SyncShopifyOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user  = User::where('id',$this->user_id)->first();
        $config= array(
            'ShopUrl'    => $user->shopify_url,
            'AccessToken'=> $user->shopify_access_token,
        );
        $shopify= new \PHPShopify\ShopifySDK($config);
        $orders = $shopify->Order->get();
        pp($orders);
    }
}
