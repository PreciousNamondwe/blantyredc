<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background: #0f172a; /* Sleek Dark Slate */
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
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
            background: #0284c7; /* Vibrant accent color */
        }

        .submenu .nav-link {
            padding-left: 2.5rem;
            font-size: 0.9rem;
        }

        /* Main Content Adjustment due to fixed sidebar */
        .main-content {
            margin-left: 16.666667%; /* Matches col-md-2 width */
            padding: 2rem !important;
        }

        @media (max-width: 768px) {
            .sidebar { position: static; min-height: auto; }
            .main-content { margin-left: 0; }
        }

        /* Dashboard Components & Cards */
        .dashboard-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.02);
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

        /* Stat Grid Elements */
        .stat-mini-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }

        .stat-mini-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Form Styling Enhancements */
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 1px solid #cbd5e1;
            padding: 0.6rem 0.75rem;
            border-radius: 0.375rem;
            color: #334155;
            font-size: 0.95rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .form-text {
            color: #64748b;
            font-size: 0.825rem;
        }

        /* Buttons */
        .btn {
            font-weight: 500;
            padding: 0.55rem 1.25rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: #0284c7;
            border-color: #0284c7;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #0369a1;
            border-color: #0369a1;
        }

        .btn-secondary {
            background-color: #64748b;
            border-color: #64748b;
            color: #fff;
        }

        .btn-secondary:hover, .btn-secondary:focus {
            background-color: #475569;
            border-color: #475569;
        }

        .btn-outline-secondary {
            color: #64748b;
            border-color: #cbd5e1;
        }

        .btn-outline-secondary:hover {
            background-color: #f1f5f9;
            color: #334155;
            border-color: #cbd5e1;
        }

        a {
            color: #0284c7;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
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
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#applicationsCollapse" role="button" aria-expanded="false" aria-controls="applicationsCollapse">
                            <span><i class="fas fa-file-invoice main-icon me-2"></i>Applications</span>
                            <i class="fas fa-chevron-down font-size-sm text-muted"></i>
                        </a>
                        <div class="collapse submenu" id="applicationsCollapse">
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/applications'); ?>">All Applications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/business-applications'); ?>">Business Apps</a>
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
                        <a class="nav-link active" href="<?= base_url('admin/services') ?>">
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

            <main class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-1">Edit Service</h2>
                        <p class="text-muted small mb-0">Blantyre District Council Management System</p>
                    </div>
                    <div>
                        <a href="<?= base_url('admin/services') ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Services
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card dashboard-card mb-4">
                            <div class="card-header">
                                <i class="fas fa-edit text-muted me-2"></i>Edit Service Information
                            </div>
                            <div class="card-body">
                                <?php if (session()->has('errors')): ?>
                                <div class="alert alert-danger border-0 shadow-sm mb-4">
                                    <ul class="mb-0">
                                        <?php foreach (session('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                <?php if (session()->has('success')): ?>
                                <div class="alert alert-success border-0 shadow-sm mb-4">
                                    <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
                                </div>
                                <?php endif; ?>

                                <form method="POST" action="<?= base_url('admin/services/' . $service['id'] . '/edit') ?>">
                                    <?= csrf_field() ?>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="service_key" class="form-label">Service Key <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="service_key" name="service_key" value="<?= old('service_key', $service['service_key']) ?>" required>
                                            <div class="form-text">Unique identifier for the service (e.g., birth_certificate)</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="service_name" class="form-label">Service Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="service_name" name="service_name" value="<?= old('service_name', $service['service_name']) ?>" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4"><?= old('description', $service['description']) ?></textarea>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-4">
                                            <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                            <select class="form-select" id="department" name="department" required>
                                                <option value="">Select Department</option>
                                                <option value="Administration" <?= old('department', $service['department']) == 'Administration' ? 'selected' : '' ?>>Administration</option>
                                                <option value="Agriculture" <?= old('department', $service['department']) == 'Agriculture' ? 'selected' : '' ?>>Agriculture</option>
                                                <option value="Education" <?= old('department', $service['department']) == 'Education' ? 'selected' : '' ?>>Education</option>
                                                <option value="Health" <?= old('department', $service['department']) == 'Health' ? 'selected' : '' ?>>Health</option>
                                                <option value="Finance" <?= old('department', $service['department']) == 'Finance' ? 'selected' : '' ?>>Finance</option>
                                                <option value="Planning" <?= old('department', $service['department']) == 'Planning' ? 'selected' : '' ?>>Planning</option>
                                                <option value="Legal" <?= old('department', $service['department']) == 'Legal' ? 'selected' : '' ?>>Legal</option>
                                                <option value="IT" <?= old('department', $service['department']) == 'IT' ? 'selected' : '' ?>>IT</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fee_amount" class="form-label">Fee Amount (MWK) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="fee_amount" name="fee_amount" value="<?= old('fee_amount', $service['fee_amount']) ?>" min="0" step="0.01" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="processing_days" class="form-label">Processing Days <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="processing_days" name="processing_days" value="<?= old('processing_days', $service['processing_days']) ?>" min="1" required>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4 align-items-center">
                                        <div class="col-md-6">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?= old('sort_order', $service['sort_order']) ?>" min="0">
                                            <div class="form-text">Order for displaying services (lower numbers appear first)</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= old('is_active', $service['is_active']) ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-medium text-slate-700" for="is_active">
                                                    Active Service Status
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 border-top pt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Update Service
                                        </button>
                                        <a href="<?= base_url('admin/services') ?>" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card dashboard-card">
                            <div class="card-header">
                                <i class="fas fa-chart-bar text-muted me-2"></i>Service Statistics Overview
                            </div>
                            <div class="card-body">
                                <div class="row g-3 text-center mb-3">
                                    <div class="col-6 col-md-4 col-xl-2">
                                        <div class="stat-mini-box">
                                            <div class="text-muted small fw-medium mb-1">Total Apps</div>
                                            <h4 class="fw-bold mb-0 text-primary"><?= $service['total_applications'] ?? 0 ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 col-xl-2">
                                        <div class="stat-mini-box">
                                            <div class="text-muted small fw-medium mb-1">Approved</div>
                                            <h4 class="fw-bold mb-0 text-success"><?= $service['approved_applications'] ?? 0 ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 col-xl-2">
                                        <div class="stat-mini-box">
                                            <div class="text-muted small fw-medium mb-1">Pending</div>
                                            <h4 class="fw-bold mb-0 text-warning"><?= $service['pending_applications'] ?? 0 ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 col-xl-2">
                                        <div class="stat-mini-box">
                                            <div class="text-muted small fw-medium mb-1">Rejected</div>
                                            <h4 class="fw-bold mb-0 text-danger"><?= $service['rejected_applications'] ?? 0 ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 col-xl-2">
                                        <div class="stat-mini-box">
                                            <div class="text-muted small fw-medium mb-1">Revenue</div>
                                            <h4 class="fw-bold mb-0 text-info text-truncate fs-5">MWK <?= number_format($service['total_revenue'] ?? 0, 2) ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 col-xl-2">
                                        <div class="stat-mini-box">
                                            <div class="text-muted small fw-medium mb-1">Avg Process</div>
                                            <h4 class="fw-bold mb-0 text-secondary"><?= $service['avg_processing_days'] ?? 0 ?> Days</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2 text-muted small border-top g-2">
                                    <div class="col-sm-6">
                                        <span><i class="far fa-calendar-plus me-1"></i> <strong>Created:</strong> <?= date('M d, Y H:i', strtotime($service['created_at'])) ?></span>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <span><i class="far fa-calendar-check me-1"></i> <strong>Last Updated:</strong> <?= date('M d, Y H:i', strtotime($service['updated_at'] ?? $service['created_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>