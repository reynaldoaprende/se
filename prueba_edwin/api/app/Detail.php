<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detail_type_id','name','value'
    ];
}
