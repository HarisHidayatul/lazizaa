<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelunasan_mutasi_sales extends Model
{
    // use SoftDeletes;
    use HasFactory;

    public $table = 'pelunasan_mutasi_sales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function mutasiTransaksis(){
        return $this->belongsTo(mutasi_transaksi::class,'idMutasiTransaksi','id');
    }

    public function salesFills(){
        return $this->belongsTo(salesFill::class,'idSalesFill','id');
    }

    protected $fillable = [
        'idMutasiTransaksi',
        'idSalesFill',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
