<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSkema extends Model
{
    use HasFactory;

    protected $table = 'jenisskema';
    protected $fillable = [
        'kode_jenisskema',
        'nama_jenisskema',
        'deskripsi_jenisskema',
        'status_jenisskema'
    ];

    public function skema()
    {
        return $this->hasMany(Skema::class, 'jenisskema_id');
    }

    /**
     * Get status label (Aktif/Nonaktif)
     */
    public function getStatusLabelAttribute()
    {
        return $this->status_jenisskema ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->status_jenisskema) {
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
        return $this->status_jenisskema ? 'text-emerald-600' : 'text-rose-600';
    }

    /**
     * Get status dot color
     */
    public function getStatusDotAttribute()
    {
        return $this->status_jenisskema ? 'bg-emerald-500' : 'bg-rose-500';
    }
}
