<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseImpact extends Model
{
    protected $table = 'warehouse_impact';

    protected $fillable = [
        'user_id','it_id','note','warehouse_id'
    ];

    public function impactType()
    {
        return $this->belongsTo('App\ImpactType');
    }

    public function warehouseImpactDetail()
    {
        return $this->hasMany('App\WarehouseImpactDetail');
    }

    public function verifyRequest()
    {
        return $this->belongsTo('App\VerifyRequest');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
