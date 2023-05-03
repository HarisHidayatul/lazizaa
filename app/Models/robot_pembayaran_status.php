<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_pembayaran_status extends Model
{
    use HasFactory;
    public $table = 'robot_pembayaran_status';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPemverifikasi','id');
    }

    public function statusRobots(){
        return $this->belongsTo(status_robot::class,'idStatusRobot','id');
    }

    public function pattyCashHarians(){
        return $this->belongsTo(pattyCashHarian::class,'idPattyCashHarian','id');
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
