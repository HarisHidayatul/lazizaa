<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reqItemPattyCash extends Model
{
    use HasFactory;
    public $table = 'req_item_patty_cash';
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
        'created_at',
        'updated_at',
    ];
}
