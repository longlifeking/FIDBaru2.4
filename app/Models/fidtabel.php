<?php

namespace App\Models;

use App\Models\field;
use App\Models\afetabel;
use App\Models\pelaksana;
use App\Models\ruanglingkup;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fidtabel extends Model
{
    use HasFactory;

    public function pelaksana()
    {
        return $this->belongsTo(pelaksana::class, 'pelaksana_id', 'id');
    }
    public function field()
    {
        return $this->belongsTo(field::class, 'fields_id', 'id');
    }
    public function ruangLingkup()
    {
        return $this->hasMany(ruanglingkup::class, 'fid_id','id');
    }
    public function getTotalNilaiAfeAttribute() //masih salah 
    {
        $totalNilaiAfe = 0;

        foreach ($this->ruanglingkup as $ruanglingkup) {
            $totalNilaiAfe += $ruanglingkup->afetabel()->sum('nilai_afe');
        }

        return $totalNilaiAfe;
    }
    public function getTotalNilaiCorAttribute()
    {
        $totalNilaiCor = 0;
        foreach ($this->ruanglingkup as $ruanglingkup) {
            $totalNilaiCor += $ruanglingkup->afetabel()->sum('nilai_closing');
        
        }
        return $totalNilaiCor;
    }
    protected $fillable = [
        'judul',
        'slug',
        'tgl',
        'nilaifid',
        'filepath',
        'fields_id',
        'pelaksana_id',
        'filepod',

    ];
    public function Sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
    
}
