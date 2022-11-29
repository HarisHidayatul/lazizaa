<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesFill extends Model
{
    // use SoftDeletes;
    use HasFactory;
    public $table = 'salesFill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function salesHarians(){
        return $this->belongsTo(salesharian::class,'idSales','id');
    }

    protected $fillable = [
        'idListSales',
        'idSales',
        'cu',
        'cuRevisi',
        'total',
        'totalRevisi',
        'idRevisiCu',
        'idRevisiTotal',
        'idPengisi',
        'idPerevisi',
        'created_at',
        'update_at',
        // 'delete_at'
    ];
}
