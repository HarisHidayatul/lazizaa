<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesFill extends Model
{
    // use SoftDeletes;
    use HasFactory;
    public $table = 'sales_fill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function salesHarians(){
        return $this->belongsTo(salesharian::class,'idSales','id');
    }

    public function listSaless(){
        return $this->belongsTo(listSales::class,'idListSales','id');
    }

    public function pelunasanMutasiSaless(){
        return $this->hasMany(pelunasan_mutasi_sales::class,'idSalesFill','id');
    }

    protected $fillable = [
        'idListSales',
        'idSales',
        'total',
        'totalRevisi',
        'totalDiterima',
        'idRevDiterima',
        'idRevisiTotal',
        'idPengisi',
        'idPerevisi',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
