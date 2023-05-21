<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class robot_temp_e_commerce extends Model
{
    use HasFactory;
    public $table = 'robot_temp_e_commerce';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    public function dOutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }

    public function listSaless(){
        return $this->belongsTo(listSales::class,'idListSales','id');
    }

    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'idSesi',
        'totalManual',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
