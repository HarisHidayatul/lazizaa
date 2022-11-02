<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listItemPattyCash extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'listItemPattyCash';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

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
}
