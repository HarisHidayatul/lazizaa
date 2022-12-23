<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class satuan extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'satuan';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'Satuan',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
