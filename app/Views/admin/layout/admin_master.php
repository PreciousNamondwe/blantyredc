<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'Admin Dashboard') ?> - Blantyre District Council</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            /* Your Exact Government & Excel Custom Variables */
            --gov-navy-primary: #1a3352;
            --gov-navy-hover: #112237;
            --gov-gold: #d4af37;
            --gov-gold-light: #fdfaf2;
            --gov-border: #ccd4dc;
            --gov-bg-muted: #f5f7fa;
            --gov-text: #2d3748;
            --excel-border: #d0d7de;
            --excel-header-bg: #f6f8fa;
            
            /* Structural Variables mapped to your specific design spec tokens */
            --bg-main: var(--gov-bg-muted);
            --sidebar-bg: var(--gov-navy-primary);
            --sidebar-border: #23436b;
            --text-muted: #a0aec0;
            --sidebar-width: 280px; /* Expanded slightly for the brand text layout */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: var(--gov-text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Responsive Sidebar matching Gov Navy Specifications */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 3px solid var(--gov-gold);
            background: var(--gov-navy-hover);
        }

        .sidebar .nav {
            padding: 1rem 0.75rem;
        }

        .sidebar .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.7rem 1rem;
            border-radius: 4px;
            transition: all 0.15s ease-in-out;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link i.main-icon {
            width: 24px;
            font-size: 1.05rem;
            margin-right: 0.75rem;
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover { 
            color: #fff; 
            background: var(--gov-navy-hover); 
        }

        .sidebar .nav-link.active { 
            color: #fff; 
            background: rgba(255, 255, 255, 0.08);
            box-shadow: inset 4px 0 0 var(--gov-gold);
            border-radius: 0 4px 4px 0;
        }

        .sidebar .nav-link.active i.main-icon {
            color: var(--gov-gold) !important;
        }
        
        .text-danger-hover:hover {
            background: rgba(229, 62, 62, 0.1) !important;
            color: #e53e3e !important;
        }

        /* Top Navbar Architecture */
        .top-navbar {
            margin-left: var(--sidebar-width);
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid var(--excel-border);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Main Workspace Canvas */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.75rem;
            min-height: calc(100vh - 70px);
        }

        /* Badge/Initial Seal Syncing */
        .avatar-seal {
            width: 40px;
            height: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            background-color: var(--gov-gold-light);
            color: var(--gov-navy-primary);
            border: 1px solid var(--gov-gold);
        }

        /* Responsive Breakpoints */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .top-navbar {
                margin-left: 0;
                padding: 0 1rem;
            }
            .sidebar-brand {
                padding: 1.5rem 1rem;
            }
            .main-content {
                margin-left: 0;
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand d-flex align-items-center justify-content-between">
            <h6 class="text-white m-0 d-flex align-items-center tracking-wider text-uppercase fw-bold" style="letter-spacing: 0.5px; font-size: 0.95rem;">
                <img src="<?= base_url('favicon.ico') ?>" 
                     alt="Gov Emblem" 
                     class="me-2.5" 
                     style="width: 80px; height: 80px; object-fit: contain; min-width: 32px;">
                <span class="lh-sm" style="display: inline-block;">Blantyre District<br><small style="font-size: 0.725rem; opacity: 0.85; font-weight: 500; letter-spacing: 0.2px;">Council Panel</small></span>
            </h6>
            <button type="button" class="btn-close btn-close-white d-lg-none" onclick="toggleSidebar()"></button>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'dashboard') ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-chart-pie main-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'applications') ? 'active' : '' ?>" href="<?= base_url('admin/applications') ?>">
                    <i class="fas fa-file-alt main-icon"></i>
                    <span>Applications</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'officials') ? 'active' : '' ?>" href="<?= base_url('admin/officials') ?>">
                    <i class="fas fa-landmark main-icon"></i>
                    <span>Council</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'services') ? 'active' : '' ?>" href="<?= base_url('admin/services') ?>">
                    <i class="fas fa-briefcase main-icon"></i>
                    <span>Services</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'projects') ? 'active' : '' ?>" href="<?= base_url('admin/projects') ?>">
                    <i class="fas fa-project-diagram main-icon"></i>
                    <span>Projects</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'news') ? 'active' : '' ?>" href="<?= base_url('admin/news') ?>">
                    <i class="fas fa-newspaper main-icon"></i>
                    <span>News</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'notifications') ? 'active' : '' ?>" href="<?= base_url('admin/notifications') ?>">
                    <i class="fas fa-bell main-icon"></i>
                    <span>Notifications</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= ($page === 'users') ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                    <i class="fas fa-users main-icon"></i>
                    <span>Users</span>
                </a>
            </li>
            
            <li class="nav-item mt-4 pt-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
                <a class="nav-link text-danger-hover" href="<?= base_url('logout') ?>">
                    <i class="fas fa-sign-out-alt main-icon text-danger"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="top-navbar d-flex justify-content-between align-items-center">
        <button class="btn btn-light d-lg-none me-2" type="button" onclick="toggleSidebar()" style="border: 1px solid var(--excel-border);">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="d-none d-sm-flex align-items-center">
            <span class="badge me-2 text-uppercase font-monospace-gov" style="background-color: var(--gov-navy-primary); font-size: 0.7rem; letter-spacing: 0.5px;">System Node</span>
            <h5 class="m-0 fw-bold text-dark text-capitalize" style="font-size: 1.1rem; color: var(--gov-navy-primary) !important;"><?= esc($page ?? 'Dashboard') ?></h5>
        </div>
        
        <div class="d-flex align-items-center gap-3 ms-auto">
            <div class="position-relative cursor-pointer me-2">
                <i class="far fa-bell fs-5 text-secondary"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-end d-none d-md-block me-2">
                    <p class="m-0 small fw-bold lh-1" style="color: var(--gov-navy-primary);">Blantyre Admin</p>
                    <span class="text-muted extra-small" style="font-size: 0.725rem;">Super Administrative Principal</span>
                </div>
                <div class="rounded-circle avatar-seal d-flex align-items-center justify-content-center">
                    BA
                </div>
            </div>
        </div>
    </div>

    <main class="main-content">
        <?= view("admin/" . $page) ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarMenu');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>