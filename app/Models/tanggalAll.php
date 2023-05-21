<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanggalAll extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'tanggal_all';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function salesharians(){
        return $this->hasMany(salesharian::class,'idTanggal','id');
    }

    public function mutasiTransaksis(){
        return $this->hasMany(mutasi_transaksi::class,'idTanggal','id');
    }

    public function salesHarianReimburses(){
        return $this->hasMany(sales_harian_reimburse::class,'idTanggal','id');
    }

    public function fsoharians(){
        return $this->hasMany(fsoHarian::class,'idTanggal','id')->orderBy('idSesi','DESC');
    }

    public function pattyCashHarians(){
        return $this->hasMany(pattyCashHarian::class,'idTanggal','id');
    }

    public function wasteHarians(){
        return $this->hasMany(wasteHarian::class,'idTanggal','id');
    }

    public function reqItemSaless(){
        return $this->hasMany(reqItemSales::class,'idTanggal','id');
    }

    public function reqItemPattyCashs(){
        return $this->hasMany(reqItemPattyCash::class,'idTanggal','id');
    }

    public function reqItemWastes(){
        return $this->hasMany(reqItemWaste::class,'idTanggal','id');
    }

    public function setorans(){
        // return $this->hasMany(setoran::class,'idTanggal','id')->orderBy('id','DESC');
        return $this->hasMany(setoran::class,'idTanggal','id');
    }

    public function reimburses(){
        return $this->hasMany(reimburse::class,'idTanggal','id');
    }

    public function robotTempECommerces(){
        return $this->hasMany(robot_temp_e_commerce::class,'idTanggal','id');
    }

    public function robotECommerceStatuss(){
        return $this->hasMany(robot_ecommerce_status::class,'idTanggal','id');
    }
    
    protected $fillable = [
        'Tanggal',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
