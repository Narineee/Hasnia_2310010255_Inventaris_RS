{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Inventaris Rumah Sakit')</title>

{{-- Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- Boxicons (untuk icon tanpa FA) --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
body { min-height: 100vh; display: flex; flex-direction: column; }

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
    top: 0; left: 0;
    height: 100vh;
    width: 220px;
    background: linear-gradient(180deg, #1a3f7a, #000);
    color: #fff;
    padding-top: 60px;
    transition: width 0.3s;
    overflow-y: auto;
}
.sidebar.collapsed { width: 70px; }
.sidebar .nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    font-weight: 500;
    color: #fff;
}
.sidebar.collapsed .nav-link span { display: none; }
.sidebar .nav-link i, .sidebar .nav-link .bx { width: 25px; font-size: 18px; }
.sidebar .nav-link:hover { background-color: #e75480; border-radius: 5px; }

/* Content */
.content-wrapper {
    margin-left: 220px;
    padding: 20px;
    padding-top: 80px;
    transition: margin-left 0.3s;
}
.content-wrapper.expanded { margin-left: 70px; }

/* Card Hover Effect */
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    transition: 0.3s;
}
</style>

</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-dark">
    <div class="container-fluid d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-outline-light me-2">
            <i class='bx bx-chevron-left'></i>
        </button>
        <a class="navbar-brand d-flex align-items-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="me-2" viewBox="0 0 24 24">
                <path d="M12 3l8 7v11a1 1 0 0 1-1 1h-5v-6h-4v6H5a1 1 0 0 1-1-1V10l8-7z"/>
            </svg>
            Inventaris RS
        </a>
    </div>
</nav>

{{-- Sidebar --}}
<div class="sidebar" id="sidebar">
<ul class="nav flex-column">
    <li class="nav-item mb-2">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class='bx bx-home'></i> <span>Dashboard</span>
        </a>
    </li>
    @if(Auth::user()->role === 'admin')
    <li class="nav-item mb-2">
        <a href="{{ route('user.index') }}" class="nav-link">
            <i class='bx bx-user'></i>
            <span>User Management</span>
        </a>
    </li>
    @endif
    <li class="nav-item mb-2">
        <a href="{{ route('kategori.index') }}" class="nav-link">
            <i class='bx bx-category'></i> <span>Kategori</span>
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('barang.index') }}" class="nav-link">
            <i class='bx bx-box'></i> <span>Barang</span>
        </a>
    </li>
</ul>
</div>

{{-- Main Content --}}
<div class="content-wrapper" id="contentWrapper">
@yield('content')
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Sidebar Toggle --}}
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
