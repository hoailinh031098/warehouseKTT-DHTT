<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';

    protected $fillable = [
        'unit_name'
    ];

    public function warehouseImpactDetail()
    {
        return $this->hasMany('App\WarehouseImpactDetail');
    }

    public function repairLog()
    {
        return $this->hasMany('App\RepairLog');
    }

    public function containerDetail()
    {
        return $this->hasMany('App\ContainerDetail');
    }

    public function warehouseDetail()
    {
        return $this->hasMany('App\WarehouseDetail');
    }




}
