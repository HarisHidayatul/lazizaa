<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reimburse extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'reimburse';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function penerimaReimburses(){
        return $this->hasMany(penerimaReimburse::class,'idReimburse','id');
    }
    
    protected $fillable = [
        'idTanggal',
        'idOutlet',
        'saldoTerakhir',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
