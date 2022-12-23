<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenisBahan extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'jenisBahan';
    public $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function listItemWastes(){
        return $this->hasMany(listItemWaste::class,'idJenisBahan','id');
    }

    protected $fillable = [
        'jenis',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
