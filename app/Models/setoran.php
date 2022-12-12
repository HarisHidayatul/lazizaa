<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class setoran extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'setoran';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idPengirim',
        'idTujuan',
        'idRevisi',
        'time',
        'qtySetor',
        'imgTransfer',
        'created_at',
        'update_at'
    ];
}
