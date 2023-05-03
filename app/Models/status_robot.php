<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class status_robot extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'status_robot';
    protected $primaryKey = 'id';
    public $guarded = ['id'];
    
    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
