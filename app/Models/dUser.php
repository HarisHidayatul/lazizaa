<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dUser extends Model
{
    // composer dump-autoload -> reload tinker
    use SoftDeletes;
    use HasFactory;
    public $table = 'duser';
    public $guarded = ['id'];
    protected $primaryKey = 'id';

    public function fsoharians(){
        return $this->belongsTo(fsoHarian::class,'id','idPengisi');
    }
    public function droles(){
        return $this->hasOne(drole::class,'id');
    }
    public function doutlets(){
        return $this->belongsTo(doutlet::class,'idOutlet','id');
    }

    protected $fillable = [
        'idRole',
        'idOutlet',
        'Username',
        'Password',
        'Nama Lengkap',
        'Email',
        'created_at',
        'updated_at'
    ];
}
