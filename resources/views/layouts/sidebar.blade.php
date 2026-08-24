<aside
    class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-white min-h-screen flex-shrink-0 shadow-2xl flex flex-col">
    <!-- ============================================= -->
    <!-- HEADER / LOGO                                -->
    <!-- ============================================= -->
    <div class="p-5 border-b border-white/5 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <div
                class="w-11 h-11 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-lg font-bold text-white shadow-lg shadow-indigo-500/25">
                L
            </div>
            <div>
                <h1 class="text-lg font-bold text-white tracking-tight">LITAPDIMAS UNITAS</h1>
                <p class="text-[10px] text-gray-400 tracking-wider">Universitas Islam Tasikmalaya</p>
            </div>
        </div>
    </div>

    <!-- ============================================= -->
    <!-- NAVIGATION - SCROLLABLE AREA                 -->
    <!-- ============================================= -->
    <nav class="flex-1 overflow-y-auto px-3 py-4 scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-transparent">

        @php
            $user = Auth::user();

            // Helper function untuk mengecek apakah route saat ini adalah bagian dari grup tertentu
            function isRouteInGroup($routes)
            {
                if (!is_array($routes)) {
                    $routes = [$routes];
                }
                foreach ($routes as $route) {
                    if (request()->routeIs($route)) {
                        return true;
                    }
                }
                return false;
            }
        @endphp

        <!-- ============================================= -->
        <!-- DASHBOARD                                    -->
        <!-- ============================================= -->
        @can('view_dashboard')
            <div class="mb-3">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
            </div>
        @endcan

        <!-- ============================================= -->
        <!-- MASTER DATA (Admin & Super Admin)            -->
        <!-- ============================================= -->
        @canany(['view_master_data', 'create_master_data', 'edit_master_data'])
            @php
                $isMasterDataActive = isRouteInGroup([
                    'admin.fakultas.*',
                    'admin.prodi.*',
                    'admin.dosen.*',
                    'admin.jenisreviewer.*',
                    'admin.reviewer.*',
                    'admin.jenisskema.*',
                    'admin.skema.*',
                    'admin.periode.*',
                    'admin.periodeskema.*',
                    'admin.bidangpenelitian.*',
                ]);
            @endphp
            <div class="mb-3">
                <div class="relative">
                    <input type="checkbox" id="masterDropdown" class="peer hidden"
                        {{ $isMasterDataActive ? 'checked' : '' }}>

                    <label for="masterDropdown"
                        class="flex items-center justify-between cursor-pointer py-2.5 px-4 rounded-xl transition-all duration-200 {{ $isMasterDataActive ? 'bg-white/5 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-database w-5 text-center"></i>
                            <span class="text-sm font-medium">Master Data</span>
                        </div>
                        <i
                            class="fas fa-chevron-down text-xs transition-transform duration-200 {{ $isMasterDataActive ? 'rotate-180' : '' }}"></i>
                    </label>

                    <div class="overflow-hidden max-h-0 peer-checked:max-h-96 transition-all duration-300 ease-in-out">
                        <div class="ml-4 mt-1 space-y-0.5 border-l-2 border-indigo-500/30 pl-3">

                            <!-- Fakultas -->
                            @can('view_master_data')
                                <a href="{{ route('admin.fakultas.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.fakultas.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-university w-4 text-center"></i>
                                    <span class="text-sm">Fakultas</span>
                                </a>
                            @endcan

                            <!-- Program Studi -->
                            @can('view_master_data')
                                <a href="{{ route('admin.prodi.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.prodi.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-book-open w-4 text-center"></i>
                                    <span class="text-sm">Program Studi</span>
                                </a>
                            @endcan

                            <!-- Dosen -->
                            @can('view_master_data')
                                <a href="{{ route('admin.dosen.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dosen.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-chalkboard-teacher w-4 text-center"></i>
                                    <span class="text-sm">Dosen</span>
                                </a>
                            @endcan

                            <!-- Divider -->
                            <div class="h-px bg-white/5 my-1 mx-2"></div>

                            <!-- Jenis Reviewer -->
                            @can('view_master_data')
                                <a href="{{ route('admin.jenisreviewer.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jenisreviewer.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-tags w-4 text-center"></i>
                                    <span class="text-sm">Jenis Reviewer</span>
                                </a>
                            @endcan

                            <!-- Reviewer -->
                            @can('view_master_data')
                                <a href="{{ route('admin.reviewer.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reviewer.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-user-check w-4 text-center"></i>
                                    <span class="text-sm">Reviewer</span>
                                </a>
                            @endcan

                            <!-- Divider -->
                            <div class="h-px bg-white/5 my-1 mx-2"></div>

                            <!-- Jenis Skema -->
                            @can('view_master_data')
                                <a href="{{ route('admin.jenisskema.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jenisskema.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-layer-group w-4 text-center"></i>
                                    <span class="text-sm">Jenis Skema</span>
                                </a>
                            @endcan

                            <!-- Skema -->
                            @can('view_master_data')
                                <a href="{{ route('admin.skema.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.skema.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-clipboard-list w-4 text-center"></i>
                                    <span class="text-sm">Skema</span>
                                </a>
                            @endcan

                            <!-- Periode -->
                            @can('view_master_data')
                                <a href="{{ route('admin.periode.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.periode.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-calendar-alt w-4 text-center"></i>
                                    <span class="text-sm">Periode</span>
                                </a>
                            @endcan

                            <!-- Periode Skema -->
                            @can('view_master_data')
                                <a href="{{ route('admin.periodeskema.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.periodeskema.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-calendar-check w-4 text-center"></i>
                                    <span class="text-sm">Periode Skema</span>
                                </a>
                            @endcan

                            <!-- Bidang Penelitian -->
                            @can('view_master_data')
                                <a href="{{ route('admin.bidangpenelitian.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.bidangpenelitian.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-flask w-4 text-center"></i>
                                    <span class="text-sm">Bidang Penelitian</span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endcanany

        <!-- ============================================= -->
        <!-- MANAJEMEN USER (Super Admin Only)            -->
        <!-- ============================================= -->
        @canany(['view_users', 'create_users', 'edit_users', 'delete_users'])
            @php
                $isUserActive = isRouteInGroup('admin.users.*');
            @endphp
            <div class="mb-3">
                <div class="relative">
                    <input type="checkbox" id="userDropdown" class="peer hidden" {{ $isUserActive ? 'checked' : '' }}>

                    <label for="userDropdown"
                        class="flex items-center justify-between cursor-pointer py-2.5 px-4 rounded-xl transition-all duration-200 {{ $isUserActive ? 'bg-white/5 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-users-cog w-5 text-center"></i>
                            <span class="text-sm font-medium">Manajemen User</span>
                        </div>
                        <i
                            class="fas fa-chevron-down text-xs transition-transform duration-200 {{ $isUserActive ? 'rotate-180' : '' }}"></i>
                    </label>

                    <div class="overflow-hidden max-h-0 peer-checked:max-h-96 transition-all duration-300 ease-in-out">
                        <div class="ml-4 mt-1 space-y-0.5 border-l-2 border-indigo-500/30 pl-3">
                            @can('view_users')
                                <a href="{{ route('admin.users.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.index') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-users w-4 text-center"></i>
                                    <span class="text-sm">Daftar User</span>
                                </a>
                            @endcan

                            @can('create_users')
                                <a href="{{ route('admin.users.create') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.create') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-user-plus w-4 text-center"></i>
                                    <span class="text-sm">Tambah User</span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endcanany

        <!-- ============================================= -->
        <!-- PROPOSAL (Dosen, Admin, Super Admin)         -->
        <!-- ============================================= -->
        @canany(['view_proposal', 'create_proposal'])
            @php
                $isProposalActive = isRouteInGroup([
                    'admin.proposal.*',
                    'admin.proposal.review.*',
                    'admin.proposal.anggota.*',
                    'admin.proposal.mahasiswa.*',
                    'admin.proposal.dokumen.*',
                ]);
            @endphp
            <div class="mb-3">
                <div class="relative">
                    <input type="checkbox" id="proposalDropdown" class="peer hidden"
                        {{ $isProposalActive ? 'checked' : '' }}>

                    <label for="proposalDropdown"
                        class="flex items-center justify-between cursor-pointer py-2.5 px-4 rounded-xl transition-all duration-200 {{ $isProposalActive ? 'bg-white/5 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-alt w-5 text-center"></i>
                            <span class="text-sm font-medium">Proposal</span>
                        </div>
                        <i
                            class="fas fa-chevron-down text-xs transition-transform duration-200 {{ $isProposalActive ? 'rotate-180' : '' }}"></i>
                    </label>

                    <div class="overflow-hidden max-h-0 peer-checked:max-h-96 transition-all duration-300 ease-in-out">
                        <div class="ml-4 mt-1 space-y-0.5 border-l-2 border-indigo-500/30 pl-3">

                            <!-- 1. Daftar Proposal (Semua Role) -->
                            @can('view_proposal')
                                <a href="{{ route('admin.proposal.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.proposal.index') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-list w-4 text-center"></i>
                                    <span class="text-sm">Daftar Proposal</span>
                                </a>
                            @endcan

                            <!-- 2. Buat Proposal (Dosen & Admin) -->
                            @can('create_proposal')
                                <a href="{{ route('admin.proposal.create') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.proposal.create') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-plus-circle w-4 text-center"></i>
                                    <span class="text-sm">Buat Proposal</span>
                                </a>
                            @endcan

                            <!-- 3. Verifikasi Proposal (Admin & Super Admin) -->
                            @can('verify_proposal')
                                <a href="{{ route('admin.proposal.index') }}?status=Diajukan"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-white">
                                    <i class="fas fa-check-double w-4 text-center"></i>
                                    <span class="text-sm">Verifikasi Proposal</span>
                                    @php
                                        $pendingCount = \App\Models\Proposal::where('status', 'Diajukan')->count();
                                    @endphp
                                    @if ($pendingCount > 0)
                                        <span
                                            class="ml-auto text-[10px] bg-rose-500 text-white px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                                    @endif
                                </a>
                            @endcan

                            <!-- 4. Tugaskan Reviewer (Admin & Super Admin) -->
                            @can('assign_reviewer')
                                <a href="{{ route('admin.proposal.index') }}?status=Direview"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-white">
                                    <i class="fas fa-user-plus w-4 text-center"></i>
                                    <span class="text-sm">Tugaskan Reviewer</span>
                                    @php
                                        $reviewCount = \App\Models\Proposal::where('status', 'Direview')->count();
                                    @endphp
                                    @if ($reviewCount > 0)
                                        <span
                                            class="ml-auto text-[10px] bg-amber-500 text-white px-1.5 py-0.5 rounded-full">{{ $reviewCount }}</span>
                                    @endif
                                </a>
                            @endcan

                            <!-- 5. Review Proposal (Reviewer & Admin) -->
                            @can('review_proposal')
                                <a href="{{ route('admin.proposal.index') }}"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.proposal.review.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                    <i class="fas fa-clipboard-check w-4 text-center"></i>
                                    <span class="text-sm">Review Proposal</span>
                                </a>
                            @endcan

                            <!-- 6. Riwayat Proposal (Admin & Super Admin) -->
                            @can('view_proposal')
                                @role('super_admin|admin_lppm')
                                    <a href="{{ route('admin.proposal.index') }}?status=Lolos"
                                        class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-white">
                                        <i class="fas fa-history w-4 text-center"></i>
                                        <span class="text-sm">Riwayat Proposal</span>
                                    </a>
                                @endrole
                            @endcan

                            <!-- 7. Laporan Proposal (Dosen & Admin) -->
                            @canany(['view_laporan', 'create_laporan'])
                                <a href="#"
                                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-white">
                                    <i class="fas fa-file-pdf w-4 text-center"></i>
                                    <span class="text-sm">Laporan Proposal</span>
                                </a>
                            @endcanany

                        </div>
                    </div>
                </div>
            </div>
        @endcanany

        <!-- ============================================= -->
        <!-- PENGATURAN (Super Admin Only)                -->
        <!-- ============================================= -->
        @role('super_admin')
            @php
                $isSettingsActive = false; // Belum ada route untuk settings
            @endphp
            <div class="mb-3">
                <div class="relative">
                    <input type="checkbox" id="settingsDropdown" class="peer hidden"
                        {{ $isSettingsActive ? 'checked' : '' }}>

                    <label for="settingsDropdown"
                        class="flex items-center justify-between cursor-pointer py-2.5 px-4 rounded-xl transition-all duration-200 text-gray-300 hover:bg-white/5 hover:text-white">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-cog w-5 text-center"></i>
                            <span class="text-sm font-medium">Pengaturan</span>
                        </div>
                        <i
                            class="fas fa-chevron-down text-xs transition-transform duration-200 {{ $isSettingsActive ? 'rotate-180' : '' }}"></i>
                    </label>

                    <div class="overflow-hidden max-h-0 peer-checked:max-h-96 transition-all duration-300 ease-in-out">
                        <div class="ml-4 mt-1 space-y-0.5 border-l-2 border-indigo-500/30 pl-3">
                            <a href="#"
                                class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-white">
                                <i class="fas fa-database w-4 text-center"></i>
                                <span class="text-sm">Konfigurasi Sistem</span>
                            </a>
                            <a href="#"
                                class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-white">
                                <i class="fas fa-robot w-4 text-center"></i>
                                <span class="text-sm">Log Aktivitas</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

    </nav>

    <!-- ============================================= -->
    <!-- FOOTER - USER PROFILE & LOGOUT               -->
    <!-- ============================================= -->
    <div class="border-t border-white/5 p-4 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <div
                class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-sm font-bold text-white shadow-lg shadow-indigo-500/25 flex-shrink-0">
                {{ Auth::user()->initial ?? 'U' }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                <p class="text-[10px] text-gray-400 truncate">
                    @php
                        $roleLabels = [
                            'super_admin' => 'Super Admin',
                            'admin_lppm' => 'Admin LPPM',
                            'reviewer' => 'Reviewer',
                            'dosen' => 'Dosen',
                        ];
                        $role = Auth::user()->getRoleNames()->first() ?? '';
                    @endphp
                    {{ $roleLabels[$role] ?? 'User' }}
                </p>
            </div>
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="p-2 rounded-lg text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200"
                    title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
