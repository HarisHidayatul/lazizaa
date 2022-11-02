<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class typeOutlet extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'typeOutlet';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function listItemSOs(){
        return $this->belongsToMany(listItemSO::class,'type_item','idBahanBaku','idItem');
    }

    public function doutlets(){
        return $this->belongsToMany(doutlet::class,'outlet_type','idType','idOutlet');
    }

    protected $fillable = [
        'Nama Type',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
