<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mutasi_sales extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'mutasi_sales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function listSaless(){
        return $this->belongsTo(listSales::class,'idListSales','id');
    }
    public function dOutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }
    protected $fillable = [
        'idMutasiTransaksi',
        'idOutlet',
        'idListSales',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
