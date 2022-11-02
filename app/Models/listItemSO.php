<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listItemSO extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'listItemSO';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function fsoharians(){
        return $this->belongsToMany(fsoHarian::class,'soFill','idItemSo','idSo')->withPivot('quantity');
    }

    public function satuans(){
        return $this->belongsTo(satuan::class,'idSatuan','id');
    }

    protected $fillable = [
        'Item',
        'idSatuan',
        'created_at',
        'update_at',
        'delete_at'
    ];

    public function soFills(){
        return $this->belongsTo(soFill::class,'id','idItemSO');
    }
}
