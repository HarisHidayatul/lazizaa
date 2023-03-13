<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori_patty_cash extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'kategori_patty_cash';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'namaKategori',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
