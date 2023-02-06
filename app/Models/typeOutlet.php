<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class typeOutlet extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'type_outlet';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function listItemSOs(){
        return $this->belongsToMany(listItemSO::class,type_item::class,'idBahanBaku','idItem');
    }

    public function doutlets(){
        return $this->belongsToMany(doutlet::class,outlet_type::class,'idType','idOutlet');
    }

    protected $fillable = [
        'Nama Type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
