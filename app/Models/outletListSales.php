<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outletListSales extends Model
{
    use HasFactory;

    public $table = 'outletListSales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idOutlet',
        'idListSales',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
