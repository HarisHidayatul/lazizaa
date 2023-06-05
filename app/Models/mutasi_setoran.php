<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi_setoran extends Model
{
    use HasFactory;
    public $table = 'mutasi_setoran';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function mutasiTransaksis(){
        return $this->belongsTo(mutasi_transaksi::class,'idMutasiTransaksi','id');
    }

    public function robotMutasi1003Setorans(){
        return $this->hasMany(robot_mutasi1003_setoran_status::class,'idMutasiSetoran','id');
    }

    public function setorans(){
        return $this->belongsTo(setoran::class,'idSetoran','id');
    }

    protected $fillable = [
        'idMutasiTransaksi',
        'idSetoran',
        'created_at',
        'updated_at'
    ];
}
