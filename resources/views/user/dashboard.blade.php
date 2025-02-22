@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')

    <!-- 🔹 Notifikasi Sukses / Error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p>Berikut adalah daftar pekerjaan yang tersedia:</p>

    @include('user.table') <!-- Memanggil tabel -->
@endsection
