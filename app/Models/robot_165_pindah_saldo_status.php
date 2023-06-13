<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_165_pindah_saldo_status extends Model
{
    use HasFactory;
    public $table = 'robot_165_pindah_saldo_status';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }
    
    public function mutasiDetails(){
        return $this->belongsTo(mutasi_detail::class,'idMutasiDetail','id');
    }

    protected $fillable = [
        'idPemverifikasi',
        'idStatusRobot',
        'idMutasiDetail',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
