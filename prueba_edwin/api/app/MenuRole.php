<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id'
        ,'menu_id'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
