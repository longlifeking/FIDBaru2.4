<?php

namespace App\Models;

use App\Models\statu;
use App\Models\flowline;
use App\Models\quartercor;
use App\Models\ruanglingkup;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class afetabel extends Model
{
    use HasFactory;
    
    public function statu()
    {
        return $this->belongsTo(statu::class, 'status_id', 'id');
    }
    public function quartercor()
    {
        return $this->belongsTo(quartercor::class, 'quarter_id', 'id');
    }
    public function ruanglingkup()
    {
        return $this->belongsTo(ruanglingkup::class,'ruang_id','id');
    }
    public function flowline()
    {
        return $this->belongsTo(flowline::class,'afe_flow','id');
    }
    protected $fillable = [
        'ruang_id',
        'no_afe',
        'judul_afe',
        'slug',
        'nilai_afe',
        'nilai_closing',
        'status_id',
        'targetcor',
        'targetpekerajaan',
        'quarter_id',
        'PS',
        'BS',
        'PISPPP',
        'COR'
    ];
    public function Sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul_afe'
            ]
        ];
    }
}
