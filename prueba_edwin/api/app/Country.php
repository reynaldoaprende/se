<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Country extends Model
{
    use Notifiable;
    public $timestamps = false;
    protected $table='countries';
    protected $primaryKey="id";
    protected $fillable = [
        'name'
        ,'code'
        ,'initials'
    ];
    public function states(){return $this->hasMany('App\State','country_id');}
}

