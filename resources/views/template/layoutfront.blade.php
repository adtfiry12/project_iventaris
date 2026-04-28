<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Inventaris</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/stylefront.css') }}">
</head>

<body>

    <header class="top-header">
        <a href="#" class="logo">
            <i class="fa-solid fa-boxes-stacked"></i> Sistem Inventaris
        </a>

        <div class="search-bar">
            <input type="text" placeholder="Cari nama barang atau kode inventaris...">
            <button type="button"><i class="fas fa-search"></i></button>
        </div>

        <div class="user-actions" style="display: flex; align-items: center; gap: 10px;">
            @guest
                <i class="fas fa-box-open fs-4 text-teal" style="color: var(--teal);"></i>
                <span>
                    <a href="{{ route('login') }}" style="text-decoration: none;">Log In</a> |
                    <a href="{{ route('register') }}" style="text-decoration: none;">Sign Up</a>
                </span>
            @else
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('dashboard') }}" style="color: var(--teal); font-weight: 600; text-decoration: none;">
                        <i class="fas fa-tachometer-alt"></i> Panel Admin
                    </a>
                    <span style="color: #ccc;">|</span>
                @endif

                @if (auth()->user()->image)
                    <a href="#"><img src="{{ asset('storage/' . auth()->user()->image) }}" alt="User Avatar"
                            style="width: 30px; height: 30px; object-fit: cover; border-radius: 100%;"></a>
                @else
                    <a href="#">
                        <div
                            style="width: 30px; height: 30px; border-radius: 100%; background-color: #e9ecef; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="color: #6c757d; font-size: 14px;"></i>
                        </div>
                    </a>
                @endif

                <a href="#"><span style="font-weight: 500;">{{ auth()->user()->username }}</span></a>
                <span style="color: #ccc;">|</span>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; padding: 0; color: #dc3545; cursor: pointer; font-weight: 500;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @endguest
        </div>
    </header>

    <nav class="navbar-custom">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('inventaris.*') ? 'active' : '' }}">
                    Data Inventaris
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    Kategori
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('ruang.*') ? 'active' : '' }}">
                    Data Ruang
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                    Daftar Karyawan
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    Peminjaman Barang
                </a>
            </li>
        </ul>
    </nav>
    <div class="content">
        @yield('content')
    </div>

</body>

</html>
