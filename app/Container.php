<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $table = 'container';

    protected $fillable = [
        'container_name','warehouse_id','status'
    ];

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }

    public function containerDetail()
    {
        return $this->hasMany('App\ContainerDetail');
    }


}
