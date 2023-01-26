<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listBank extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'listBank';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function jenisBanks(){
        return $this->belongsTo(jenisBank::class,'idJenisBank','id');
    }

    protected $fillable = [
        'idJenisBank',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}