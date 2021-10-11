<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpactType extends Model
{
    protected $table = 'impact_type';

    protected $fillable = [
        'it_name'
    ];

    public function warehouseImpact()
    {
        return $this->hasMany('App\WarehouseImpact');
    }
}
