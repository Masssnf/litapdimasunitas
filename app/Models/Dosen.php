<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'nidn',
        'nama_dosen',
        'jenis_kelamin',
        'email_dosen',
        'notelp_dosen',
        'alamat_dosen',
        'status_dosen',
        'fakultas_id',
        'prodi_id',
    ];

    protected $casts = [
        'status_dosen' => 'boolean',
    ];

    // =============================================
    // RELASI
    // =============================================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->hasOne(Reviewer::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    // =============================================
    // ACCESSOR
    // =============================================

    public function getStatusBadgeAttribute(): string
    {
        if ($this->status_dosen) {
            return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        Aktif
                    </span>';
        }
        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                    Nonaktif
                </span>';
    }

    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getInitialAttribute(): string
    {
        $words = explode(' ', $this->nama_dosen);
        $initial = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initial .= strtoupper($word[0]);
            }
        }
        return substr($initial, 0, 2);
    }
}
