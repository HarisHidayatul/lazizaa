<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempItemAll extends Model
{
    use HasFactory;
    public $table = 'temp_img_all';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $fillable = [
        'imagePath',
        'idUser',
        'created_at',
        'updated_at'
    ];
}
