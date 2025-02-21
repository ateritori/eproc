<div class="header">
    <span>Dashboard Pengguna</span>
    <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
        {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <!-- Menu Akun -->
        <li>
            <a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class="dropdown-item">
                <i class="bi bi-person"></i> Akun
            </a>
        </li>

        <!-- Logout -->
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
