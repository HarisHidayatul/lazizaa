<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_pembelian_status extends Model
{
    use HasFactory;
    public $table = 'robot_pembelian_status';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }

    protected $fillable = [
        'idPattyCashHarian',
        'idPemverifikasi',
        'idStatusRobot',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
