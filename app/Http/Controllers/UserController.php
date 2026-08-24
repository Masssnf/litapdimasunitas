<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\JenisReviewer;
use App\Models\Prodi;
use App\Models\Reviewer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'role' => 'required|exists:roles,name',
                'status' => 'required|in:active,inactive',

                'nidn' => 'required_if:role,dosen|required_if:is_dosen,1|nullable|string|max:20|unique:dosen,nidn',
                'jenis_kelamin' => 'required_if:role,dosen|required_if:is_dosen,1|nullable|in:L,P',
                'fakultas_id' => 'required_if:role,dosen|required_if:is_dosen,1|nullable|exists:fakultas,id',
                'prodi_id' => 'required_if:role,dosen|required_if:is_dosen,1|nullable|exists:prodi,id',


                'nidn_reviewer' => 'required_if:role,reviewer|nullable|string|max:20',
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

            // 3. Buat Dosen
            $isDosenRequired = ($request->role === 'dosen') || ($request->role === 'reviewer' && $request->is_dosen == 1);

            if ($isDosenRequired) {
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
            }

            // 4. Buat Reviewer jika role = reviewer
            if ($request->role === 'reviewer') {
                $reviewerData = [
                    'user_id' => $user->id, // ✅ Ada user_id
                    'kode_reviewer' => $request->kode_reviewer,
                    'nama_reviewer' => $request->name,
                    'nidn_reviewer' => $request->nidn_reviewer ?? null,
                    'instansi_reviewer' => $request->instansi_reviewer ?? null,
                    'email_reviewer' => $request->email,
                    'notelp_reviewer' => $request->notelp_dosen ?? null,
                    'alamat_reviewer' => $request->alamat_dosen ?? null,
                    'status_reviewer' => $request->status === 'active' ? true : false,
                    'jenisreviewer_id' => $request->jenisreviewer_id ?? null,
                ];

                if (isset($dosen)) {
                    $reviewerData['dosen_id'] = $dosen->id;
                }

                Reviewer::create($reviewerData);
            }
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            // ✅ Tangkap error dan tampilkan
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
    public function edit($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'User tidak ditemukan!');
            }

            $roles = Role::all();
            $fakultas = Fakultas::where('status_fakultas', true)->get();
            $prodi = Prodi::where('status_prodi', true)->get();
            $jenisReviewer = JenisReviewer::where('status_jenisreviewer', true)->get();

            // ✅ Ambil dosen
            $dosen = $user->dosen;

            // ✅ Ambil reviewer (pastikan tidak null)
            $reviewer = null;
            if ($dosen) {
                $reviewer = $dosen->reviewer;
            }

            // ✅ Jika user adalah reviewer tapi tidak ada relasi melalui dosen
            // cari reviewer berdasarkan user_id
            if (!$reviewer && $user->hasRole('reviewer')) {
                $reviewer = Reviewer::where('user_id', $user->id)->first();
            }

            // ✅ DEBUG: Cek apakah reviewer ditemukan
            // dd($user->hasRole('reviewer'), $reviewer);

            return view('admin.users.edit', compact(
                'user',
                'roles',
                'fakultas',
                'prodi',
                'jenisReviewer',
                'dosen',
                'reviewer'
            ));
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::find($id);

            if (!$user) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'User tidak ditemukan!');
            }

            // ✅ Validasi dasar
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'role' => 'required|exists:roles,name',
                'status' => 'required|in:active,inactive',
                'password' => 'nullable|min:8|confirmed',
            ];

            // ✅ Validasi dosen (jika user memiliki dosen)
            $dosen = $user->dosen;
            if ($dosen) {
                $rules['nidn'] = 'required|string|max:20|unique:dosen,nidn,' . $dosen->id;
                $rules['jenis_kelamin'] = 'required|in:L,P';
                $rules['fakultas_id'] = 'required|exists:fakultas,id';
                $rules['prodi_id'] = 'required|exists:prodi,id';
            }

            // ✅ Validasi reviewer (jika user adalah reviewer)
            $reviewer = $dosen ? $dosen->reviewer : null;
            if (!$reviewer && $user->hasRole('reviewer')) {
                $reviewer = Reviewer::where('user_id', $user->id)->first();
            }

            if ($user->hasRole('reviewer') && $reviewer) {
                $rules['kode_reviewer'] = 'required|string|max:20|unique:reviewer,kode_reviewer,' . $reviewer->id;
                $rules['nidn_reviewer'] = 'nullable|string|max:20';
                $rules['instansi_reviewer'] = 'nullable|string|max:255';
                $rules['notelp_reviewer'] = 'nullable|string|max:20';
                $rules['alamat_reviewer'] = 'nullable|string';
                $rules['jenisreviewer_id'] = 'nullable|exists:jenisreviewer,id';
            }

            $request->validate($rules);

            // =============================================
            // UPDATE USER
            // =============================================
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

            // =============================================
            // UPDATE DOSEN
            // =============================================
            if ($dosen) {
                $dosen->update([
                    'nidn' => $request->nidn,
                    'nama_dosen' => $request->name,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'email_dosen' => $request->email,
                    'status_dosen' => $request->status === 'active' ? true : false,
                    'fakultas_id' => $request->fakultas_id,
                    'prodi_id' => $request->prodi_id,
                ]);
            }

            // =============================================
            // UPDATE REVIEWER
            // =============================================
            if ($user->hasRole('reviewer') && $reviewer) {
                $reviewer->update([
                    'kode_reviewer' => $request->kode_reviewer,
                    'nama_reviewer' => $request->name,
                    'nidn_reviewer' => $request->nidn_reviewer ?? null,
                    'instansi_reviewer' => $request->instansi_reviewer ?? null,
                    'email_reviewer' => $request->email,
                    'notelp_reviewer' => $request->notelp_reviewer ?? null,
                    'alamat_reviewer' => $request->alamat_reviewer ?? null,
                    'status_reviewer' => $request->status === 'active' ? true : false,
                    'jenisreviewer_id' => $request->jenisreviewer_id ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User, Dosen, dan Reviewer berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user)
    // {
    //     if ($user->id === auth()->id()) {
    //         return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
    //     }

    //     // Hapus dosen terkait jika ada
    //     if ($user->dosen) {
    //         $user->dosen->delete();
    //     }

    //     $user->delete();

    //     return redirect()->route('admin.users.index')
    //         ->with('success', 'User berhasil dihapus!');
    // }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        DB::beginTransaction();

        try {
            // ✅ Hapus dosen terkait jika ada
            if ($user->dosen) {
                // Hapus reviewer terkait jika ada
                if ($user->dosen->reviewer) {
                    $user->dosen->reviewer->delete();
                }
                $user->dosen->delete();
            }

            // ✅ Hapus reviewer langsung jika ada (tanpa dosen)
            $reviewer = Reviewer::where('user_id', $user->id)->first();
            if ($reviewer) {
                $reviewer->delete();
            }

            // ✅ Hapus user
            $user->delete();

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
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
