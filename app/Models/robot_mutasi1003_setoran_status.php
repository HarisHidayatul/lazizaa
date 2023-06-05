<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_mutasi1003_setoran_status extends Model
{
    use HasFactory;
    public $table = 'robot_mutasi1003_setoran_status';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }

    public function mutasiSetorans(){
        return $this->belongsTo(mutasi_setoran::class,'idMutasiSetoran','id');
    }

    protected $fillable = [
        'idPemverifikasi',
        'idStatusRobot',
        'idMutasiSetoran',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
