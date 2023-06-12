<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_mutasi165_reimburse_status extends Model
{
    use HasFactory;
    public $table = 'robot_mutasi165_reimburse_status';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }
    
    public function mutasiTransaksis(){
        return $this->belongsTo(mutasi_transaksi::class,'idMutasiTransaksi','id');
    }

    public function mutasiReimburses(){
        return $this->belongsTo(mutasi_reimburse::class,'idMutasiReimburse','id');
    }

    protected $fillable = [
        'idPemverifikasi',
        'idStatusRobot',
        'idMutasiTransaksi',
        'idMutasiReimburse',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
