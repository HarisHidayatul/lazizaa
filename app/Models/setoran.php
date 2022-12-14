<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class setoran extends Model
{
    // use SoftDeletes;
    use HasFactory;

    public $table = 'setoran';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function pengirimLists(){
        return $this->belongsTo(pengirimList::class,'idPengirim','id');
    }

    public function penerimaLists(){
        return $this->belongsTo(penerimaList::class,'idTujuan','id');
    }

    public function revisis(){
        return $this->belongsTo(revisi::class, 'idRevisi', 'id');
    }

    protected $fillable = [
        'idPengirim',
        'idOutlet',
        'idTujuan',
        'idRevisi',
        'idTanggal',
        'qtySetor',
        'imgTransfer',
        'created_at',
        'update_at'
    ];
}
