<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class outlet_type extends Model
{
    // use SoftDeletes;
    use HasFactory;

    public $table = 'outlet_type';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idOutlet',
        'idType',
        'created_at',
        'updated_at',
        // 'deleted_at'
    ];
}
