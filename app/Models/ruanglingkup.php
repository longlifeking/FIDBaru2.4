<?php

namespace App\Models;

use App\Models\fidtabel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruanglingkup extends Model
{
    use HasFactory;
    protected $fillable = ['fid_id', 'judulrl'];
    public function fidtabel()
    {
        return $this->belongsTo(fidtabel::class,'fid_id', 'id'); 
    }
    public function afetabel()
    {
        return $this->hasMany(afetabel::class,'ruang_id','id');
    }
}
