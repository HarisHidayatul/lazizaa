<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penerimaList extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'penerimaList';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'idBank',
        'namaRekening',
        'nomorRekening',
        'created_at',
        'update_at',
        'delete_at'
    ];
}
