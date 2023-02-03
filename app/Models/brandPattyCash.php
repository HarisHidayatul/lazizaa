<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brandPattyCash extends Model
{
    use HasFactory;
    public $table = 'brandpattycash';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idBrand',
        'idListItem',
        'created_at',
        'updated_at'
    ];
}
