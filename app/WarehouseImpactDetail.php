<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseImpactDetail extends Model
{
    protected $table = 'warehouse_impact_detail';

    protected $fillable = [
        'wi_id','ds_id','dl_id','amount','unit_id'
    ];

    public function warehouseImpact()
    {
        return $this->belongsTo('App\WarehouseImpact');
    }

    public function wiDeviceSerial()
    {
        return $this->hasMany('App\WIDeviceSerial');
    }

    public function deviceStatus()
    {
        return $this->belongsTo('App\DeviceStatus');
    }
    public function deviceLine()
    {
        return $this->belongsTo('App\DeviceLine');
    }
}
