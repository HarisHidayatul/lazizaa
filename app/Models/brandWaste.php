<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brandWaste extends Model
{
    use HasFactory;
    public $table = 'brandwaste';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idBrand',
        'idListItem',
        'created_at',
        'updated_at'
    ];
}
