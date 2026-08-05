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

    public function periodeSkema()
    {
        return $this->belongsTo(PeriodeSkema::class, 'periode_skema_id');
    }

    public function ketuaDosen()
    {
        return $this->belongsTo(Dosen::class, 'ketua_dosen_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

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

    public function reviewHistory()
    {
        return $this->hasManyThrough(
            Review::class,
            ProposalReviewer::class,
            'proposal_id',
            'proposal_reviewer_id',
            'id',
            'id'
        );
    }

    public function proposalReviewHistory()
    {
        return $this->hasManyThrough(
            ProposalReview::class,
            ProposalReviewer::class,
            'proposal_id',
            'proposal_reviewer_id',
            'id',
            'id'
        );
    }

    // =============================================
    // ACCESSOR STATUS
    // =============================================

    public function getStatusBadgeAttribute()
    {
        $config = [
            'Draft' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'dot' => 'bg-gray-500'],
            'Diajukan' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'],
            'Diverifikasi' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'dot' => 'bg-indigo-500'],
            'Direview' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500'],
            'Revisi' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'dot' => 'bg-orange-500'],
            'Lolos' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
            'Ditolak' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'dot' => 'bg-rose-500'],
        ];

        $c = $config[$this->status] ?? $config['Draft'];

        return '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-semibold ' . $c['bg'] . ' ' . $c['text'] . '">
                    <span class="w-1.5 h-1.5 rounded-full ' . $c['dot'] . ' mr-1.5"></span>
                    ' . $this->status . '
                </span>';
    }

    public function getStatusLabelAttribute()
    {
        return $this->status ?? 'Draft';
    }

    public function getDanaDiusulkanFormattedAttribute()
    {
        return 'Rp ' . number_format($this->dana_diusulkan ?? 0, 0, ',', '.');
    }

    public function getTanggalPengajuanFormattedAttribute()
    {
        return $this->tanggal_pengajuan ? $this->tanggal_pengajuan->format('d/m/Y') : '-';
    }

    public function getAnggotaCountAttribute()
    {
        return $this->anggota ? $this->anggota->count() : 0;
    }

    public function getMahasiswaCountAttribute()
    {
        return $this->mahasiswa ? $this->mahasiswa->count() : 0;
    }

    public function getDokumenCountAttribute()
    {
        return $this->dokumen ? $this->dokumen->count() : 0;
    }

    public function getReviewerCountAttribute()
    {
        return $this->reviewer ? $this->reviewer->count() : 0;
    }

    public function getReviewHistoryCountAttribute()
    {
        return $this->reviewHistory ? $this->reviewHistory->count() : 0;
    }

    public function getProposalReviewHistoryCountAttribute()
    {
        return $this->proposalReviewHistory ? $this->proposalReviewHistory->count() : 0;
    }
}
