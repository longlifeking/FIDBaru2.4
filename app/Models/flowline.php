<?php

namespace App\Models;

use App\Models\field;
use App\Models\afetabel;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class flowline extends Model
{
    use HasFactory;

    public function scopeNamaFields($query, $value)
    {
        return $query->where('nama_fields', $value);
    }

    public function afetabels()
    {
        return $this->hasOne(afetabel::class, 'id', 'afe_flow');
    }
    public function field()
    {
       return $this->hasOne(field::class,'id','nama_fields');
    }

    protected $fillable = [
      'afe_flow',
      'slug',
      'vendor',
      'nama_fields',
      'hari_project',
      'panjang_2inch', 
      'panjang_3inch',
      'Nilai_ProyekRP',
      'Nilai_ProyekUSD',
      'Keterangan'
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
