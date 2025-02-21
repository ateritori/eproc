<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Akun - Dashboard Vendor</title>

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

        .pagination .page-link {
            padding: 5px 10px;
            font-size: 14px;
        }

        .pagination .page-item .page-link i {
            font-size: 12px;
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

        <!-- Sub Header -->
        <div class="sub-header">
            <h2 class="mb-0">Ubah Akun</h2>
        </div>

        <!-- Edit Account Form -->
        <div class="table-container mt-4">
        <form action="{{ route('update_account') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak diubah">
    </div>

    <button type="submit" class="btn btn-primary">Perbarui Akun</button>
</form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>