<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soHarianBatas extends Model
{
    use HasFactory;
    public $table = 'so_harian_batas';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPengisi','id');
    }
    public function listItemSOs(){
        return $this->belongsTo(listItemSO::class,'idItemSo','id');
    }
    protected $fillable = [
        'idItemSo',
        'quantity',
        'idPengisi',
        'idOutlet',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
