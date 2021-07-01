<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BusinessCategory extends Model
{
    use SoftDeletes;
    // protected $table = 'busines_categorys';
    protected $guarded = []; 
}
