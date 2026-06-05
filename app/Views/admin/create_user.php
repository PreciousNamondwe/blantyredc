<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Sidebar Styling (Matches Dashboard Layout) */
        .sidebar {
            min-height: 100vh;
            background: #0f172a; 
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
            background: #0284c7; 
        }

        .submenu .nav-link {
            padding-left: 2.5rem;
            font-size: 0.9rem;
        }

        /* Main Content Offset */
        .main-content {
            margin-left: 16.666667%;
            padding: 2rem !important;
        }

        @media (max-width: 768px) {
            .sidebar { position: static; min-height: auto; }
            .main-content { margin-left: 0; }
        }

        /* Card Customization */
        .dashboard-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 4px 6px -1px rgba(0,0,0,0.02);
            background: #fff;
        }

        .dashboard-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }
        
        /* Modernized Form Inputs */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.4rem;
        }
        
        .form-control, .form-select {
            border-color: #cbd5e1;
            padding: 0.6rem 0.85rem;
            font-size: 0.95rem;
            border-radius: 0.375rem;
            color: #1e293b;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }
        
        .form-text {
            color: #94a3b8;
            font-size: 0.8rem;
            margin-top: 0.35rem;
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
                            <i class="fas fa-chevron-down text-muted"></i>
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
                        <a class="nav-link active" href="<?= base_url('admin/users') ?>">
                            <span><i class="fas fa-users main-icon me-2"></i>Users</span>
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4 pt-3 border-top border-secondary">
                        <a class="nav-link" href="<?= base_url('logout') ?>">
                            <span><i class="fas fa-sign-out-alt main-icon me-2 text-danger"></i>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 main-content">
                
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-1">Create New User</h2>
                        <p class="text-muted small mb-0">Register structural directory accounts for internal management nodes</p>
                    </div>
                    <div>
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary px-3 py-2 shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Users
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card dashboard-card">
                            <div class="card-header bg-white">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-plus text-primary me-2"></i>
                                    <h5 class="mb-0 fw-semibold">User Authentication Profile Details</h5>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                
                                <?php if (session()->has('errors')): ?>
                                <div class="alert alert-danger border-0 shadow-sm d-flex align-items-start p-3 mb-4">
                                    <i class="fas fa-circle-xmark mt-1 me-3 fs-5"></i>
                                    <ul class="mb-0 ps-0 list-unstyled">
                                        <?php foreach (session('errors') as $error): ?>
                                        <li class="fw-medium small"><?= esc($error) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                <?php if (session()->has('success')): ?>
                                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center p-3 mb-4">
                                    <i class="fas fa-circle-check me-3 fs-5"></i>
                                    <span class="fw-medium small"><?= session('success') ?></span>
                                </div>
                                <?php endif; ?>

                                <form method="POST" action="<?= base_url('admin/users/create') ?>" class="needs-validation" novalidate>
                                    <?= csrf_field() ?>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= old('first_name') ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= old('last_name') ?>" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
                                        <div class="form-text">Unique entry attribute required to handle interface session checks.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                                        <div class="form-text">Active destination module intended for secure platform messaging pipelines.</div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" value="<?= old('phone') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="department" class="form-label">Department</label>
                                            <select class="form-select" id="department" name="department">
                                                <option value="">Select Department</option>
                                                <option value="Administration" <?= old('department') == 'Administration' ? 'selected' : '' ?>>Administration</option>
                                                <option value="Agriculture" <?= old('department') == 'Agriculture' ? 'selected' : '' ?>>Agriculture</option>
                                                <option value="Education" <?= old('department') == 'Education' ? 'selected' : '' ?>>Education</option>
                                                <option value="Health" <?= old('department') == 'Health' ? 'selected' : '' ?>>Health</option>
                                                <option value="Finance" <?= old('department') == 'Finance' ? 'selected' : '' ?>>Finance</option>
                                                <option value="Planning" <?= old('department') == 'Planning' ? 'selected' : '' ?>>Planning</option>
                                                <option value="Legal" <?= old('department') == 'Legal' ? 'selected' : '' ?>>Legal</option>
                                                <option value="IT" <?= old('department') == 'IT' ? 'selected' : '' ?>>IT</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="">Select Role</option>
                                            <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="department_head" <?= old('role') == 'department_head' ? 'selected' : '' ?>>Department Head</option>
                                            <option value="staff" <?= old('role') == 'staff' ? 'selected' : '' ?>>Staff</option>
                                            <option value="reviewer" <?= old('role') == 'reviewer' ? 'selected' : '' ?>>Reviewer</option>
                                        </select>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <div class="form-text">Minimum length constraints require at least 8 alphanumeric elements.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="mb-4 bg-light p-3 rounded border">
                                        <div class="form-check form-switch m-0 d-flex align-items-center">
                                            <input class="form-check-input style-switch" type="checkbox" role="switch" id="is_active" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?> style="width: 2.5em; height: 1.25em; cursor: pointer;">
                                            <label class="form-check-label fw-semibold text-dark ms-3" for="is_active" style="cursor: pointer;">
                                                Grant Active Status Immediately
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 pt-2 border-top">
                                        <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                            <i class="fas fa-save me-2"></i>Create User
                                        </button>
                                        <a href="<?= base_url('admin/users') ?>" class="btn btn-light border text-secondary px-4 py-2">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password confirmation verification validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>