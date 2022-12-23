<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pattyCashHarian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'pattyCashHarian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function listItemPattyCashs(){
        return $this->belongsToMany(listItemPattyCash::class,'pattyCashFill','idPattyCash','idListItem')->withPivot('id','idPerevisi','quantity','quantityRevisi','total','totalRevisi','idPengisi','idRevQuantity','idRevTotal');
    }
    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }
    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
