<nav class="navbar">
    <div class="container">
        <div class="logo">GrowEarth</div>
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('event') }}">Event</a></li>
            <li><a href="{{ route('donasi') }}">Donasi</a></li>
            <li><a href="{{ route('about') }}">Tentang</a></li>
            
            <li class="profile-menu">
                @auth
                    <a href="#">{{ Auth::user()->username }} ▾</a>
                    <ul class="dropdown">
                        @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                        @endif
                        <li><a href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 15px; cursor: pointer; font-size: 14px; color: white; font-family: inherit;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="#">Profile ▾</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register.form') }}">Daftar</a></li>
                    </ul>
                @endauth
            </li>
        </ul>
    </div>
</nav>