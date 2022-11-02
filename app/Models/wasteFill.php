<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wasteFill extends Model
{
    use HasFactory;
    public $table = 'wasteFill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $fillable = [
        'idWaste',
        'idListItem',
        'quantity',
        'quantityRevisi',
        'idRevQuantity',
        'idPengisi',
        'idPerevisi',
        'created_at',
        'update_at',
        // 'delete_at'
    ];
}
