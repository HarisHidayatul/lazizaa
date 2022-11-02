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

    protected $fillable = [
        'Item',
        'idSatuan',
        'idOutlet',
        'idJenisBahan',
        'created_at',
        'update_at',
    ];
}
