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

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
