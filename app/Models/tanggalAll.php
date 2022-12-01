<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanggalAll extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'tanggalAll';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function salesharians(){
        return $this->hasMany(salesharian::class,'idTanggal','id');
    }

    public function fsoharians(){
        return $this->hasMany(fsoHarian::class,'idTanggal','id');
    }

    public function pattyCashHarians(){
        return $this->hasMany(pattyCashHarian::class,'idTanggal','id');
    }

    public function wasteHarians(){
        return $this->hasMany(wasteHarian::class,'idTanggal','id');
    }

    public function reqItemSaless(){
        return $this->hasMany(reqItemSales::class,'idTanggal','id');
    }

    protected $fillable = [
        'Tanggal',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
