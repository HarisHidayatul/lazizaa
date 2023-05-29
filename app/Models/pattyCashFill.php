<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pattyCashFill extends Model
{
    use HasFactory;
    public $table = 'patty_cash_fill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function pattyCashHarians(){
        return $this->belongsTo(pattyCashHarian::class,'idPattyCash','id');
    }

    public function listItemPattyCashs(){
        return $this->belongsTo(listItemPattyCash::class,'idPattyCash','id');
    }

    protected $fillable = [
        'idPattyCash',
        'idListItem',
        'quantity',
        'quantityRevisi',
        'total',
        'totalRevisi',
        'idRevQuantity',
        'idRevTotal',
        'idPengisi',
        'idPerevisi',
        'quantityRobot',
        'totalRobot',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
