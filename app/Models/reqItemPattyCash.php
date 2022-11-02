<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reqItemPattyCash extends Model
{
    use HasFactory;
    public $table = 'reqItemPattyCash';
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

    protected $fillable = [
        'Item',
        'idSatuan',
        'idOutlet',
        'created_at',
        'update_at',
    ];
}
