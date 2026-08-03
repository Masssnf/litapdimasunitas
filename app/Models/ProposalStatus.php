<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalStatus extends Model
{
    use HasFactory;

    protected $table = 'proposal_status';

    protected $fillable = [
        'proposal_id',
        'status',
        'catatan',
        'updated_by',
        'tanggal_status',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class,'proposal_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
