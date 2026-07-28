<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';

    protected $fillable = [
        'kode_periode',
        'nama_periode',
        'tahun_anggaran',
        'semester',
        'keterangan_periode',
        'status_periode'
    ];

    public function skema()
    {
        return $this->belongsToMany(
            Skema::class,
            'periode_skema'
        )
            ->using(PeriodeSkema::class)
            ->withPivot([
                'tanggal_mulai_pengajuan',
                'tanggal_selesai_pengajuan',
                'tanggal_mulai_review',
                'tanggal_selesai_review',
                'tanggal_pengumuman',
                'kuota_proposal',
                'dana_minimal',
                'dana_maksimal',
                'maksimal_anggota',
                'luaran_wajib',
                'status',
                'keterangan'
            ])
            ->withTimestamps();
    }

    protected $casts = [
        'status_periode' => 'boolean',
    ];

    public function getStatusLabelAttribute()
    {
        return $this->status_periode ? 'Aktif' : 'Nonaktif';
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->status_periode) {
            return '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        Aktif
                    </span>';
        }
        return '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-semibold bg-rose-100 text-rose-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                    Nonaktif
                </span>';
    }

    public function getSemesterIconAttribute()
    {
        return $this->semester == 'Ganjil' ? 'fa-sun' : 'fa-moon';
    }

    public function getSemesterColorAttribute()
    {
        return $this->semester == 'Ganjil' ? 'text-amber-500' : 'text-indigo-500';
    }
}
