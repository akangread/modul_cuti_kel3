<?php
$activeUrl = $_GET['url'] ?? ''; // Get the current URL parameter or default to 'home'
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

    <!-- Tombol Logout -->
<li class="nav-item">
    <a class="nav-link" href="?url=landing" role="button">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</li>

        <!-- Other Navbar Links (Messages, Notifications, etc.) -->
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Modul Cuti</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">LIST MENU</li>
                <li class="nav-item">
                    <a href="./?url=service" class="nav-link <?php echo $activeUrl === 'service' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=divisi" class="nav-link <?php echo $activeUrl === 'divisi' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Divisi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=pegawai" class="nav-link <?php echo $activeUrl === 'pegawai' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=jatah_cuti" class="nav-link <?php echo $activeUrl === 'jatah_cuti' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Jatah Cuti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./?url=pengajuan" class="nav-link <?php echo $activeUrl === 'pengajuan' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>