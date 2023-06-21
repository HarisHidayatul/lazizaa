<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutasi_pembayaran extends Model
{
    use HasFactory;
    public $table = 'mutasi_pembayaran';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function listItemPattyCash(){
        return $this->belongsTo(listItemPattyCash::class,'idPattyCash','id');
    }

    public function robot165Pembayaran(){
        return $this->hasMany(robot_165_pembayaran::class,'idMutasiPembayaran','id');
    }

    public function mutasiDetail(){
        return $this->belongsTo(mutasi_detail::class,'idMutasiDetail','id');
    }

    protected $fillable = [
        'idPattyCash',
        'idMutasiDetail',
        'created_at',
        'updated_at'
    ];
}
