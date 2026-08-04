<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'jenjang_prodi',
        'kaprodi',
        'email_prodi',
        'notelp_prodi',
        'status_prodi',
        'fakultas_id',
    ];

    // Relasi ke tabel Fakultas
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function proposalMahasiswa()
    {
        return $this->hasMany(ProposalMahasiswa::class, 'prodi_id');
    }

    public function proposal()
    {
        return $this->hasMany(Proposal::class, 'prodi_id');
    }

    /**
     * Get status label (Aktif/Nonaktif)
     */
    public function getStatusLabelAttribute()
    {
        return $this->status_prodi ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->status_prodi) {
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

    /**
     * Get status color class
     */
    public function getStatusColorAttribute()
    {
        return $this->status_prodi ? 'text-emerald-600' : 'text-rose-600';
    }

    /**
     * Get status dot color
     */
    public function getStatusDotAttribute()
    {
        return $this->status_prodi ? 'bg-emerald-500' : 'bg-rose-500';
    }
}
