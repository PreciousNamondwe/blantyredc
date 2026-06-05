<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Management Member - Blantyre District Council</title>
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
        
        .submenu .nav-link.active-sub {
            color: #fff;
            font-weight: 600;
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

        /* Card and Panel Elements Styling */
        .form-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.02);
            background: #fff;
        }

        .form-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .form-card .card-body {
            padding: 2rem;
        }

        /* Form Input Enhancements */
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            padding: 0.625rem 0.85rem;
            font-size: 0.95rem;
            color: #1e293b;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }

        .form-text {
            color: #64748b;
            font-size: 0.825rem;
        }

        /* Button Styling overrides */
        .btn {
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: #0284c7;
            border-color: #0284c7;
        }

        .btn-primary:hover {
            background-color: #0369a1;
            border-color: #0369a1;
        }

        .btn-secondary {
            background-color: #64748b;
            border-color: #64748b;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #475569;
            border-color: #475569;
        }

        .badge {
            font-weight: 500;
            padding: 0.4em 0.65em;
            border-radius: 0.375rem;
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#councilCollapse" role="button" aria-expanded="true" aria-controls="councilCollapse">
                            <span><i class="fas fa-landmark main-icon me-2"></i>Council</span>
                            <i class="fas fa-chevron-down text-muted"></i>
                        </a>
                        <div class="collapse show submenu" id="councilCollapse">
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/officials'); ?>">Elected Officials</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active active-sub" href="<?= base_url('admin/management'); ?>">Management</a>
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
                        <h2 class="fw-bold text-slate-800 mb-1">Add Management Member</h2>
                        <p class="text-muted small mb-0">Create a leadership profile and upload a photo entry context.</p>
                    </div>
                    <div>
                        <a href="<?= base_url('admin/management') ?>" class="btn btn-secondary btn-sm d-flex align-items-center">
                            <i class="fas fa-arrow-left me-2"></i>Back to Management
                        </a>
                    </div>
                </div>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger shadow-sm border-start border-4 rounded-3">
                        <ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger shadow-sm border-start border-4 rounded-3"><?= esc(session()->getFlashdata('error')) ?></div>
                <?php endif; ?>

                <div class="card form-card">
                    <div class="card-header">
                        <i class="fas fa-user-plus text-muted me-2"></i>Personnel Information
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('admin/management/create') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required placeholder="e.g. John Doe">
                            </div>
                            
                            <div class="mb-4">
                                <label for="position" class="form-label">Official Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" name="position" value="<?= old('position') ?>" placeholder="District Commissioner, Director of Finance, etc." required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="name@blantyredc.gov.mw">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label">Contact Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone') ?>" placeholder="e.g. +265...">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="bio" class="form-label">Biography / Profile Summary</label>
                                <textarea name="bio" id="bio" rows="4" class="form-control" placeholder="Brief statement regarding credentials, responsibilities or professional focus..."><?= old('bio') ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="photo" class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png,image/jpg">
                                <div class="form-text mt-2"><i class="fas fa-info-circle me-1"></i>Upload high-quality corporate JPG or PNG images up to 5MB.</div>
                            </div>
                            
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?>>
                                <label class="form-check-label fw-medium text-slate-700" for="is_active">Publish Status (Active Profile)</label>
                            </div>
                            
                            <hr class="text-muted opacity-25 my-4">

                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Save Member Profile</button>
                        </form>
                    </div>
                </div>

            </div> 
        </div> 
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>