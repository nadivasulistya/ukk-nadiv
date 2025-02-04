<header>
<!-- Add Navbar -->
<nav class="custom-navbar">
    <div class="nav-content">
        <a href="{{ url('/') }}" class="nav-brand">Tracer Study</a>
        <div class="nav-profile">
            @auth
                <span class="user-name">{{ Auth::user()->name }}</span>
                <img class="nav-avatar" 
                     src="{{ Auth::user()->avatar ? '/avatars/'.Auth::user()->avatar : asset('/images/images.png') }}"
                     alt="Profile">
                <a href="{{ route('logout') }}" 
                   class="logout-btn"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>
    </div>
</nav>
</header>