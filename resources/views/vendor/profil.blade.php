<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendor</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            background-color: #f8f9fa;
        }
        
        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            width: 70px;
            margin-bottom: 10px;
        }

        .sidebar h4 {
            margin-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            width: 100%;
            text-align: left;
        }

        .sidebar a:hover {
            background: #495057;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            width: calc(100% - 240px);
            padding: 20px;
        }

        .header {
            background: #007bff;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
        }

        .sub-header {
            width: 100%;
            margin: 20px 0;
            padding: 12px 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-container {
            width: 100%;
        }

        .table td {
            vertical-align: middle;
        }

        /* Styling for the profile table */
        .table td {
            padding: 12px 15px;
        }

        .table th, .table td {
            text-align: left;
        }

        /* Set column widths */
        .table td:nth-child(1) {
            width: 25%; /* Label column */
        }
        .table td:nth-child(2) {
            width: 5%; /* ":" column */
            text-align: center;
        }
        .table td:nth-child(3) {
            width: 70%; /* Data column */
        }

        /* Add some margin between user and company info */
        .divider {
            border-top: 2px solid #007bff;
            margin: 20px 0;
        }

        .label-section {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('images/kemenhan.png') }}" alt="Logo Kemenhan">
        <h4>Dashboard</h4>
        <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
        <a href="{{ route('profile') }}" class="{{ request()->is('dashboard/profil') ? 'active' : '' }}">👤 Profil</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <span>Sistem Pengadaan Alutsista Pertahanan</span>
            <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Akun</a></li>
                <li>
                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Tabel Profil User -->
        <!-- Tabel Profil User -->
<div class="table-container mt-4">
    <h4 class="label-section">Data Akun Perusahaan</h4>
    <table class="table table-bordered">
        <tr>
            <td><strong>ID</strong></td>
            <td>:</td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td>:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>:</td>
            <td>{{ $user->email }}</td>
        </tr>
    </table>
    <a href="{{ route('edit_account') }}" class="btn btn-primary">Ubah Akun</a> <!-- Tombol Ubah Akun -->
</div>

<!-- Divider Between User and Company Data -->
<div class="divider"></div>

<!-- Tabel Profil Vendor -->
<div class="table-container mt-4">
    <h4 class="label-section">Data Umum Perusahaan</h4>
    <table class="table table-bordered">
        <tr>
            <td><strong>Nama Perusahaan</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->nama_perusahaan }}</td>
        </tr>
        <tr>
            <td><strong>Nomor Induk Berusaha (NIB)</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->nib }}</td>
        </tr>
        <tr>
            <td><strong>Alamat Perusahaan</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->alamat_perusahaan }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->email }}</td>
        </tr>
        <tr>
            <td><strong>Nomor Telepon</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->nomor_telepon }}</td>
        </tr>
        <tr>
            <td><strong>Nama PIC (Penanggung Jawab)</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->nama_pic }}</td>
        </tr>
        <tr>
            <td><strong>Nomor HP PIC</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->nomor_hp_pic }}</td>
        </tr>
        <tr>
            <td><strong>Bidang Usaha</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->bidang_usaha }}</td>
        </tr>
        <tr>
            <td><strong>Kategori Vendor</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->kategori_vendor }}</td>
        </tr>
        <tr>
            <td><strong>Tahun Berdiri</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->tahun_berdiri }}</td>
        </tr>
        <tr>
            <td><strong>Sertifikasi dan Legalitas</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->sertifikasi_legalitas }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah Proyek Terselesaikan</strong></td>
            <td>:</td>
            <td>{{ $user->perusahaan->jumlah_proyek_terselesaikan }}</td>
        </tr>
    </table>
    <a href="{{ route('edit_profile') }}" class="btn btn-primary">Ubah Profil</a> <!-- Tombol Ubah Profil -->
</div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>