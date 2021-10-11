<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'device_name','dg_id'
    ];
    protected $table = 'device';
    protected $primaryKey = 'device_id';
    public $timestamps = false;

    public function deviceGroup()
    {
        return $this->belongsTo('App\DeviceGroup');
    }
    public function deviceLine()
    {
        return $this->hasMany('App\DeviceLine');
    }
}
