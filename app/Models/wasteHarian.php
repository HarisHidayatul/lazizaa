<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class wasteHarian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'wasteharian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function listItemWastes(){
        return $this->belongsToMany(listItemWaste::class,'wastefill','idWaste','idListItem')->withPivot('id','quantity','quantityRevisi','idPengisi','idPerevisi','idRevQuantity');
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
