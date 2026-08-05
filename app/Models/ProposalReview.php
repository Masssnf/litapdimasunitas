<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalReview extends Model
{
    use HasFactory;

    protected $table = 'proposal_review';

    protected $fillable = [
        'proposal_reviewer_id',
        'nilai',
        'rekomendasi',
        'catatan',
        'tanggal_review',
    ];

    protected $casts = [
        'tanggal_review' => 'date',
        'nilai' => 'integer',
    ];

    // =============================================
    // RELASI
    // =============================================

    public function proposalReviewer()
    {
        return $this->belongsTo(ProposalReviewer::class, 'proposal_reviewer_id');
    }

    public function proposal()
    {
        return $this->hasOneThrough(
            Proposal::class,
            ProposalReviewer::class,
            'id',
            'id',
            'proposal_reviewer_id',
            'proposal_id'
        );
    }

    public function reviewer()
    {
        return $this->hasOneThrough(
            Reviewer::class,
            ProposalReviewer::class,
            'id',
            'id',
            'proposal_reviewer_id',
            'reviewer_id'
        );
    }

    // =============================================
    // ACCESSOR (Rekomendasi: diterima, ditolak, revisi)
    // =============================================

    public function getRekomendasiBadgeAttribute()
    {
        $colors = [
            'diterima' => 'bg-emerald-100 text-emerald-700',
            'ditolak' => 'bg-rose-100 text-rose-700',
            'revisi' => 'bg-orange-100 text-orange-700',
        ];

        $color = $colors[$this->rekomendasi] ?? 'bg-gray-100 text-gray-700';
        $label = ucfirst($this->rekomendasi ?? 'Unknown');

        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ' . $color . '">
                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 ' . str_replace('text-', 'bg-', $color) . '"></span>
                    ' . $label . '
                </span>';
    }

    public function getNilaiLabelAttribute()
    {
        if (is_null($this->nilai)) {
            return '<span class="text-gray-400">-</span>';
        }

        $color = $this->nilai >= 70 ? 'text-emerald-600' : 'text-rose-600';
        return '<span class="font-semibold ' . $color . '">' . $this->nilai . '</span>';
    }

    public function getTanggalReviewFormattedAttribute()
    {
        return $this->tanggal_review ? $this->tanggal_review->format('d/m/Y') : '-';
    }
}
