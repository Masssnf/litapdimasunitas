<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Hapus data lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // =============================================
        // 1. BUAT PERMISSIONS
        // =============================================
        $permissions = [
            // Dashboard
            'view_dashboard',

            // User Management
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'manage_roles',

            // Master Data
            'view_master_data',
            'create_master_data',
            'edit_master_data',
            'delete_master_data',

            // Proposal
            'view_proposal',
            'create_proposal',
            'edit_proposal',
            'delete_proposal',
            'submit_proposal',
            'verify_proposal',
            'assign_reviewer',
            'review_proposal',

            // Dokumen
            'upload_dokumen',
            'delete_dokumen',
            'download_dokumen',

            // Laporan
            'view_laporan',
            'create_laporan',
            'verify_laporan',

            // Kontrak
            'view_kontrak',
            'create_kontrak',
            'edit_kontrak',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // =============================================
        // 2. BUAT ROLES
        // =============================================

        // SUPER ADMIN (Akses Semua)
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // ADMIN LPPM
        $adminRole = Role::create(['name' => 'admin_lppm']);
        $adminRole->givePermissionTo([
            'view_dashboard',
            'view_master_data',
            'create_master_data',
            'edit_master_data',
            'view_proposal',
            'verify_proposal',
            'assign_reviewer',
            'download_dokumen',
            'view_laporan',
            'verify_laporan',
            'view_kontrak',
            'create_kontrak',
            'edit_kontrak',
        ]);

        // REVIEWER
        $reviewerRole = Role::create(['name' => 'reviewer']);
        $reviewerRole->givePermissionTo([
            'view_dashboard',
            'view_proposal',
            'review_proposal',
            'download_dokumen',
        ]);

        // DOSEN
        $dosenRole = Role::create(['name' => 'dosen']);
        $dosenRole->givePermissionTo([
            'view_dashboard',
            'view_proposal',
            'create_proposal',
            'edit_proposal',
            'delete_proposal',
            'submit_proposal',
            'upload_dokumen',
            'delete_dokumen',
            'download_dokumen',
            'view_laporan',
            'create_laporan',
        ]);

        // =============================================
        // 3. BUAT USER & DOSEN
        // =============================================

        // Ambil fakultas dan prodi pertama (atau buat jika belum ada)
        $fakultas = Fakultas::first();
        $prodi = Prodi::first();

        // Super Admin (tidak perlu dosen)
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@lppm.unita.ac.id',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user->assignRole('super_admin');

        // Admin LPPM (tidak perlu dosen)
        $user = User::create([
            'name' => 'Admin LPPM',
            'email' => 'admin@lppm.unita.ac.id',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user->assignRole('admin_lppm');

        // Reviewer 1 (dengan dosen)
        $user = User::create([
            'name' => 'Reviewer 1',
            'email' => 'reviewer@lppm.unita.ac.id',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user->assignRole('reviewer');

        if ($fakultas && $prodi) {
            Dosen::create([
                'user_id' => $user->id,
                'nidn' => '1234567890',
                'nama_dosen' => 'Reviewer 1',
                'jenis_kelamin' => 'L',
                'email_dosen' => 'reviewer@lppm.unita.ac.id',
                'status_dosen' => true,
                'fakultas_id' => $fakultas->id,
                'prodi_id' => $prodi->id,
            ]);
        }

        // Dosen 1
        $user = User::create([
            'name' => 'Dosen 1',
            'email' => 'dosen@lppm.unita.ac.id',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user->assignRole('dosen');

        if ($fakultas && $prodi) {
            Dosen::create([
                'user_id' => $user->id,
                'nidn' => '0987654321',
                'nama_dosen' => 'Dosen 1',
                'jenis_kelamin' => 'L',
                'email_dosen' => 'dosen@lppm.unita.ac.id',
                'status_dosen' => true,
                'fakultas_id' => $fakultas->id,
                'prodi_id' => $prodi->id,
            ]);
        }

        // Dosen 2 (inactive)
        $user = User::create([
            'name' => 'Dosen 2',
            'email' => 'dosen2@lppm.unita.ac.id',
            'password' => Hash::make('password'),
            'status' => 'inactive',
        ]);
        $user->assignRole('dosen');

        if ($fakultas && $prodi) {
            Dosen::create([
                'user_id' => $user->id,
                'nidn' => '1122334455',
                'nama_dosen' => 'Dosen 2',
                'jenis_kelamin' => 'P',
                'email_dosen' => 'dosen2@lppm.unita.ac.id',
                'status_dosen' => false,
                'fakultas_id' => $fakultas->id,
                'prodi_id' => $prodi->id,
            ]);
        }

        $this->command->info('✅ Role, Permission, User, dan Dosen berhasil dibuat!');
        $this->command->info('📋 Akun:');
        $this->command->info('   🔑 Super Admin: superadmin@lppm.unita.ac.id / password');
        $this->command->info('   🔑 Admin LPPM: admin@lppm.unita.ac.id / password');
        $this->command->info('   🔑 Reviewer: reviewer@lppm.unita.ac.id / password');
        $this->command->info('   🔑 Dosen: dosen@lppm.unita.ac.id / password');
    }
}
