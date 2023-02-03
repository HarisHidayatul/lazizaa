<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listBank extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'listbank';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function jenisBanks(){
        return $this->belongsTo(jenisBank::class,'idJenisBank','id');
    }

    protected $fillable = [
        'bank',
        'imageBank',
        'idJenisBank',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
