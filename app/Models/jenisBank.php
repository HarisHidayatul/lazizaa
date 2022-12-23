<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenisBank extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'jenisBank';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'jenis',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
