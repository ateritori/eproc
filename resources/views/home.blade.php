<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Procurement</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        header {
            z-index: 1030;
        }

        .content {
            margin-top: 100px;
        }

        .sub-header {
            max-width: 1200px;
            margin: 20px auto;
            padding: 15px;
        }

        .table-container {
            max-width: 1200px;
            margin: auto;
        }

        .table td.text-start {
            text-align: left;
        }

        .table td.text-end {
            text-align: right;
        }
    </style>
</head>

<body>

    <header class="bg-dark text-white py-3 fixed-top shadow">
        <div class="container-fluid d-flex align-items-center">
            <img src="{{ asset('images/kemenhan.png') }}" alt="Logo Kemenhan" width="50" height="50"
                class="me-2">
            <h2 class="fw-bold">Sistem Pengadaan Alutsista Pertahanan</h2>

            <div class="ms-auto">
                @if (Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                @endif
            </div>
        </div>
    </header>

    <div class="container content">
        <div class="sub-header border rounded bg-light d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Daftar Pekerjaan yang Dilelang</h2>
            <form method="GET" action="{{ route('dashboard') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari pekerjaan..."
                    value="{{ request('search') }}" style="width: 250px;">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-start">Jenis Pekerjaan</th>
                            <th class="text-start">Deskripsi</th>
                            <th class="text-end">Pagu Lelang (Rp.)</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">File</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lelang as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration + ($lelang->currentPage() - 1) * $lelang->perPage() }}
                                </td>
                                <td class="text-start">{{ $item->jenis_pekerjaan }}</td>
                                <td class="text-start">{{ $item->rincian }}</td>
                                <td class="text-end">{{ number_format($item->pagu, 0, ',', '.') }}</td>
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
                                    <a href="{{ Auth::check() ? route('rfq.submit', ['id' => $item->id]) : '#' }}"
                                        class="btn btn-primary btn-sm submit-rfq"
                                        data-login="{{ Auth::check() ? 'yes' : 'no' }}">
                                        <i class="bi bi-send"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $lelang->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".submit-rfq").forEach(button => {
            button.addEventListener("click", function(event) {
                let isLoggedIn = this.getAttribute("data-login") === "yes";
                if (!isLoggedIn) {
                    event.preventDefault();
                    alert("Silakan login untuk mengikuti lelang.");
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
