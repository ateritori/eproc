<div class="sidebar">
    <h4>Dashboard</h4>
    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('profil') }}">👤 Profil</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a>
</div>
