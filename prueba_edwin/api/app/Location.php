<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Location extends Model
{
    use Notifiable;
    public $timestamps = false;
    protected $table='locations';
    protected $primaryKey="id";
    protected $fillable = [
        'name'
        ,'code'
        ,'state_id'
    ];
    public function state(){return $this->belongsTo('App\State','state_id');}
}

