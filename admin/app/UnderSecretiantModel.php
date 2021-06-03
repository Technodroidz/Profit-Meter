<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnderSecretiantModel extends Model
{
    protected $table = 'under_secretariant_catlog';
    protected $guarded = []; 

    public function getSecretiantName(){
        return $this->hasOne(SecretiantModel::class,'id','secretariant_id');
    }
}
