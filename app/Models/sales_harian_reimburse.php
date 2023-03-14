<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sales_harian_reimburse extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'sales_harian_reimburse';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }

    public function sales_reimburses(){
        return $this->hasOne( sales_reimburse::class,'idSalesHarianReimburse','id');
    }

    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
