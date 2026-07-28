<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'keterangan',
    ];

    protected $casts = [
        'status' => 'boolean',
        'tanggal_mulai_pengajuan' => 'date',
        'tanggal_selesai_pengajuan' => 'date',
        'tanggal_mulai_review' => 'date',
        'tanggal_selesai_review' => 'date',
        'tanggal_pengumuman' => 'date',
        'dana_minimal' => 'decimal:2',
        'dana_maksimal' => 'decimal:2',
    ];

    // =============================================
    // RELASI
    // =============================================

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    // =============================================
    // ACCESSOR STATUS
    // =============================================

    /**
     * Get status label (Aktif/Nonaktif)
     */
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->status) {
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
        return $this->status ? 'text-emerald-600' : 'text-rose-600';
    }

    /**
     * Get status dot color
     */
    public function getStatusDotAttribute()
    {
        return $this->status ? 'bg-emerald-500' : 'bg-rose-500';
    }

    // =============================================
    // ACCESSOR DANA
    // =============================================

    /**
     * Get dana minimal dengan format Rupiah
     */
    public function getDanaMinimalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->dana_minimal ?? 0, 0, ',', '.');
    }

    /**
     * Get dana maksimal dengan format Rupiah
     */
    public function getDanaMaksimalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->dana_maksimal ?? 0, 0, ',', '.');
    }

    /**
     * Get range dana (minimal - maksimal)
     */
    public function getRangeDanaAttribute()
    {
        $min = $this->dana_minimal_formatted;
        $max = $this->dana_maksimal_formatted;
        return $min . ' - ' . $max;
    }

    /**
     * Get dana minimal (numeric) - untuk input/form
     */
    public function getDanaMinimalRawAttribute()
    {
        return $this->dana_minimal ?? 0;
    }

    /**
     * Get dana maksimal (numeric) - untuk input/form
     */
    public function getDanaMaksimalRawAttribute()
    {
        return $this->dana_maksimal ?? 0;
    }

    // =============================================
    // ACCESSOR TANGGAL
    // =============================================

    /**
     * Get tanggal mulai pengajuan dengan format Indonesia
     */
    public function getTanggalMulaiPengajuanFormattedAttribute()
    {
        return $this->tanggal_mulai_pengajuan
            ? $this->tanggal_mulai_pengajuan->format('d/m/Y')
            : '-';
    }

    /**
     * Get tanggal selesai pengajuan dengan format Indonesia
     */
    public function getTanggalSelesaiPengajuanFormattedAttribute()
    {
        return $this->tanggal_selesai_pengajuan
            ? $this->tanggal_selesai_pengajuan->format('d/m/Y')
            : '-';
    }

    /**
     * Get range tanggal pengajuan
     */
    public function getRangeTanggalPengajuanAttribute()
    {
        $start = $this->tanggal_mulai_pengajuan_formatted;
        $end = $this->tanggal_selesai_pengajuan_formatted;
        return $start . ' s.d ' . $end;
    }

    /**
     * Get tanggal mulai review dengan format Indonesia
     */
    public function getTanggalMulaiReviewFormattedAttribute()
    {
        return $this->tanggal_mulai_review
            ? $this->tanggal_mulai_review->format('d/m/Y')
            : '-';
    }

    /**
     * Get tanggal selesai review dengan format Indonesia
     */
    public function getTanggalSelesaiReviewFormattedAttribute()
    {
        return $this->tanggal_selesai_review
            ? $this->tanggal_selesai_review->format('d/m/Y')
            : '-';
    }

    /**
     * Get range tanggal review
     */
    public function getRangeTanggalReviewAttribute()
    {
        $start = $this->tanggal_mulai_review_formatted;
        $end = $this->tanggal_selesai_review_formatted;
        return $start . ' s.d ' . $end;
    }

    /**
     * Get tanggal pengumuman dengan format Indonesia
     */
    public function getTanggalPengumumanFormattedAttribute()
    {
        return $this->tanggal_pengumuman
            ? $this->tanggal_pengumuman->format('d/m/Y')
            : '-';
    }

    // =============================================
    // ACCESSOR LAINNYA
    // =============================================

    /**
     * Get kuota proposal dengan label
     */
    public function getKuotaProposalLabelAttribute()
    {
        return $this->kuota_proposal . ' Proposal';
    }

    /**
     * Get maksimal anggota dengan label
     */
    public function getMaksimalAnggotaLabelAttribute()
    {
        return $this->maksimal_anggota . ' Orang';
    }

    /**
     * Get informasi lengkap periode skema
     */
    public function getInfoAttribute()
    {
        $periode = $this->periode->nama_periode ?? '-';
        $skema = $this->skema->nama_skema ?? '-';
        return $periode . ' - ' . $skema;
    }

    /**
     * Get kode gabungan periode dan skema
     */
    public function getKodeGabunganAttribute()
    {
        $periodeKode = $this->periode->kode_periode ?? '';
        $skemaKode = $this->skema->kode_skema ?? '';
        return $periodeKode . '-' . $skemaKode;
    }
}
