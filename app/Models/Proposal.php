<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposal';

    protected $fillable = [
        'kode_proposal',
        'judul',
        'ringkasan',
        'kata_kunci',
        'dana_diusulkan',
        'status',
        'tanggal_pengajuan',
        'periode_skema_id',
        'ketua_dosen_id',
        'bidangpenelitian_id',
        'fakultas_id',
        'prodi_id',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'dana_diusulkan' => 'decimal:2',
    ];

    // =============================================
    // RELASI
    // =============================================

    // Relasi Periode Skema
    public function periodeSkema()
    {
        return $this->belongsTo(PeriodeSkema::class, 'periode_skema_id');
    }

    // Relasi Dosen
    public function ketuaDosen()
    {
        return $this->belongsTo(Dosen::class, 'ketua_dosen_id');
    }

    // Relasi Fakultas
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    // Relasi Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    // Relasi Bidang Penelitian
    public function bidangPenelitian()
    {
        return $this->belongsTo(BidangPenelitian::class, 'bidangpenelitian_id');
    }



    public function dokumen()
    {
        return $this->hasMany(ProposalDokumen::class, 'proposal_id');
    }

    public function anggota()
    {
        return $this->hasMany(ProposalAnggota::class, 'proposal_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(ProposalMahasiswa::class, 'proposal_id');
    }

    public function reviewer()
    {
        return $this->hasMany(ProposalReviewer::class, 'proposal_id');
    }

    public function status()
    {
        return $this->hasMany(ProposalStatus::class, 'proposal_id');
    }

    // =============================================
    // ACCESSOR
    // =============================================

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'draft' => 'bg-gray-100 text-gray-700',
            'diajukan' => 'bg-blue-100 text-blue-700',
            'direview' => 'bg-yellow-100 text-yellow-700',
            'diterima' => 'bg-emerald-100 text-emerald-700',
            'ditolak' => 'bg-rose-100 text-rose-700',
            'revisi' => 'bg-orange-100 text-orange-700',
        ];

        $colors = $statuses[$this->status] ?? 'bg-gray-100 text-gray-700';

        $labels = [
            'draft' => 'Draft',
            'diajukan' => 'Diajukan',
            'direview' => 'Di Review',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            'revisi' => 'Revisi',
        ];

        $label = $labels[$this->status] ?? $this->status;

        $dots = [
            'draft' => 'bg-gray-500',
            'diajukan' => 'bg-blue-500',
            'direview' => 'bg-yellow-500',
            'diterima' => 'bg-emerald-500',
            'ditolak' => 'bg-rose-500',
            'revisi' => 'bg-orange-500',
        ];

        $dot = $dots[$this->status] ?? 'bg-gray-500';

        return '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-semibold ' . $colors . '">
                    <span class="w-1.5 h-1.5 rounded-full ' . $dot . ' mr-1.5"></span>
                    ' . ucfirst($label) . '
                </span>';
    }

    /**
     * Get dana diusulkan formatted
     */
    public function getDanaDiusulkanFormattedAttribute()
    {
        return 'Rp ' . number_format($this->dana_diusulkan ?? 0, 0, ',', '.');
    }

    /**
     * Get kode proposal with prefix
     */
    public function getKodeProposalFormattedAttribute()
    {
        return $this->kode_proposal ?? '-';
    }
}
