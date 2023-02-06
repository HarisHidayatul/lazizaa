<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reqItemSales extends Model
{
    use HasFactory;
    public $table = 'req_item_sales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function doutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    public function listSaless(){
        return $this->belongsTo(listSales::class,'idSales','id');
    }
    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }
    
    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPengisi','id');
    }

    protected $fillable = [
        'idOutlet',
        'idSales',
        'idPengisi',
        'idTanggal',
        'created_at',
        'updated_at',
    ];
    
}
