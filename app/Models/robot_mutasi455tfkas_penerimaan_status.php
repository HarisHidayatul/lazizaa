<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_mutasi455tfkas_penerimaan_status extends Model
{
    use HasFactory;
    public $table = 'robot_mutasi455tfkas_penerimaan_status';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }

    public function pelunasanMutasiSaless(){
        return $this->belongsTo(pelunasan_mutasi_sales::class,'idPelunasanMutasiSales','id');
    }

    protected $fillable = [
        'idPemverifikasi',
        'idStatusRobot',
        'idPelunasanMutasiSales',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
