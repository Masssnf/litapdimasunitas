<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalAnggota extends Model
{
    use HasFactory;

    protected $table = 'proposal_anggota';

    protected $fillable = [
        'proposal_id',
        'dosen_id',
        'peran',
        'urutan',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
