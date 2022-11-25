<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reqItemSales extends Model
{
    use HasFactory;
    public $table = 'reqItemSales';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function doutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    public function listSaless(){
        return $this->belongsTo(listSales::class,'idSales','id');
    }

    protected $fillable = [
        'idOutlet',
        'idSales',
        'created_at',
        'update_at',
    ];
    
}
