<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_user'
    ];
    protected $table = 'role';
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
