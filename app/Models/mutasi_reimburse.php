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

    protected $fillable = [
        'idMutasiTransaksi',
        'idPenerimaReimburse',
        'created_at',
        'updated_at',
    ];
}
