@extends('layouts.admin')

@section('header', 'Detail Review')

@section('content')
    <div class="space-y-5">

        <div
            class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-600 rounded-2xl shadow-xl shadow-emerald-500/20 p-6">
            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-clipboard-check text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Review</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-emerald-100 text-sm">Proposal: {{ $proposal->kode_proposal }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.proposal.review.index', $proposal->id) }}"
                        class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Kolom Kiri - Data Review -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Review</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap hasil review</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Reviewer</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $review->proposalReviewer->reviewer->nama_reviewer ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Tanggal Review</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $review->tanggal_review_formatted }}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nilai</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{!! $review->nilai_label !!}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Keputusan</p>
                                <div class="mt-1">{!! $review->rekomendasi_badge !!}</div>
                            </div>
                            <div class="md:col-span-2 bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Catatan</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $review->catatan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Informasi Proposal -->
            <div class="space-y-5">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-file-alt text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Informasi Proposal</h3>
                            <p class="text-xs text-gray-400">Data proposal terkait</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <div>
                            <p class="text-xs text-gray-400">Kode</p>
                            <p class="font-semibold text-gray-800">{{ $proposal->kode_proposal }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Judul</p>
                            <p class="font-semibold text-gray-800">{{ $proposal->judul }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Status</p>
                            <div>{!! $proposal->status_badge !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
