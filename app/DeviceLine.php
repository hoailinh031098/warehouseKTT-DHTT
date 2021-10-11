<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceLine extends Model
{
    protected $fillable = [
        'dl_name','device_id'
    ];
    protected $table = 'device_line';
    protected $primaryKey = 'dl_id';
    public $timestamps = false;

    public function device()
    {
        return $this->belongsTo('App\Device');
    }

    public function warehouseImpactDetail()
    {
        return $this->hasMany('App\WarehouseImpactDetail');
    }

    public function warehouseDetail()
    {
        return $this->hasMany('App\WarehouseDetail');
    }

    public function containerDetail()
    {
        return $this->hasMany('App\ContainerDetail');
    }
}
