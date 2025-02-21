@extends('layouts.app')

@section('title', 'Submit Penawaran')

@section('content')
    <div class="container mt-4">
        <h3>Submit Penawaran untuk "{{ $lelang->jenis_pekerjaan }}"</h3>

        <form action="{{ route('penawaran.store', ['id' => $lelang->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Harga Penawaran (Rp)</label>
                <input type="number" name="harga_penawaran" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload File Penawaran (PDF, max 2MB)</label>
                <input type="file" name="file_penawaran" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Kirim Penawaran</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
