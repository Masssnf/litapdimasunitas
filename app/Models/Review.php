<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'proposal_reviewer_id',
        'nilai',
        'rekomendasi',
        'catatan',
        'tanggal_review'
    ];

    public function proposalReviewer()
    {
        return $this->belongsTo(ProposalReviewer::class, 'proposal_reviewer_id');
    }
}
