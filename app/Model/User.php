<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Role;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Traits\ShopModel;


class User extends Authenticatable implements IShopModel
{
    use Notifiable;
    use ShopModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','short_token','long_token','bussiness_name','number','last_name','shopify_url','profile_pick','number','company','status',
    ];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getShopByUrl($shopify_url)
    {
        return User::where('shopify_url',$shopify_url)->first();
    }

    public static function updateByShopUrl($shopify_url,$array)
    {
        User::where('shopify_url',$shopify_url)->update($array);
    }

    public static function getUserById($id)
    {
        return User::where('id',$id)->first();
    }

    public static function updateById($id,$update_array)
    {
        User::where('id',$id)->update($update_array);
    }

}
