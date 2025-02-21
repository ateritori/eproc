@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
    <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p>Berikut adalah daftar pekerjaan yang tersedia:</p>

    @include('user.table') <!-- Memanggil tabel -->
@endsection
