@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
    @include('user.profiluser') <!-- Memanggil Profil User -->
    @include('user.profilvendor') <!-- Memanggil Profil Umum -->
@endsection
