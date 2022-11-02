<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class type_item extends Model
{
    use HasFactory;
    // use SoftDeletes;
    use HasFactory;

    public $table = 'type_item';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idBahanBaku',
        'idItem',
        'created_at',
        'update_at',
        // 'delete_at'
    ];
}
