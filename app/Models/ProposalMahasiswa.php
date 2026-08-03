<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'proposal_mahasiswa';

    protected $fillable = [
        'proposal_id',
        'prodi_id',
        'nim',
        'nama_mahasiswa',
        'angkatan_mahasiswa',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
