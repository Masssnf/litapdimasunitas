<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalDokumen extends Model
{
    use HasFactory;

    protected $table = 'proposal_dokumen';

    protected $fillable = [

        'proposal_id',

        'jenis_dokumen',

        'versi',

        'is_latest',

        'nama_file',

        'nama_file_asli',

        'file_path',

        'mime_type',

        'ekstensi',

        'ukuran_file',

        'status_verifikasi',

        'catatan',

        'uploaded_by',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function proposal()
    {
        return $this->belongsTo(
            Proposal::class,
            'proposal_id'
        );
    }

    public function uploader()
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by'
        );
    }
}
