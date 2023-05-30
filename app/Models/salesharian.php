<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class salesharian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'sales_harian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    public function dOutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    public function listSaless(){
        return $this->belongsToMany(listSales::class,salesFill::class,'idSales','idListSales')->withPivot('total','totalRevisi','idRevisiTotal','id','idPengisi','idPerevisi','totalDiterima','idRevDiterima','created_at','updated_at');
    }

    public function salesFills(){
        return $this->hasMany(salesFill::class,'idSalesFill','id');
    }

    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }

    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'idSesi',
        'totalManual',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
