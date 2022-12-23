<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class drole extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'drole';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function dusers(){
        return $this->belongsTo(dUser::class,'id','idRole');
    }
    
    protected $fillable = [
        'Role',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
