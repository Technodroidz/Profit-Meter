<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class subscruptionModel extends Model
{
  
 
    use SoftDeletes;
    protected $table = 'subscruptionplane';
    protected $dates = ['deleted_at'];
    protected $guarded = []; 
}
