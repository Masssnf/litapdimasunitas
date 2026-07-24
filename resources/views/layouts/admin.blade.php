<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LPPM UNITAS</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- ============================================= -->
    <!-- FONT AWESOME                                  -->
    <!-- ============================================= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- ============================================= -->
    <!-- JQUERY (Wajib untuk Select2)                  -->
    <!-- ============================================= -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ============================================= -->
    <!-- SELECT2 CSS                                   -->
    <!-- ============================================= -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- ============================================= -->
    <!-- SELECT2 JS                                    -->
    <!-- ============================================= -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- ============================================= -->
    <!-- SWEETALERT2                                   -->
    <!-- ============================================= -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Memastikan dropdown tidak terpotong */
        #masterDropdown {
            position: relative;
            z-index: 10;
        }

        /* Memberikan ruang scroll yang cukup */
        nav {
            scroll-behavior: smooth;
            padding-bottom: 20px;
        }

        .pagination {
            @apply flex flex-wrap gap-1;
        }

        .pagination .page-item {
            @apply flex items-center justify-center;
        }

        .pagination .page-link {
            @apply flex items-center justify-center min-w-[36px] h-9 px-3.5 rounded-xl text-sm font-medium transition-all duration-200;
            @apply bg-white border border-gray-200 text-gray-600;
            @apply hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm;
        }

        .pagination .active .page-link {
            @apply bg-gradient-to-r from-indigo-500 to-purple-500 border-transparent text-white shadow-md shadow-indigo-500/25;
            @apply hover:from-indigo-600 hover:to-purple-600 hover:shadow-lg hover:shadow-indigo-500/30;
        }

        .pagination .disabled .page-link {
            @apply opacity-40 cursor-not-allowed pointer-events-none bg-gray-50;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Custom Scrollbar untuk Sidebar */
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* ============================================= */
        /* SELECT2 CUSTOM STYLE                         */
        /* ============================================= */

        /* Container Select2 */
        .select2-container--default .select2-selection--single {
            height: 46px;
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            background-color: white;
            transition: all 0.2s ease;
        }

        .select2-container--default .select2-selection--single:hover {
            border-color: #818cf8;
        }

        .select2-container--default .select2-selection--single:focus,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
            outline: none;
        }

        /* Arrow Dropdown */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px;
            right: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #9ca3af transparent transparent transparent;
            border-width: 6px 5px 0 5px;
        }

        /* Placeholder */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9ca3af;
        }

        /* Dropdown Menu */
        .select2-dropdown {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1050;
        }

        .select2-results__option {
            padding: 10px 16px;
            transition: all 0.15s ease;
        }

        .select2-results__option--highlighted {
            background-color: #eef2ff !important;
            color: #4f46e5 !important;
        }

        .select2-results__option--selected {
            background-color: #6366f1 !important;
            color: white !important;
        }

        /* Error State */
        .select2-container--error .select2-selection--single {
            border-color: #f43f5e !important;
            box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.2) !important;
        }

        /* Search Box di Select2 */
        .select2-search--dropdown .select2-search__field {
            border-radius: 8px !important;
            border: 1px solid #e5e7eb !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
        }

        .select2-search--dropdown .select2-search__field:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
            outline: none !important;
        }

        /* Disabled State */
        .select2-container--default .select2-selection--single.select2-selection--disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }

        /* Multiple Select */
        .select2-container--default .select2-selection--multiple {
            border-radius: 12px;
            border: 1px solid #d1d5db;
            padding: 4px 8px;
            min-height: 46px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #eef2ff;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            padding: 2px 10px;
            color: #4f46e5;
            font-size: 13px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #4f46e5;
            margin-right: 4px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ef4444;
        }

        /* Responsive Select2 */
        @media (max-width: 640px) {
            .select2-container--default .select2-selection--single {
                height: 42px;
                padding: 6px 10px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 40px;
            }

            .select2-container--default .select2-selection--multiple {
                min-height: 42px;
                padding: 4px 6px;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50">
    <div class="flex h-screen">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-sm border-b border-gray-100/80 flex-shrink-0">
                <div class="px-6 py-3.5 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <span class="w-1 h-6 bg-gradient-to-b from-indigo-500 to-purple-500 rounded-full mr-3"></span>
                        @yield('header')
                    </h2>
                    <div class="flex items-center space-x-4">
                        <button
                            class="w-9 h-9 rounded-xl hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition flex items-center justify-center relative">
                            <i class="fas fa-bell"></i>
                            <span
                                class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                        </button>
                        <div class="w-px h-6 bg-gray-200"></div>
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-slate-50/50">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- ============================================= -->
    <!-- SWEETALERT SCRIPTS                           -->
    <!-- ============================================= -->
    <script>
        // =============================================
        // AUTO SHOW ALERT DARI SESSION
        // =============================================
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'OK',
                    backdrop: 'rgba(0,0,0,0.3)',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl',
                        title: 'text-xl font-bold',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-semibold'
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK',
                    backdrop: 'rgba(0,0,0,0.3)',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl',
                        title: 'text-xl font-bold',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-semibold'
                    }
                });
            @endif

            @if (session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: '{{ session('warning') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#f59e0b',
                    confirmButtonText: 'OK',
                    backdrop: 'rgba(0,0,0,0.3)',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl',
                        title: 'text-xl font-bold',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-semibold'
                    }
                });
            @endif

            @if (session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi!',
                    text: '{{ session('info') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK',
                    backdrop: 'rgba(0,0,0,0.3)',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl',
                        title: 'text-xl font-bold',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-semibold'
                    }
                });
            @endif
        });

        // =============================================
        // FUNGSI KONFIRMASI HAPUS
        // =============================================
        function confirmDelete(form, name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                html: 'Data <strong class="text-rose-600">' + name +
                    '</strong> akan dihapus <strong class="text-rose-600">permanen</strong>!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash mr-2"></i> Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times mr-2"></i> Batal',
                backdrop: 'rgba(0,0,0,0.4)',
                customClass: {
                    popup: 'rounded-2xl shadow-2xl',
                    title: 'text-xl font-bold',
                    confirmButton: 'px-6 py-2.5 rounded-xl font-semibold bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 border-0',
                    cancelButton: 'px-6 py-2.5 rounded-xl font-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }

        // =============================================
        // FUNGSI KONFIRMASI TOGGLE STATUS
        // =============================================
        function confirmToggle(form, name, action) {
            var isActive = action === 'aktifkan';
            var icon = isActive ? 'success' : 'warning';
            var title = isActive ? 'Aktifkan User?' : 'Nonaktifkan User?';
            var html = 'User <strong class="' + (isActive ? 'text-emerald-600' : 'text-rose-600') + '">' + name +
                '</strong> akan <strong class="' + (isActive ? 'text-emerald-600' : 'text-rose-600') + '">' + (isActive ?
                    'diaktifkan' : 'dinonaktifkan') + '</strong>!';
            var confirmColor = isActive ? '#10b981' : '#ef4444';
            var confirmText = isActive ? '<i class="fas fa-check mr-2"></i> Ya, Aktifkan!' :
                '<i class="fas fa-times mr-2"></i> Ya, Nonaktifkan!';
            var confirmClass = isActive ?
                'px-6 py-2.5 rounded-xl font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 border-0' :
                'px-6 py-2.5 rounded-xl font-semibold bg-gradient-to-r from-rose-500 to-red-500 hover:from-rose-600 hover:to-red-600 border-0';

            Swal.fire({
                title: title,
                html: html,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmColor,
                cancelButtonColor: '#6b7280',
                confirmButtonText: confirmText,
                cancelButtonText: '<i class="fas fa-times mr-2"></i> Batal',
                backdrop: 'rgba(0,0,0,0.4)',
                customClass: {
                    popup: 'rounded-2xl shadow-2xl',
                    title: 'text-xl font-bold',
                    confirmButton: confirmClass,
                    cancelButton: 'px-6 py-2.5 rounded-xl font-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>

    <!-- ============================================= -->
    <!-- SELECT2 INISIALISASI GLOBAL                  -->
    <!-- ============================================= -->
    <script>
        $(document).ready(function() {
            // Inisialisasi semua select dengan class .select2
            $('.select2').each(function() {
                var options = {
                    placeholder: $(this).data('placeholder') || 'Pilih...',
                    allowClear: $(this).data('allow-clear') || false,
                    minimumResultsForSearch: $(this).data('search') || -1,
                    width: '100%'
                };
                $(this).select2(options);
            });

            // Inisialisasi select dengan atribut data-select2
            $('select[data-select2]').each(function() {
                var options = {
                    placeholder: $(this).data('placeholder') || 'Pilih...',
                    allowClear: $(this).data('allow-clear') || false,
                    minimumResultsForSearch: $(this).data('search') || -1,
                    width: '100%'
                };
                $(this).select2(options);
            });
        });
    </script>

    <!-- ============================================= -->
    <!-- YIELD SCRIPTS (untuk halaman spesifik)        -->
    <!-- ============================================= -->
    @yield('scripts')
</body>

</html>
