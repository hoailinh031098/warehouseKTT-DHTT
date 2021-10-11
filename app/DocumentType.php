<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
        'dt_name','dt_content'
    ];
    protected $table = 'document_types';
    protected $primaryKey = 'td_id';
    public $timestamps = false;
}
