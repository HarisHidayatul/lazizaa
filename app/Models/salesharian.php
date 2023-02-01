<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class salesharian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'salesharian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function listSaless(){
        return $this->belongsToMany(listSales::class,'salesFill','idSales','idListSales')->withPivot('cu','cuRevisi','total','totalRevisi','idRevisiCu','idRevisiTotal','id','idPengisi','idPerevisi','totalDiterima','idRevDiterima');
    }

    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }

    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'idSesi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
