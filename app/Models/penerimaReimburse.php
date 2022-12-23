<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penerimaReimburse extends Model
{
    use HasFactory;

    public $table = 'penerimaReimburse';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function listBanks(){
        return $this->belongsTo(listBank::class,'idBank','id');
    }

    public function tanggalAlls(){
        return $this->hasOneThrough(tanggalAll::class,reimburse::class,'id','id','idReimburse','idTanggal');
    }

    public function penerimaLists(){
        return $this->belongsTo(penerimaList::class,'idPengirim','id');
    }

    protected $fillable = [
        'idPengirim',
        'idReimburse',
        'idBank',
        'idRevisi',
        'namaRekening',
        'nomorRekening',
        'pesan',
        'imgTransfer',
        'qty',
        'idPengisi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
