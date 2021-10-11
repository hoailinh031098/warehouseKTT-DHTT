<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContainerStatus extends Model
{
    protected $table = 'container_status';

    protected $fillable = [
        'cs_name'
    ];

    public function containerDetail()
    {
        return $this->HasMany('App\ContainerDetail');
    }
}
