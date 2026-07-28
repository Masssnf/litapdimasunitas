<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PeriodeSkema extends Pivot
{
    use HasFactory;

    protected $table = 'periode_skema';

    protected $fillable = [
        'periode_id',
        'skema_id',
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
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }
}
