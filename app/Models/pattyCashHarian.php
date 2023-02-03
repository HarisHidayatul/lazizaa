<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pattyCashHarian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'pattycashharian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function listItemPattyCashs(){
        return $this->belongsToMany(listItemPattyCash::class,'pattycashfill','idPattyCash','idListItem')->withPivot('id','idPerevisi','quantity','quantityRevisi','total','totalRevisi','idPengisi','idRevQuantity','idRevTotal');
    }
    public function tanggalAlls(){
        return $this->belongsTo(tanggalAll::class,'idTanggal','id');
    }
    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'idSesi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
