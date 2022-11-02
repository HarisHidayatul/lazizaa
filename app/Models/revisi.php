<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class revisi extends Model
{
    use HasFactory;

    public $table = 'revisi';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $fillable = [
        'status',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
