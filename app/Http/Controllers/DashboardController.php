<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Data untuk semua role
        $data = [
            'total_proposal' => Proposal::count(),
            'total_user' => User::count(),
        ];

        // Data berdasarkan role
        if ($user->hasRole('dosen')) {
            $data['my_proposal'] = Proposal::where('ketua_dosen_id', $user->dosen->id ?? 0)->count();
            $data['draft_proposal'] = Proposal::where('ketua_dosen_id', $user->dosen->id ?? 0)
                ->where('status', 'Draft')->count();
        }

        if ($user->hasRole('admin_lppm') || $user->hasRole('super_admin')) {
            $data['draft'] = Proposal::where('status', 'Draft')->count();
            $data['diajukan'] = Proposal::where('status', 'Diajukan')->count();
            $data['direview'] = Proposal::where('status', 'Direview')->count();
            $data['lolos'] = Proposal::where('status', 'Lolos')->count();
            $data['ditolak'] = Proposal::where('status', 'Ditolak')->count();
            $data['revisi'] = Proposal::where('status', 'Revisi')->count();
        }

        return view('dashboard', $data);
    }
}
