<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Inventaris Rumah Sakit')</title>

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- Boxicons --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Navbar */
.navbar {
    position: fixed;
    width: 100%;
    z-index: 1030;
    background: linear-gradient(90deg, #1a3f7a, #000);
}

/* Sidebar */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 100vh;
    padding-top: 60px;
    background: linear-gradient(180deg, #1a3f7a, #000);
    transition: width 0.3s;
    overflow-y: auto;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar .nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: #fff;
    font-weight: 500;
}

.sidebar .nav-link:hover {
    background-color: #e75480;
    border-radius: 5px;
}

.sidebar.collapsed .nav-link span {
    display: none;
}

.sidebar i {
    font-size: 18px;
    width: 24px;
}

/* Content */
.content-wrapper {
    margin-left: 220px;
    padding: 20px;
    padding-top: 80px;
    transition: margin-left 0.3s;
}

.content-wrapper.expanded {
    margin-left: 70px;
}
</style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <button id="sidebarToggle" class="btn btn-outline-light">
            <i class='bx bx-chevron-left'></i>
        </button>

        <span class="navbar-brand ms-2">Inventaris RS</span>
    </div>
</nav>

{{-- SIDEBAR --}}
<div class="sidebar" id="sidebar">
    <ul class="nav flex-column">

        {{-- DASHBOARD --}}
        <li class="nav-item mb-2">
            <a class="nav-link"
               href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('petugas.dashboard') }}">
                <i class='bx bx-home'></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- ADMIN MENU --}}
        @if(auth()->user()->role === 'admin')
            <li class="nav-item mb-2">
                <a href="{{ route('kategori.index') }}" class="nav-link">
                    <i class='bx bx-category'></i>
                    <span>Kategori</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('barang.index') }}" class="nav-link">
                    <i class='bx bx-box'></i>
                    <span>Barang</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('user.index') }}" class="nav-link">
                    <i class='bx bx-user'></i>
                    <span>User</span>
                </a>
            </li>
        @endif

        {{-- PETUGAS MENU --}}
        @if(auth()->user()->role === 'petugas')
            <li class="nav-item mb-2">
                <a href="{{ route('petugas.stok.index') }}" class="nav-link">
                    <i class='bx bx-archive'></i>
                    <span>Stok Barang</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('petugas.transaksi.index') }}" class="nav-link">
                    <i class='bx bx-transfer'></i>
                    <span>Transaksi</span>
                </a>
            </li>
        @endif

    </ul>
</div>

{{-- CONTENT --}}
<div class="content-wrapper" id="contentWrapper">
    @yield('content')
</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const toggleBtn = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('contentWrapper');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('expanded');

    const icon = toggleBtn.querySelector('i');
    icon.classList.toggle('bx-chevron-left');
    icon.classList.toggle('bx-chevron-right');
});
</script>

</body>
</html>
