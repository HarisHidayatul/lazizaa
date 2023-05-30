<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mutasi_klasifikasi extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'mutasi_klasifikasi';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    protected $fillable = [
        'klasifikasi',
        'idListSalesTemp',
        'idListSalesTemp2',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
