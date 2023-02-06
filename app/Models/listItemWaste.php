<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listItemWaste extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'list_item_waste';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function satuans(){
        return $this->belongsTo(satuan::class,'idSatuan','id');
    }

    public function jenisBahans(){
        return $this->belongsTo(jenisBahan::class,'idJenisBahan','id');
    }
    
    protected $fillable = [
        'Item',
        'idSatuan',
        'idJenisBahan',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
