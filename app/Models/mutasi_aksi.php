<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mutasi_aksi extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'mutasi_aksi';
    protected $primaryKey = 'id';
    public $guarded = ['id'];

    protected $fillable = [
        'aksi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
