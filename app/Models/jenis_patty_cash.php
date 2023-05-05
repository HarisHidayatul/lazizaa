<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenis_patty_cash extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'jenis_patty_cash';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function kategori_patty_cashs(){
        return $this->belongsTo(kategori_patty_cash::class,'idKategori','id');
    }

    protected $fillable = [
        'namaJenis',
        'kodeAkun',
        'idKategori',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
