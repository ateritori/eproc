<div class="table-responsive">
    <table class="table table-pekerjaan">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No</th>
                <th>Jenis Pekerjaan</th>
                <th class="text-center">Pagu Lelang (Rp.)</th>
                <th class="text-center">Tahun</th>
                <th class="text-center">File</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lelang as $index => $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($lelang->currentPage() - 1) * $lelang->perPage() }}
                    </td>
                    <td class="text-left">{{ $item->jenis_pekerjaan }}</td>
                    <td class="text-right">{{ number_format($item->pagu, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->tahun }}</td>
                    <td class="text-center">
                        @if ($item->file)
                            <a href="{{ asset('storage/' . $item->file) }}" class="btn btn-link">
                                <i class="bi bi-download"></i>
                            </a>
                        @else
                            <i class="bi bi-file-earmark-x text-muted"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('penawaran.create', ['id' => $item->id]) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-send"></i> Kirim Penawaran
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container d-flex justify-content-center mt-3">
    {{ $lelang->links('vendor.pagination.bootstrap-5') }}
</div>
