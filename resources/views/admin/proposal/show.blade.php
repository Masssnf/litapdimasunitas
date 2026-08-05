@extends('layouts.admin')

@section('header', 'Detail Proposal')

@section('content')
<div class="space-y-5">

    <!-- ============================================= -->
    <!-- HERO HEADER                                   -->
    <!-- ============================================= -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-500 to-purple-600 rounded-2xl shadow-xl shadow-indigo-500/20 p-6">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-purple-400/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Detail Proposal</h1>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <span class="text-indigo-100 text-sm">{{ $proposal->kode_proposal }}</span>
                        {!! $proposal->status_badge !!}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.proposal.edit', $proposal->id) }}" 
                   class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.proposal.index') }}" 
                   class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- ============================================= -->
    <!-- TAB NAVIGATION                               -->
    <!-- ============================================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-2 px-4 overflow-x-auto" x-data="{ tab: 'detail' }">
                <button @click="tab = 'detail'" 
                        :class="tab === 'detail' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-4 px-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                    <i class="fas fa-info-circle mr-2"></i>Detail
                </button>
                <button @click="tab = 'anggota'" 
                        :class="tab === 'anggota' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-4 px-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                    <i class="fas fa-users mr-2"></i>Anggota
                    <span class="ml-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $proposal->anggota_count }}</span>
                </button>
                <button @click="tab = 'mahasiswa'" 
                        :class="tab === 'mahasiswa' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-4 px-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                    <i class="fas fa-user-graduate mr-2"></i>Mahasiswa
                    <span class="ml-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $proposal->mahasiswa_count }}</span>
                </button>
                <button @click="tab = 'dokumen'" 
                        :class="tab === 'dokumen' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-4 px-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                    <i class="fas fa-file-pdf mr-2"></i>Dokumen
                    <span class="ml-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $proposal->dokumen_count }}</span>
                </button>
                <button @click="tab = 'reviewer'" 
                        :class="tab === 'reviewer' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-4 px-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                    <i class="fas fa-user-check mr-2"></i>Reviewer
                    <span class="ml-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $proposal->reviewer_count }}</span>
                </button>
                <button @click="tab = 'review'" 
                        :class="tab === 'review' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-4 px-4 border-b-2 font-medium text-sm transition whitespace-nowrap">
                    <i class="fas fa-clipboard-check mr-2"></i>Review
                    <span class="ml-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $proposal->review_history_count }}</span>
                </button>
            </nav>
        </div>

        <!-- ============================================= -->
        <!-- TAB CONTENT                                  -->
        <!-- ============================================= -->
        <div class="p-6">

            <!-- ============================================= -->
            <!-- TAB 1: DETAIL PROPOSAL                       -->
            <!-- ============================================= -->
            <div x-show="tab === 'detail'">
                @include('admin.proposal.partials.detail')
            </div>

            <!-- ============================================= -->
            <!-- TAB 2: ANGGOTA                               -->
            <!-- ============================================= -->
            <div x-show="tab === 'anggota'">
                @include('admin.proposal.anggota.index')
            </div>

            <!-- ============================================= -->
            <!-- TAB 3: MAHASISWA                             -->
            <!-- ============================================= -->
            <div x-show="tab === 'mahasiswa'">
                @include('admin.proposal.mahasiswa.index')
            </div>

            <!-- ============================================= -->
            <!-- TAB 4: DOKUMEN                               -->
            <!-- ============================================= -->
            <div x-show="tab === 'dokumen'">
                @include('admin.proposal.dokumen.index')
            </div>

            <!-- ============================================= -->
            <!-- TAB 5: REVIEWER                              -->
            <!-- ============================================= -->
            <div x-show="tab === 'reviewer'">
                @include('admin.proposal.reviewer.index')
            </div>

            <!-- ============================================= -->
            <!-- TAB 6: REVIEW                                -->
            <!-- ============================================= -->
            <div x-show="tab === 'review'">
                @include('admin.proposal.review.index')
            </div>

        </div>
    </div>
</div>
@endsection