<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listSales extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'listSales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function typeSaless(){
        return $this->belongsTo(typeSales::class,'typeSales','id');
    }
    protected $fillable = [
        'typeSales',
        'sales',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
