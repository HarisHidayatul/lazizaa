<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mutasi_transaksi extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'mutasi_transaksi';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function penerimaLists(){
        return $this->belongsTo(penerimaList::class,'idPenerimaList','id');
    }

    public function mutasiSaless(){
        return $this->hasOne(mutasi_sales::class,'idMutasiTransaksi','id');
    }

    protected $fillable = [
        'trxNotes',
        'total',
        'idTanggal',
        'idPenerimaList',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
