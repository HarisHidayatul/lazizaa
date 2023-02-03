<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penerimaList extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'penerimalist';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function listBanks(){
        return $this->belongsTo(listBank::class,'idBank','id');
    }
    
    protected $fillable = [
        'idBank',
        'namaRekening',
        'nomorRekening',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
