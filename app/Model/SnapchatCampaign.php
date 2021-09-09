<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SnapchatCampaign extends Model
{
    protected $connection ='tenant';
    protected $table = 'snapchat_ad_campaigns';
}
