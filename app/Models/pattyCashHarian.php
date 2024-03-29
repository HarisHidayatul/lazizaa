<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pattyCashHarian extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'patty_cash_harian';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    public function dOutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    public function robotPembelianStatuss(){
        return $this->hasMany(robot_pembelian_status::class,'idPattyCashHarian','id');
    }

    public function robotPembayaranStatuss(){
        return $this->hasMany(robot_pembayaran_status::class,'idPattyCashHarian','id');
    }

    public function listItemPattyCashs(){
        return $this->belongsToMany(listItemPattyCash::class,pattyCashFill::class,'idPattyCash','idListItem')->withPivot('id','idPerevisi','quantity','quantityRevisi','total','totalRevisi','idPengisi','idRevQuantity','idRevTotal','quantityRobot','totalRobot');
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
