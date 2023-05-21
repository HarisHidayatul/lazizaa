<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listSales extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'list_sales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function typeSaless(){
        return $this->belongsTo(typeSales::class,'typeSales','id');
    }
    protected $fillable = [
        'typeSales',
        'sales',
        'butuhVerifikasi',
        'id_channel_bee_cloud',
        'keywoardBee',
        'itemBee',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
