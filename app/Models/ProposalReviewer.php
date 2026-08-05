<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalReviewer extends Model
{
    use HasFactory;

    protected $table = 'proposal_reviewer';

    protected $fillable = [
        'proposal_id',
        'reviewer_id',
        'urutan',
        'status_penugasan',
        'tanggal_penugasan',
        'catatan',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'reviewer_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'proposal_reviewer_id');
    }

    public function getStatusBadgeAttribute()
    {
        $colors = [
            'Ditugaskan' => 'bg-blue-100 text-blue-700',
            'Diterima' => 'bg-emerald-100 text-emerald-700',
            'Ditolak' => 'bg-rose-100 text-rose-700',
            'Selesai' => 'bg-gray-100 text-gray-700',
        ];

        $color = $colors[$this->status_penugasan] ?? 'bg-gray-100 text-gray-700';
        $label = $this->status_penugasan ?? 'Unknown';

        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ' . $color . '">
                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 ' . str_replace('text-', 'bg-', $color) . '"></span>
                    ' . $label . '
                </span>';
    }
}
