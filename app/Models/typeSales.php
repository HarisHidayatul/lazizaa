<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class typeSales extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'type_sales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function listSaless(){
        return $this->hasMany(listSales::class,'typeSales','id');
    }

    protected $fillable = [
        'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
