<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelecommunicationCenter extends Model
{
    protected $fillable = [
        'tc_name','tc_address'
    ];
    protected $table = 'telecommunication_centers';
    protected $primaryKey = 'tc_id';
    public $timestamps = false;

    public function station()
    {
        return $this->hasMany('App\Station');
    }

}
