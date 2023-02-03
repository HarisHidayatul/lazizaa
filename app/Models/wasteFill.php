<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wasteFill extends Model
{
    use HasFactory;
    public $table = 'wastefill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function wasteHarians(){
        return $this->belongsTo(wasteHarian::class,'idWaste','id');
    }

    public function listItemWastes(){
        return $this->belongsTo(listItemWaste::class,'idListItem','id');
    }

    protected $fillable = [
        'idWaste',
        'idListItem',
        'quantity',
        'quantityRevisi',
        'idRevQuantity',
        'idPengisi',
        'idPerevisi',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
