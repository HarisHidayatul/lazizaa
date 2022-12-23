<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class soFill extends Model
{
    // use SoftDeletes;
    use HasFactory;
    public $table = 'soFill';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    public function fsoHarians(){
        return $this->hasMany(fsoHarian::class,'id');
    }
    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPerevisi','id');
    }
    public function listItemSOs(){
        return $this->hasMany(listItemSO::class,'id');
    }
    public function soRevisis(){
        return $this->belongsTo(soRevisi::class,'idSoFill');
    }
    protected $fillable = [
        'idSo',
        'idItemSo',
        'quantity',
        'idRevisi',
        'quantityRevisi',
        'idPerevisi',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
