<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempImgAll extends Model
{
    use HasFactory;
    public $table = 'temp_img_all';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $fillable = [
        'imagePath',
        'created_at',
        'updated_at'
    ];
}
