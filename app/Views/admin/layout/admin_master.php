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
            --bg-main: #f8fafc;
            --sidebar-bg: #0f172a;
            --sidebar-border: #1e293b;
            --text-muted: #94a3b8;
            --text-dark: #334155;
            --accent-primary: #0284c7; /* Vibrant UI Accent Blue */
            --accent-hover: #1e293b;
            --danger-soft: #ef4444;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Responsive Sidebar */
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
            padding: 1.5rem;
            border-bottom: 1px solid var(--sidebar-border);
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
        }

        .sidebar .nav {
            padding: 1rem;
        }

        .sidebar .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.925rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 0.35rem;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link i.main-icon {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover { 
            color: #fff; 
            background: var(--accent-hover); 
        }

        .sidebar .nav-link:hover i.main-icon {
            transform: scale(1.05);
        }

        .sidebar .nav-link.active { 
            color: #fff; 
            background: var(--accent-primary);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        .sidebar .nav-link.active i.main-icon {
            color: #fff !important;
        }
        
        .text-danger-hover:hover {
            background: rgba(239, 68, 68, 0.1) !important;
            color: var(--danger-soft) !important;
        }

        /* Top Navbar (For Mobile/Actions) */
        .top-navbar {
            margin-left: var(--sidebar-width);
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Main Content Workspace */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        /* Modernized Component Placeholders matching UI design */
        .stat-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            transition: all 0.2s ease;
            background: #fff;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }

        .dashboard-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            background: #fff;
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
            <h5 class="text-white m-0 d-flex align-items-center">
                <i class="fas fa-layer-group text-info me-2"></i>
                <span class="fw-semibold">Admin Panel</span>
            </h5>
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
            
            <li class="nav-item mt-4 pt-3 border-top border-secondary">
                <a class="nav-link text-danger-hover" href="<?= base_url('logout') ?>">
                    <i class="fas fa-sign-out-alt main-icon text-danger"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="top-navbar d-flex justify-content-between align-items-center">
        <button class="btn btn-light d-lg-none me-2" type="button" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="d-none d-sm-flex align-items-center">
            <h4 class="m-0 fw-bold text-dark text-capitalize"><?= esc($page ?? 'Dashboard') ?></h4>
        </div>
        
        <div class="d-flex align-items-center gap-3 ms-auto">
            <div class="position-relative cursor-pointer me-2">
                <i class="far fa-bell fs-5 text-secondary"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-end d-none d-md-block me-2">
                    <p class="m-0 small fw-bold lh-1">Blantyre Admin</p>
                    <span class="text-muted extra-small" style="font-size: 0.75rem;">Super Admin</span>
                </div>
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 600;">
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
        // Simple and robust mobile toggle wrapper 
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarMenu');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>