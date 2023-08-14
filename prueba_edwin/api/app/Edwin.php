<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edwin extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "edwin";
    protected $fillable = [
        'user_id'
        ,'xxxx_id'
        ,'yyyy_id'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
