<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Licence Applications - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Fixed Left Sidebar Design */
        .sidebar {
            min-height: 100vh;
            background: #0f172a; /* Sleek Slate Dark */
            box-shadow: 4px 0 10px rgba(0,0,0,0.03);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #1e293b;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar .nav-link i.main-icon {
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover { 
            color: #fff; 
            background: #1e293b; 
        }

        .sidebar .nav-link.active { 
            color: #fff; 
            background: #0284c7; /* Sky blue branding focus color */
        }

        .submenu .nav-link {
            padding-left: 2.5rem;
            font-size: 0.9rem;
        }

        /* Offset viewport spacing from sidebar */
        .main-content {
            margin-left: 16.666667%; 
            padding: 2.5rem !important;
        }

        @media (max-width: 768px) {
            .sidebar { position: static; min-height: auto; }
            .main-content { margin-left: 0; padding: 1.5rem !important; }
        }

        /* Clean Card Design Elements */
        .dashboard-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            background: #fff;
        }

        .dashboard-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .dashboard-card .card-body {
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.875rem;
        }

        .form-control, .form-select {
            border-color: #cbd5e1;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.15);
        }

        /* Table Styling Overhaul */
        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            background-color: #f8fafc !important;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem 0.75rem;
        }

        .table td {
            vertical-align: middle;
            color: #334155;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Subtle tone action rows */
        .btn-group .btn {
            padding: 0.4rem 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Clean Status pill layout mapping */
        .badge {
            font-weight: 600;
            padding: 0.45em 0.75em;
            border-radius: 0.375rem;
        }
        .bg-badge-submitted { background-color: #fef3c7; color: #d97706; }
        .bg-badge-review { background-color: #e0f2fe; color: #0369a1; }
        .bg-badge-approved { background-color: #dcfce7; color: #15803d; }
        .bg-badge-rejected { background-color: #fee2e2; color: #b91c1c; }
        .bg-badge-completed { background-color: #e0e7ff; color: #4338ca; }
        .bg-badge-cancelled { background-color: #f1f5f9; color: #475569; }
        .bg-badge-default { background-color: #f4f4f5; color: #52525b; }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-2 sidebar p-3">
                <div class="sidebar-brand mb-4">
                    <h5 class="text-white m-0 d-flex align-items-center">
                        <i class="fas fa-layer-group text-info me-2"></i>
                        <span>Admin Panel</span>
                    </h5>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                            <span><i class="fas fa-columns main-icon me-2"></i>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#applicationsCollapse" role="button" aria-expanded="true" aria-controls="applicationsCollapse">
                            <span><i class="fas fa-file-invoice main-icon me-2"></i>Applications</span>
                            <i class="fas fa-chevron-down font-size-sm text-muted"></i>
                        </a>
                        <div class="collapse show submenu" id="applicationsCollapse">
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/applications'); ?>">All Applications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= base_url('admin/business-applications'); ?>">Business Apps</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#councilCollapse" role="button" aria-expanded="false" aria-controls="councilCollapse">
                            <span><i class="fas fa-landmark main-icon me-2"></i>Council</span>
                            <i class="fas fa-chevron-down text-muted"></i>
                        </a>
                        <div class="collapse submenu" id="councilCollapse">
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/officials'); ?>">Elected Officials</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/management'); ?>">Management</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/services') ?>">
                            <span><i class="fas fa-briefcase main-icon me-2"></i>Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/projects') ?>">
                            <span><i class="fas fa-project-diagram main-icon me-2"></i>Projects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/news') ?>">
                            <span><i class="fas fa-newspaper main-icon me-2"></i>News</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/notifications') ?>">
                            <span><i class="fas fa-bell main-icon me-2"></i>Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">
                            <span><i class="fas fa-users main-icon me-2"></i>Users</span>
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4 pt-3 border-top border-secondary">
                        <a class="nav-link text-danger-hover" href="<?= base_url('logout') ?>">
                            <span><i class="fas fa-sign-out-alt main-icon me-2 text-danger"></i>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 main-content">
                
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Business Licence Applications</h2>
                        <p class="text-muted small mb-0">Blantyre District Council Management System</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('admin/business-types/create') ?>" class="btn btn-sm btn-primary px-3 py-2">
                            <i class="fas fa-plus me-2"></i>Add Business Type
                        </a>
                        <a href="<?= base_url('admin/business-types') ?>" class="btn btn-sm btn-outline-info px-3 py-2">
                            <i class="fas fa-tags me-2"></i>Manage Business Types
                        </a>
                        <a href="<?= base_url('admin/applications') ?>" class="btn btn-sm btn-outline-secondary px-3 py-2">
                            <i class="fas fa-list me-2"></i>All Applications
                        </a>
                    </div>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success border-0 shadow-sm mb-4"><?= esc(session()->getFlashdata('success')) ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger border-0 shadow-sm mb-4"><?= esc(session()->getFlashdata('error')) ?></div>
                <?php endif; ?>

                <div class="card dashboard-card mb-4">
                    <div class="card-body">
                        <form method="get" class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="status" class="form-label">Status Filter</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <?php foreach (['submitted', 'under_review', 'approved', 'rejected', 'completed', 'cancelled'] as $status): ?>
                                        <option value="<?= $status ?>" <?= $filters['status'] === $status ? 'selected' : '' ?>>
                                            <?= esc(ucfirst(str_replace('_', ' ', $status))) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="search" class="form-label">Search Query</label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search reference number or entry data..." value="<?= esc($filters['search'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 d-flex">
                                <button type="submit" class="btn btn-primary px-4 me-2 w-100">
                                    <i class="fas fa-search me-2"></i>Apply Filter
                                </button>
                                <a href="<?= base_url('admin/business-applications') ?>" class="btn btn-outline-secondary px-3">
                                    <i class="fas fa-undo"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card dashboard-card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;" class="ps-4">Reference</th>
                                        <th style="width: 25%;">Applicant Info</th>
                                        <th style="width: 25%;">Business Identity</th>
                                        <th style="width: 15%;">Status</th>
                                        <th style="width: 10%;">Submitted</th>
                                        <th style="width: 10%;" class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($applications)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5">
                                                <i class="fas fa-folder-open fa-2x mb-3 d-block text-slate-300"></i>
                                                No business licence records match selected criteria.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php foreach ($applications as $app): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <span class="text-dark fw-bold"><?= esc($app['reference_number']) ?></span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark"><?= esc($app['applicant_name'] ?? 'Not provided') ?></div>
                                                <?php if (!empty($app['applicant_phone'])): ?>
                                                    <span class="text-muted small"><i class="fas fa-phone-alt me-1 font-size-xs"></i><?= esc($app['applicant_phone']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark"><?= esc($app['business_name'] ?? 'Not provided') ?></div>
                                                <?php if (!empty($app['business_type'])): ?>
                                                    <span class="badge bg-light text-secondary border font-size-xs"><?= esc($app['business_type']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-badge-<?= match($app['status']) {
                                                    'draft' => 'default',
                                                    'submitted' => 'submitted',
                                                    'under_review' => 'review',
                                                    'approved' => 'approved',
                                                    'rejected' => 'rejected',
                                                    'completed' => 'completed',
                                                    'cancelled' => 'cancelled',
                                                    default => 'default'
                                                } ?>">
                                                    <i class="fas fa-circle me-1" style="font-size: 6px; vertical-align: middle;"></i>
                                                    <?= esc(ucfirst(str_replace('_', ' ', $app['status']))) ?>
                                                </span>
                                            </td>
                                            <td class="text-muted small">
                                                <?= date('M j, Y', strtotime($app['created_at'])) ?>
                                                <div style="font-size: 11px;" class="text-slate-400"><?= date('H:i', strtotime($app['created_at'])) ?></div>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group shadow-sm">
                                                    <a href="<?= base_url('admin/applications/' . $app['id']) ?>" class="btn btn-sm btn-white border-end" title="View Details">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </a>
                                                    <a href="<?= base_url('admin/business-applications/' . $app['id'] . '/edit') ?>" class="btn btn-sm btn-white border-end" title="Edit Application">
                                                        <i class="fas fa-edit text-success"></i>
                                                    </a>
                                                    <a href="<?= base_url('admin/business-applications/' . $app['id'] . '/print') ?>?print=1" class="btn btn-sm btn-white border-end" target="_blank" title="Generate PDF">
                                                        <i class="fas fa-file-pdf text-dark"></i>
                                                    </a>
                                                    <form action="<?= base_url('admin/business-applications/' . $app['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this business application permanently?');">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-sm btn-white" title="Delete Permanent">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php if ($pager->getPageCount() > 1): ?>
                            <div class="d-flex justify-content-center py-4 border-top">
                                <?= $pager->links() ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>