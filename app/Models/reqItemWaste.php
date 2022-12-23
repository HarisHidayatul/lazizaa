<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reqItemWaste extends Model
{
    use HasFactory;
    public $table = 'reqItemWaste';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function doutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    public function dbrands(){
        return $this->hasOneThrough(dBrand::class,doutlet::class,'id','id','idOutlet','idBrand');
    }

    public function satuans(){
        return $this->belongsTo(satuan::class,'idSatuan','id');
    }

    public function jenisBahans(){
        return $this->belongsTo(jenisBahan::class,'idJenisBahan','id');
    }
    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }
    
    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPengisi','id');
    }

    protected $fillable = [
        'Item',
        'idSatuan',
        'idOutlet',
        'idBrand',
        'idPengisi',
        'idTanggal',
        'idJenisBahan',
        'created_at',
        'updated_at',
    ];
}
