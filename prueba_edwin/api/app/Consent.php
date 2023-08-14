<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'video',
        'reject',
        'agree'

    ];
}
