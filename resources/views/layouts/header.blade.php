<div class="header">
    <span>Dashboard Pengguna</span>
    <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
        {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="{{ route('profil') }}">Akun</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
            </form>
        </li>
    </ul>
</div>
