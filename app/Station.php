<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = [
        'station_name','station_lat','station_long','tc_id'
    ];
    protected $table = 'stations';
    protected $primaryKey = 'station_id';
    public $timestamps = false;

    public function telecommunicationCenter()
    {
        return $this->belongsTo('App\TelecommunicationCenter');
    }
}
