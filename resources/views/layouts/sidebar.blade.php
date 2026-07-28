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

        <!-- ============================================= -->
        <!-- DASHBOARD                                    -->
        <!-- ============================================= -->
        <div class="mb-3">
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-3 py-2.5 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-home w-5 text-center"></i>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
        </div>

        <!-- ============================================= -->
        <!-- MASTER DATA (DROPDOWN)                       -->
        <!-- ============================================= -->
        @php
            $isMasterActive =
                request()->routeIs('admin.fakultas.*') ||
                request()->routeIs('admin.prodi.*') ||
                request()->routeIs('admin.dosen.*') ||
                request()->routeIs('admin.reviewer.*') ||
                request()->routeIs('admin.jenisreviewer.*') ||
                request()->routeIs('admin.jenisskema.*') ||
                request()->routeIs('admin.skema.*') ||
                request()->routeIs('admin.periode.*') ||
                request()->routeIs('admin.periodeskema.*');
        @endphp

        <div class="mb-2">
            <!-- Master Data Header / Toggle -->
            <div class="flex items-center justify-between cursor-pointer py-2.5 px-4 rounded-xl transition-all duration-200 {{ $isMasterActive ? 'bg-white/5 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
                onclick="toggleMasterDropdown()">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-database w-5 text-center"></i>
                    <span class="text-sm font-medium">Master Data</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200 {{ $isMasterActive ? 'rotate-180' : '' }}"
                    id="masterArrow"></i>
            </div>

            <!-- Dropdown Menu -->
            <div class="mt-1 space-y-0.5 border-l-2 border-indigo-500/30 pl-3 overflow-hidden transition-all duration-300 ease-in-out"
                id="masterDropdown"
                style="max-height: {{ $isMasterActive ? '500px' : '0' }}; opacity: {{ $isMasterActive ? '1' : '0' }}; padding-top: {{ $isMasterActive ? '4px' : '0' }}; pointer-events: {{ $isMasterActive ? 'auto' : 'none' }};">

                <!-- ============================================= -->
                <!-- DATA AKADEMIK                               -->
                <!-- ============================================= -->
                <!-- Fakultas -->
                <a href="{{ route('admin.fakultas.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.fakultas.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-university w-4 text-center"></i>
                    <span class="text-sm">Fakultas</span>
                </a>

                <!-- Program Studi -->
                <a href="{{ route('admin.prodi.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.prodi.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-book-open w-4 text-center"></i>
                    <span class="text-sm">Program Studi</span>
                </a>

                <!-- Dosen -->
                <a href="{{ route('admin.dosen.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dosen.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-chalkboard-teacher w-4 text-center"></i>
                    <span class="text-sm">Dosen</span>
                </a>

                <!-- Divider -->
                <div class="h-px bg-white/5 my-1 mx-2"></div>

                <!-- ============================================= -->
                <!-- DATA REVIEWER                               -->
                <!-- ============================================= -->
                <!-- Jenis Reviewer -->
                <a href="{{ route('admin.jenisreviewer.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jenisreviewer.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-tags w-4 text-center"></i>
                    <span class="text-sm">Jenis Reviewer</span>
                </a>

                <!-- Reviewer -->
                <a href="{{ route('admin.reviewer.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reviewer.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-user-check w-4 text-center"></i>
                    <span class="text-sm">Reviewer</span>
                </a>

                <!-- Divider -->
                <div class="h-px bg-white/5 my-1 mx-2"></div>

                <!-- ============================================= -->
                <!-- DATA SKEMA & PERIODE                        -->
                <!-- ============================================= -->
                <!-- Jenis Skema -->
                <a href="{{ route('admin.jenisskema.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jenisskema.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-layer-group w-4 text-center"></i>
                    <span class="text-sm">Jenis Skema</span>
                </a>

                <!-- Skema -->
                <a href="{{ route('admin.skema.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.skema.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-clipboard-list w-4 text-center"></i>
                    <span class="text-sm">Skema</span>
                </a>

                <!-- ✅ Periode -->
                <a href="{{ route('admin.periode.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.periode.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-calendar-alt w-4 text-center"></i>
                    <span class="text-sm">Periode</span>
                </a>

                <!-- Periode Skema -->
                <a href="{{ route('admin.periodeskema.index') }}"
                    class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.periodeskema.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-calendar-check w-4 text-center"></i>
                    <span class="text-sm">Periode Skema</span>
                </a>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- MENU LAINNYA (Jika ada)                      -->
        <!-- ============================================= -->
        <!-- Kosongkan atau tambahkan menu lain di sini -->

    </nav>

    <!-- ============================================= -->
    <!-- FOOTER - USER PROFILE & LOGOUT               -->
    <!-- ============================================= -->
    <div class="border-t border-white/5 p-4 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <div
                class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-sm font-bold text-white shadow-lg shadow-indigo-500/25 flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                <p class="text-[10px] text-gray-400 truncate">
                    @php
                        $roleLabels = [
                            'superadmin' => 'Super Admin',
                            'admin' => 'Admin',
                            'reviewer' => 'Reviewer',
                            'dosen' => 'Dosen',
                        ];
                    @endphp
                    {{ $roleLabels[Auth::user()->role ?? ''] ?? 'User' }}
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

<!-- ============================================= -->
<!-- SCRIPT UNTUK TOGGLE DROPDOWN                 -->
<!-- ============================================= -->
<script>
    let isMasterOpen = {{ $isMasterActive ? 'true' : 'false' }};

    function toggleMasterDropdown() {
        isMasterOpen = !isMasterOpen;
        const dropdown = document.getElementById('masterDropdown');
        const arrow = document.getElementById('masterArrow');

        if (isMasterOpen) {
            dropdown.style.maxHeight = '500px';
            dropdown.style.opacity = '1';
            dropdown.style.paddingTop = '4px';
            dropdown.style.pointerEvents = 'auto';
            arrow.classList.add('rotate-180');
        } else {
            dropdown.style.maxHeight = '0';
            dropdown.style.opacity = '0';
            dropdown.style.paddingTop = '0';
            dropdown.style.pointerEvents = 'none';
            arrow.classList.remove('rotate-180');
        }
    }

    // Saat halaman di-reload, pastikan dropdown tetap terbuka jika aktif
    document.addEventListener('DOMContentLoaded', function() {
        @if ($isMasterActive)
            const dropdown = document.getElementById('masterDropdown');
            const arrow = document.getElementById('masterArrow');
            dropdown.style.maxHeight = '500px';
            dropdown.style.opacity = '1';
            dropdown.style.paddingTop = '4px';
            dropdown.style.pointerEvents = 'auto';
            arrow.classList.add('rotate-180');
            isMasterOpen = true;
        @endif
    });
</script>
