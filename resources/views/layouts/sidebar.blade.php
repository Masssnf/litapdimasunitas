<aside
    class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-white min-h-screen flex-shrink-0 shadow-2xl flex flex-col">
    <!-- ============================================= -->
    <!-- HEADER / LOGO                                -->
    <!-- ============================================= -->
    <div class="p-5 border-b border-white/5">
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
        <div>
            <!-- Master Data Dropdown -->
            <div class="relative">
                <input type="checkbox" id="masterDropdown" class="peer hidden">

                <!-- Label / Toggle Dropdown -->
                <label for="masterDropdown"
                    class="flex items-center justify-between cursor-pointer py-2.5 px-4 rounded-xl transition-all duration-200 text-gray-300 hover:bg-white/5 hover:text-white {{ request()->routeIs('fakultas.*') || request()->routeIs('prodi.*') ? 'bg-white/5 text-white' : '' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-database w-5 text-center"></i>
                        <span class="text-sm font-medium">Master Data</span>
                    </div>
                    <i
                        class="fas fa-chevron-down text-xs transition-transform duration-200 peer-checked:rotate-180"></i>
                </label>

                <!-- Dropdown Menu -->
                <div class="overflow-hidden max-h-0 peer-checked:max-h-96 transition-all duration-300 ease-in-out">
                    <div class="ml-4 mt-1 space-y-0.5 border-l-2 border-indigo-500/30 pl-3">
                        <!-- Fakultas -->
                        <a href="{{ route('admin.fakultas.index') }}"
                            class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('fakultas.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <i class="fas fa-university w-4 text-center"></i>
                            <span class="text-sm">Fakultas</span>
                            {{-- <span
                                class="ml-auto text-[9px] font-semibold bg-indigo-500/20 text-indigo-300 px-1.5 py-0.5 rounded-full border border-indigo-500/30">Data</span> --}}
                        </a>

                        <!-- Program Studi -->
                        <a href="{{ route('admin.fakultas.index') }}"
                            class="flex items-center space-x-3 py-2 px-4 rounded-xl transition-all duration-200 {{ request()->routeIs('prodi.*') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            <i class="fas fa-book-open w-4 text-center"></i>
                            <span class="text-sm">Program Studi</span>
                            {{-- <span
                                class="ml-auto text-[9px] font-semibold bg-green-500/20 text-green-300 px-1.5 py-0.5 rounded-full border border-green-500/30">Data</span> --}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ============================================= -->
    <!-- FOOTER - USER PROFILE & LOGOUT               -->
    <!-- ============================================= -->
    <div class="border-t border-white/5 p-4">
        <div class="flex items-center space-x-3">
            <div
                class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-sm font-bold text-white shadow-lg shadow-indigo-500/25">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
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
