<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairLog extends Model
{
    protected $table ='repair_log';

    protected $fillable = [
        'cd_id','amount','unit_id','status'
    ];

    public function containerDetail()
    {
        return $this->belongsTo('App\ContainerDetail');
    }

    public function Unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
