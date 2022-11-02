<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pattyCashFill extends Model
{
    use HasFactory;
    public $table = 'pattyCashFill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

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
        'created_at',
        'update_at',
        // 'delete_at'
    ];
}
