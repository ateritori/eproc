@extends('layouts.app')

@section('title', 'Edit Vendor')

@section('content')
    <div class="container">
        <h3>Edit Data Vendor</h3>

        <form action="{{ route('update_vendor', ['id_vendor' => $vendor->id_vendor]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pemilik" class="form-label">Pemilik</label>
                <input type="text" class="form-control" id="pemilik" name="pemilik" value="{{ $vendor->pemilik }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $vendor->alamat }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $vendor->telepon }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="pic" class="form-label">Nama PIC</label>
                <input type="text" class="form-control" id="pic" name="pic" value="{{ $vendor->pic }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="hp_pic" class="form-label">Nomor HP PIC</label>
                <input type="text" class="form-control" id="hp_pic" name="hp_pic" value="{{ $vendor->hp_pic }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="bidang" class="form-label">Bidang Usaha</label>
                <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $vendor->bidang }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="berdiri" class="form-label">Tahun Berdiri</label>
                <input type="number" class="form-control" id="berdiri" name="berdiri" value="{{ $vendor->berdiri }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="legalitas" class="form-label">Sertifikasi dan Legalitas</label>
                <input type="text" class="form-control" id="legalitas" name="legalitas" value="{{ $vendor->legalitas }}">
            </div>

            <div class="mb-3">
                <label for="total_proyek" class="form-label">Jumlah Proyek Terselesaikan</label>
                <input type="number" class="form-control" id="total_proyek" name="total_proyek"
                    value="{{ $vendor->total_proyek }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('profil') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
