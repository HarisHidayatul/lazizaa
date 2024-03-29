<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penerimaReimburse extends Model
{
    use HasFactory;

    public $table = 'penerima_reimburse';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function tanggalAlls(){
        return $this->hasOneThrough(tanggalAll::class,reimburse::class,'id','id','idReimburse','idTanggal');
    }

    public function penerimaLists(){
        return $this->belongsTo(penerimaList::class,'idPengirim','id');
    }

    public function pengirimLists(){
        return $this->belongsTo(pengirimList::class,'idTujuan','id');
    }

    public function listBanks(){
        return $this->hasOneThrough(listBank::class,pengirimList::class,'id','id','idTujuan','idBank');
    }

    public function mutasiReimburses(){
        return $this->hasOne(mutasi_reimburse::class,'idPenerimaReimburse','id');
    }

    public function reimburses(){
        return $this->belongsTo(reimburse::class,'idReimburse','id');
    }

    protected $fillable = [
        'idTujuan',
        'idPengirim',
        'idReimburse',
        'idRevisi',
        'pesan',
        'imgTransfer',
        'qty',
        'idPengisi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
