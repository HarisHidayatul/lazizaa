<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class doutlet extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'doutlet';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dusers(){
        return $this->belongsTo(dUser::class,'id','idOutlet');
    }

    public function fsoharians(){
        return $this->belongsTo(fsoHarian::class,'id','dUserOutlet');
    }

    public function dBrands(){
        return $this->belongsTo(dBrand::class,'idBrand','id');
    }

    public function typeOutlets(){
        return $this->belongsToMany(typeOutlet::class,'outlet_type','idOutlet','idType');
    }

    public function outletListSaless(){
        return $this->belongsToMany(listSales::class,'outletListSales','idOutlet','idListSales');
    }

    public function dateSales(){
        return $this->belongsToMany(tanggalAll::class,'salesharian','idOutlet','idTanggal')->withPivot('id');
    }

    public function datefsoharian(){
        return $this->belongsToMany(tanggalAll::class,'fsoharian','idOutlet','idTanggal')->withPivot('id');
    }

    public function datePattyCash(){
        return $this->belongsToMany(tanggalAll::class,'pattyCashHarian','idOutlet','idTanggal')->withPivot('id');
    }
    
    public function dateWaste(){
        return $this->belongsToMany(tanggalAll::class,'wasteHarian','idOutlet','idTanggal')->withPivot('id');
    }

    protected $fillable = [
        'Nama Store',
        'Alamat Lengkap',
        'idBrand',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
