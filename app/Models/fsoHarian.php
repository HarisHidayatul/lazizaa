<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fsoHarian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'fso_harian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    public function dUsers(){
        return $this->belongsTo(dUser::class,'idPengisi','id');
    }
    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }
    public function soFills(){
        return $this->belongsTo(soFill::class,'id','idSo');
    }
    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }
    public function listItemSOs(){
        return $this->belongsToMany(listItemSO::class,soFill::class,'idSo','idItemSo')->withPivot('quantity','idRevisi','quantityRevisi','id','idPerevisi')->orderBy('id');
    }
    protected $fillable = [
        'idPengisi',
        'idOutlet',
        'idTanggal',
        'idSesi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
