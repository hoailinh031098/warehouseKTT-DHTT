<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WIDeviceSerial extends Model
{
    protected $table = 'wi_device_serial';

    protected $fillable = [
        'serial_number','wid_id'
    ];

    public function warehouseImpactDetail()
    {
        return $this->belongsTo('App\WarehouseImpactDetail');
    }
}
