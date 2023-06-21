<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_165_pembayaran extends Model
{
    use HasFactory;
    public $table = 'robot_165_pembayaran';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }

    public function mutasiPembayaran(){
        return $this->belongsTo(mutasi_pembayaran::class,'idMutasiPembayaran','id');
    }
    
    protected $fillable = [
        'idPemverifikasi',
        'idStatusRobot',
        'idMutasiPembayaran',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
