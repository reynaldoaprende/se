<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class State extends Model
{
    use Notifiable;
    public $timestamps = false;
    protected $table='states';
    protected $primaryKey="id";
    protected $fillable = [
        'name'
        ,'code'
        ,'country_id'
    ];
    public function country(){return $this->belongsTo('App\Country','country_id');}
    public function locations(){return $this->hasMany('App\Location','state_id');}
}

