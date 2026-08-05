<div>
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-sm font-semibold text-gray-700">Hasil Review</h4>
        @if($proposal->status == 'Direview' && $proposal->review_history_count == 0)
            <a href="{{ route('admin.proposal.review.create', $proposal->id) }}" 
               class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 text-xs">
                <i class="fas fa-plus mr-1"></i>Tambah Review
            </a>
        @endif
    </div>

    <!-- ============================================= -->
    <!-- REVIEW TERBARU (Dari tabel Review)           -->
    <!-- ============================================= -->
    @if($proposal->review_history_count > 0)
        <div class="mb-4 p-4 bg-green-50 rounded-xl border border-green-200">
            <h5 class="text-sm font-semibold text-green-700 mb-2">
                <i class="fas fa-check-circle mr-1"></i> Hasil Review Terakhir
            </h5>
            @foreach($proposal->reviewHistory as $item)
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 text-sm">
                    <div>
                        <span class="text-gray-500">Reviewer:</span>
                        <span class="font-medium">{{ $item->reviewer->nama_reviewer ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Nilai:</span>
                        <span class="font-medium">{!! $item->nilai_label !!}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Keputusan:</span>
                        <span>{!! $item->rekomendasi_badge !!}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Tanggal:</span>
                        <span class="font-medium">{{ $item->tanggal_review_formatted }}</span>
                    </div>
                    @if($item->catatan)
                        <div class="md:col-span-4">
                            <span class="text-gray-500">Catatan:</span>
                            <span class="font-medium">{{ $item->catatan }}</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-4 text-gray-500">
            <i class="fas fa-clipboard-check text-3xl text-gray-300 mb-2 block"></i>
            <p>Belum ada hasil review</p>
        </div>
    @endif

    <!-- ============================================= -->
    <!-- HISTORY REVIEW (Dari tabel ProposalReview)   -->
    <!-- ============================================= -->
    @if($proposal->proposal_review_history_count > 0)
        <div>
            <h5 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fas fa-history text-gray-500"></i>
                History Review
                <span class="text-xs text-gray-400">({{ $proposal->proposal_review_history_count }})</span>
            </h5>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Reviewer</th>
                            <th class="px-4 py-2 text-center">Nilai</th>
                            <th class="px-4 py-2 text-center">Keputusan</th>
                            <th class="px-4 py-2 text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proposal->proposalReviewHistory as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $item->reviewer->nama_reviewer ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if($item->nilai)
                                        <span class="font-semibold {{ $item->nilai >= 70 ? 'text-emerald-600' : 'text-rose-600' }}">
                                            {{ $item->nilai }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">{!! $item->rekomendasi_badge !!}</td>
                                <td class="px-4 py-2 text-center">{{ $item->tanggal_review_formatted }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>