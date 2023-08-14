<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Añadimos la clase JWTSubject 
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document'
        ,'role_id'
        ,'name'
        ,'last_name'
        ,'birthdate'
        ,'address'
        ,'email'
        ,'phone'
        ,'password'
        ,'enabled'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
        ,'consent_id'
        ,'consent_date'
        ,'last_form_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        Añadiremos estos dos métodos
    */
    public function getJWTIdentifier(){return $this->getKey();}

    public function getJWTCustomClaims(){return [];}

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }
}
