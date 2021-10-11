<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WDDeviceSerial extends Model
{
    protected $table = 'wd_device_serial';
    
    protected $fillable = [
        'serial_number','wd_id','status'
    ];
    public function warehouseDetail()
    {
        return $this->belongsTo('App\WarehouseDetail');
    }
}
