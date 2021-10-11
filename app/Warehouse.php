<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'warehouse';

    protected $fillable = [
        'user_id','warehouse_name'
    ];
    protected $primaryKey = 'warehouse_id';
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function warehouseDetail()
    {
        return $this->hasMany('App\WarehouseDetail');
    }
    public function container()
    {
        return $this->hasMany('App\Container');
    }
    public function warehouseImpact()
    {
        return $this->hasMany('App\WarehouseImpact');
    }
}
