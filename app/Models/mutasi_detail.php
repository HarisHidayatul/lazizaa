<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi_detail extends Model
{
    use HasFactory;
    public $table = 'mutasi_detail';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function mutasiAksis(){
        return $this->belongsTo(mutasi_aksi::class,'idMutasiAksi','id');
    }

    public function mutasiKlasifikasis(){
        return $this->belongsTo(mutasi_klasifikasi::class,'idMutasiKlasifikasi','id');
    }

    public function doutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    protected $fillable = [
        'idMutasiAksi',
        'idMutasiTransaksi',
        'idMutasiKlasifikasi',
        'idOutlet',
        'selisihHari',
        'created_at',
        'updated_at'
    ];
}
