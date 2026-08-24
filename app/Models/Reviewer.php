<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;

    protected $table = 'reviewer';

    protected $fillable = [
        'kode_reviewer',
        'nama_reviewer',
        'nidn_reviewer',
        'instansi_reviewer',
        'email_reviewer',
        'notelp_reviewer',
        'alamat_reviewer',
        'status_reviewer',
        'jenisreviewer_id',
        'dosen_id',
        'user_id',
    ];

    protected static function booted()
    {
        static::deleting(function ($reviewer) {
            // Hapus dosen terkait jika ada
            if ($reviewer->dosen_id) {
                $dosen = Dosen::find($reviewer->dosen_id);
                if ($dosen) {
                    $dosen->delete();
                }
            }

            // Hapus user terkait jika ada
            if ($reviewer->user_id) {
                $user = User::find($reviewer->user_id);
                if ($user && $user->hasRole('reviewer')) {
                    $user->delete();
                }
            }
        });
    }

    // =============================================
    // RELASI
    // =============================================

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenisreviewer()
    {
        return $this->belongsTo(JenisReviewer::class, 'jenisreviewer_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id'); // ✅ Ditambahkan foreign key
    }

    public function proposal()
    {
        return $this->hasMany(ProposalReviewer::class, 'reviewer_id'); // ✅ Ditambahkan foreign key
    }

    // =============================================
    // ACCESSOR (Sudah Benar)
    // =============================================

    public function getStatusLabelAttribute()
    {
        return $this->status_reviewer ? 'Aktif' : 'Nonaktif';
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->status_reviewer) {
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

    public function getStatusColorAttribute()
    {
        return $this->status_reviewer ? 'text-emerald-600' : 'text-rose-600';
    }

    public function getStatusDotAttribute()
    {
        return $this->status_reviewer ? 'bg-emerald-500' : 'bg-rose-500';
    }
}
