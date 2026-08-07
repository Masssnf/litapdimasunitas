<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\JenisReviewer;
use App\Models\Prodi;
use App\Models\Reviewer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('dosen');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        $total = User::count();
        $aktif = User::where('status', 'active')->count();
        $nonaktif = User::where('status', 'inactive')->count();

        return view('admin.users.index', compact('users', 'total', 'aktif', 'nonaktif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $fakultas = Fakultas::where('status_fakultas', true)->get();
        $prodi = Prodi::where('status_prodi', true)->get();
        $jenisReviewer = JenisReviewer::where('status_jenisreviewer', true)->get();

        return view('admin.users.create', compact('roles', 'fakultas', 'prodi', 'jenisReviewer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'status' => 'required|in:active,inactive',
            // Validasi dosen
            'nidn' => 'required_if:role,dosen|required_if:role,reviewer|nullable|string|max:20|unique:dosen,nidn',
            'jenis_kelamin' => 'required_if:role,dosen|required_if:role,reviewer|nullable|in:L,P',
            'fakultas_id' => 'required_if:role,dosen|required_if:role,reviewer|nullable|exists:fakultas,id',
            'prodi_id' => 'required_if:role,dosen|required_if:role,reviewer|nullable|exists:prodi,id',
            // Validasi reviewer (jika role reviewer)
            'kode_reviewer' => 'required_if:role,reviewer|nullable|string|max:20|unique:reviewer,kode_reviewer',
            'instansi_reviewer' => 'nullable|string|max:255',
            'jenisreviewer_id' => 'nullable|exists:jenisreviewer,id',
        ]);

        // 1. Buat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        // 2. Assign Role
        $user->assignRole($request->role);

        // 3. Jika role = dosen atau reviewer, buat dosen
        if (in_array($request->role, ['dosen', 'reviewer'])) {
            $dosen = Dosen::create([
                'user_id' => $user->id,
                'nidn' => $request->nidn,
                'nama_dosen' => $request->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email_dosen' => $request->email,
                'notelp_dosen' => $request->notelp_dosen ?? null,
                'alamat_dosen' => $request->alamat_dosen ?? null,
                'status_dosen' => $request->status === 'active' ? true : false,
                'fakultas_id' => $request->fakultas_id,
                'prodi_id' => $request->prodi_id,
            ]);

            // 4. Jika role = reviewer, buat reviewer
            if ($request->role === 'reviewer') {
                Reviewer::create([
                    'dosen_id' => $dosen->id,
                    'kode_reviewer' => $request->kode_reviewer,
                    'nama_reviewer' => $request->name,
                    'nidn_reviewer' => $request->nidn,
                    'instansi_reviewer' => $request->instansi_reviewer,
                    'email_reviewer' => $request->email,
                    'notelp_reviewer' => $request->notelp_dosen,
                    'alamat_reviewer' => $request->alamat_dosen,
                    'status_reviewer' => $request->status === 'active' ? true : false,
                    'jenisreviewer_id' => $request->jenisreviewer_id,
                ]);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('dosen');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $fakultas = Fakultas::where('status_fakultas', true)->get();
        $prodi = Prodi::where('status_prodi', true)->get();
        $jenisReviewer = JenisReviewer::where('status_jenisreviewer', true)->get();
        $dosen = $user->dosen;
        $reviewer = $dosen ? $dosen->reviewer : null;

        return view('admin.users.edit', compact('user', 'roles', 'fakultas', 'prodi', 'jenisReviewer', 'dosen', 'reviewer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|min:8|confirmed',
            // Validasi dosen
            'nidn' => 'required_if:role,dosen|required_if:role,reviewer|nullable|string|max:20|unique:dosen,nidn,' . ($user->dosen->id ?? 'NULL'),
            'jenis_kelamin' => 'required_if:role,dosen|required_if:role,reviewer|nullable|in:L,P',
            'fakultas_id' => 'required_if:role,dosen|required_if:role,reviewer|nullable|exists:fakultas,id',
            'prodi_id' => 'required_if:role,dosen|required_if:role,reviewer|nullable|exists:prodi,id',
            // Validasi reviewer (jika role reviewer)
            'kode_reviewer' => 'required_if:role,reviewer|nullable|string|max:20|unique:reviewer,kode_reviewer,' . ($user->dosen->reviewer->id ?? 'NULL'),
            'instansi_reviewer' => 'nullable|string|max:255',
            'jenisreviewer_id' => 'nullable|exists:jenisreviewer,id',
        ]);

        // 1. Update User
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        // 2. Update atau Buat Dosen
        if (in_array($request->role, ['dosen', 'reviewer'])) {
            $dosenData = [
                'nidn' => $request->nidn,
                'nama_dosen' => $request->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email_dosen' => $request->email,
                'notelp_dosen' => $request->notelp_dosen ?? null,
                'alamat_dosen' => $request->alamat_dosen ?? null,
                'status_dosen' => $request->status === 'active' ? true : false,
                'fakultas_id' => $request->fakultas_id,
                'prodi_id' => $request->prodi_id,
            ];

            if ($user->dosen) {
                $user->dosen->update($dosenData);
                $dosen = $user->dosen;
            } else {
                $dosen = Dosen::create(array_merge($dosenData, ['user_id' => $user->id]));
            }

            // 3. Update atau Buat Reviewer (jika role reviewer)
            if ($request->role === 'reviewer') {
                $reviewerData = [
                    'kode_reviewer' => $request->kode_reviewer,
                    'nama_reviewer' => $request->name,
                    'nidn_reviewer' => $request->nidn,
                    'instansi_reviewer' => $request->instansi_reviewer,
                    'email_reviewer' => $request->email,
                    'notelp_reviewer' => $request->notelp_dosen,
                    'alamat_reviewer' => $request->alamat_dosen,
                    'status_reviewer' => $request->status === 'active' ? true : false,
                    'jenisreviewer_id' => $request->jenisreviewer_id,
                ];

                if ($dosen->reviewer) {
                    $dosen->reviewer->update($reviewerData);
                } else {
                    Reviewer::create(array_merge($reviewerData, ['dosen_id' => $dosen->id]));
                }
            } else {
                // Jika role diubah dari reviewer ke yang lain, hapus reviewer
                if ($dosen->reviewer) {
                    $dosen->reviewer->delete();
                }
            }
        } else {
            // Jika role diubah ke selain dosen, hapus dosen dan reviewer
            if ($user->dosen) {
                if ($user->dosen->reviewer) {
                    $user->dosen->reviewer->delete();
                }
                $user->dosen->delete();
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        // Hapus dosen terkait jika ada
        if ($user->dosen) {
            $user->dosen->delete();
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Cegah menonaktifkan diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat mengubah status akun sendiri!');
        }

        // Toggle status
        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);

        $statusLabel = $newStatus === 'active' ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.users.index')
            ->with('success', "User {$user->name} berhasil {$statusLabel}!");
    }
}
