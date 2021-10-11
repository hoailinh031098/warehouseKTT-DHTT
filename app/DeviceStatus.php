<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceStatus extends Model
{
    protected $table = 'device_status';

    protected $fillable = [
        'ds_name'
    ];

    public function warehouseImpactDetail()
    {
        return $this->hasMany('App\WarehouseImpactDetail');
    }

    public function warehouseDetail()
    {
        return $this->hasMany('App\WarehouseDetail');
    }
}
