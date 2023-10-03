<?php

namespace App\Models;

use App\Models\fidtabel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class field extends Model
{
    use HasFactory;
    public function fidtabel()
    {
        return $this->hasMany(fidtabel::class,'field_id', 'id');
    }
    public function flowline()
    {
        return $this->belongsTo(flowline::class,'nama_fields','id');
    }

    
}
