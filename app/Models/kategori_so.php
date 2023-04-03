<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori_so extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'kategori_so';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function listItemSOs(){
        return $this->hasMany(listItemSO::class,'idKategoriSo','id');
    }

    protected $fillable = [
        'namaKategori',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
