<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $table = 'skema';
    protected $fillable = [
        'kode_skema',
        'nama_skema',
        'deskripsi_skema',
        'dana_minimalskema',
        'dana_maksimalskema',
        'durasi_bulan',
        'status_skema',
        'jenisskema_id'
    ];

    public function jenisskema()
    {
        return $this->belongsTo(JenisSkema::class, 'jenisskema_id');
    }

    /**
     * Get status label (Aktif/Nonaktif)
     */
    public function getStatusLabelAttribute()
    {
        return $this->status_skema ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->status_skema) {
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
        return $this->status_skema ? 'text-emerald-600' : 'text-rose-600';
    }

    /**
     * Get status dot color
     */
    public function getStatusDotAttribute()
    {
        return $this->status_skema ? 'bg-emerald-500' : 'bg-rose-500';
    }
}
