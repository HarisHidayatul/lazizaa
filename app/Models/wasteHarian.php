<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class wasteHarian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'wasteHarian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function dOutlets(){
        return $this->hasMany(doutlet::class,'id');
    }

    public function listItemWastes(){
        return $this->belongsToMany(listItemWaste::class,'wasteFill','idWaste','idListItem')->withPivot('id','quantity','quantityRevisi','idPengisi','idPerevisi','idRevQuantity');
    }
    protected $fillable = [
        'idOutlet',
        'idTanggal',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
