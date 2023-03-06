<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_bee_cloud extends Model
{
    use HasFactory;
    public $table = 'transaksi_bee_cloud';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_sales',
        'id_transaksi_bee_cloud',
        'trxdate_bee_cloud',
        'total',
        'id_list_sales',
        'sinkronisasi',
        'trxno_bee_cloud',
        'created_at',
        'updated_at'
    ];
}
