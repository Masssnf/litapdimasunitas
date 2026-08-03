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
        return $this->hasMany(
            ProposalDokumen::class,
            'proposal_id'
        );
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
}
