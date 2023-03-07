<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sales_harian_transaksi_bee_cloud extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'sales_harian_transaksi_bee_cloud';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }

    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
