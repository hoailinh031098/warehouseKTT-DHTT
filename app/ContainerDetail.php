<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContainerDetail extends Model
{
    protected $table = 'container_detail';
    
    protected $fillable = [
        'container_id','dl_id','amount','unit_id','cs_id'
    ];

    public function container()
    {
        return $this->belongsTo('App\Container');
    }

    public function repairLog()
    {
        return $this->hasMany('App\RepairLog');
    }

    public function containerStatus()
    {
        return $this->belongsTo('App\ContainerStatus');
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

