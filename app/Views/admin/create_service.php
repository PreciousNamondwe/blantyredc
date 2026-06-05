<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service - Blantyre District Council</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #0ea5e9;
            --body-bg: #f8fafc;
        }

        body {
            background-color: var(--body-bg);
            font-family: system-ui, -apple-system, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: var(--sidebar-hover);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--sidebar-active);
        }

        .sidebar .nav-link .link-content {
            display: flex;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem;
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
        }

        .form-control, .form-select {
            padding: 0.6rem 0.75rem;
            border-color: #cbd5e1;
            border-radius: 0.375rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.15);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <div class="px-2 py-3 mb-4 border-bottom border-secondary">
                    <h5 class="text-white mb-0 fw-bold"><i class="fas fa-landmark me-2 text-info"></i>Blantyre DC</h5>
                    <small class="text-muted">Admin Panel</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                            <span class="link-content"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#applicationsCollapse" role="button" aria-expanded="false" aria-controls="applicationsCollapse">
                            <span class="link-content"><i class="fas fa-file-alt me-2"></i>Applications</span>
                            <i class="fas fa-chevron-down opacity-50 small"></i>
                        </a>
                        <div class="collapse" id="applicationsCollapse">
                            <ul class="nav flex-column ms-3 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= base_url('admin/applications'); ?>">All Applications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= base_url('admin/business-applications'); ?>">Business Applications</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#councilCollapse" role="button" aria-expanded="false" aria-controls="councilCollapse">
                            <span class="link-content"><i class="fas fa-users-cog me-2"></i>Council</span>
                            <i class="fas fa-chevron-down opacity-50 small"></i>
                        </a>
                        <div class="collapse" id="councilCollapse">
                            <ul class="nav flex-column ms-3 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= base_url('admin/officials'); ?>">Elected Officials</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= base_url('admin/management'); ?>">Management</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/services') ?>">
                            <span class="link-content"><i class="fas fa-cogs me-2"></i>Services</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/projects') ?>">
                            <span class="link-content"><i class="fas fa-project-diagram me-2"></i>Projects</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/news') ?>">
                            <span class="link-content"><i class="fas fa-newspaper me-2"></i>News</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/notifications') ?>">
                            <span class="link-content"><i class="fas fa-bell me-2"></i>Notifications</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">
                            <span class="link-content"><i class="fas fa-users me-2"></i>Users</span>
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4 border-top border-secondary pt-3">
                        <a class="nav-link text-danger" href="<?= base_url('logout') ?>">
                            <span class="link-content"><i class="fas fa-sign-out-alt me-2"></i>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <main class="col-md-10 ms-sm-auto px-4 py-4">
                <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                    <div>
                        <h1 class="h3 mb-0 fw-bold text-slate-800">Create New Service</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 mt-1 small">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>" class="text-decoration-none">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/services') ?>" class="text-decoration-none">Services</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="<?= base_url('admin/services') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Back to Services
                    </a>
                </div>

                <div class="row">
                    <div class="col-xl-9 col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-info-circle me-2 text-primary"></i>Service Details Form</h5>
                            </div>
                            <div class="card-body p-4">
                                <?php if (session()->has('errors')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following issues:</h6>
                                    <ul class="mb-0 ps-3">
                                        <?php foreach (session('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>

                                <?php if (session()->has('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php endif; ?>

                                <form method="POST" action="<?= base_url('admin/services/create') ?>">
                                    <?= csrf_field() ?>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="service_key" class="form-label">Service Key <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="service_key" name="service_key" value="<?= old('service_key') ?>" placeholder="e.g. business_permit" required>
                                            <div class="form-text small">Unique system identifier (lowercase letters and underscores only).</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="service_name" class="form-label">Service Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="service_name" name="service_name" value="<?= old('service_name') ?>" placeholder="e.g. Business Renewal Permit" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Briefly outline what this service entails..."><?= old('description') ?></textarea>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                                            <select class="form-select" id="department" name="department" required>
                                                <option value="">Select Department</option>
                                                <?php 
                                                $departments = ['Administration', 'Agriculture', 'Education', 'Health', 'Finance', 'Planning', 'Legal', 'IT'];
                                                foreach($departments as $dept): ?>
                                                    <option value="<?= $dept ?>" <?= old('department') == $dept ? 'selected' : '' ?>><?= $dept ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="fee_amount" class="form-label">Fee Amount (MWK) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">MK</span>
                                                <input type="number" class="form-control" id="fee_amount" name="fee_amount" value="<?= old('fee_amount', '0.00') ?>" min="0" step="0.01" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="processing_days" class="form-label">Processing Days <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="processing_days" name="processing_days" value="<?= old('processing_days', '5') ?>" min="1" required>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4 align-items-center">
                                        <div class="col-md-6">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?= old('sort_order', '0') ?>" min="0">
                                            <div class="form-text small">Controls catalog positioning (lower numbers float to top).</div>
                                        </div>
                                        <div class="col-md-6 shadow-sm-sm">
                                            <div class="form-check p-3 bg-light rounded border border-dashed ms-2 mt-3">
                                                <input class="form-check-input ms-0 me-2" type="checkbox" id="is_active" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold text-slate-700" for="is_active">
                                                    Publish & Activate Service
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="text-slate-200 my-4">

                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="<?= base_url('admin/services') ?>" class="btn btn-light px-4 border">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-save me-2"></i>Save Service
                                        </button>
                                    </div>
                                </form>
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