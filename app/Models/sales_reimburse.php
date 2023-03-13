<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_reimburse extends Model
{
    use HasFactory;
    public $table = 'sales_reimburse';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function salesHarianReimburses(){
        return $this->belongsTo(sales_harian_reimburse::class,'idSalesHarianReimburse','id');
    }

    protected $fillable = [
        'idSalesHarianReimburse',
        'total',
        'totalRevisi',
        'idRevisiTotal',
        'idPengisi',
        'idPerevisi',
        'created_at',
        'updated_at'
    ];
}
