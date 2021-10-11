<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseDetail extends Model
{
    protected $table = 'warehouse_detail';

    protected $fillable = [
        'warehouse_id','dl_id','amount','unit_id','ds_id'
    ];

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
    public function wdDeviceSerial()
    {
        return $this->hasMany('App\WDDeviceSerial');
    }
    public function deviceStatus()
    {
        return $this->belongsTo('App\DeviceStatus');
    }
    public function deviceLine()
    {
        return $this->belongsTo('App\DeviceLine');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
