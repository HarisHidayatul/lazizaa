<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi_reimburse extends Model
{
    use HasFactory;
    public $table = 'mutasi_reimburse';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function mutasiTransaksis(){
        return $this->belongsTo(mutasi_transaksi::class,'idMutasiTransaksi','id');
    }
    public function penerimaReimburses(){
        return $this->belongsTo(penerimaReimburse::class,'idPenerimaReimburse','id');
    }
    public function robotMutasi165Reimburse(){
        return $this->hasMany(robot_mutasi165_reimburse_status ::class,'idMutasiReimburse','id');
    }
    protected $fillable = [
        'idMutasiTransaksi',
        'idPenerimaReimburse',
        'created_at',
        'updated_at',
    ];
}
