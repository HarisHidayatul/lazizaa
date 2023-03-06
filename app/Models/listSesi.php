<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class listSesi extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'list_sesi';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $fillable = [
        'sesi',
        'startTime',
        'stopTime',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
