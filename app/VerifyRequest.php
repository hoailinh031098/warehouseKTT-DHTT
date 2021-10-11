<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyRequest extends Model
{
    protected $table = 'verify_request';

    protected $fillable = [
        'vr_name','wi_id','user_id','confirm'
    ];

    public function warehouseImpact()
    {
        return $this->belongsTo('App\WarehouseImpact');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
