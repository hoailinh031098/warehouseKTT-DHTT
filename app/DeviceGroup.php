<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceGroup extends Model
{
    protected $fillable = [
        'dg_name'
    ];
    protected $table = 'device_group';
    protected $primaryKey = 'dg_id';
    public $timestamps = false;

    public function device()
    {
        return $this->hasMany('App\Device');
    }
}
