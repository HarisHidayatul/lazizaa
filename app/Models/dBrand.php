<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dBrand extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'dBrand';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function doutlets(){
        return $this->hasMany(doutlet::class,'idBrand','id');
    }

    public function listItemPattyCashs(){
        return $this->belongsToMany(listItemPattyCash::class,brandPattyCash::class,'idBrand','idListItem');
    }

    public function listItemWastes(){
        return $this->belongsToMany(listItemWaste::class,brandWaste::class,'idBrand','idListItem');
    }
    
    protected $fillable = [
        'Nama Brand',
        'Keterangan',
        'Logo URL',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
