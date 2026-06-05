<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Official - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        /* Sidebar Styling matching the Slate Aesthetic */
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
        
        .sidebar .nav-link div {
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i.main-icon {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
        }

        .sidebar .nav-link:hover { 
            color: #fff; 
            background: #1e293b; 
        }

        .sidebar .nav-link.active { 
            color: #fff; 
            background: #0284c7; /* Vibrant active accent blue */
        }

        /* Dropdown Sub-menus */
        .sidebar .collapse .nav-link {
            padding-left: 2.25rem;
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Fixed structural layout offsets */
        .main-content {
            margin-left: 16.666667%; /* Exactly counters col-md-2 */
            padding: 2rem !important;
        }

        @media (max-width: 768px) {
            .sidebar { position: static; min-height: auto; }
            .main-content { margin-left: 0; }
        }

        /* Card Elements */
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

        /* Typography & Form Controls */
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

        .form-check-input:checked {
            background-color: #0284c7;
            border-color: #0284c7;
        }

        .form-text, .text-muted {
            color: #64748b !important;
            font-size: 0.825rem;
        }

        /* Fine-tuned buttons */
        .btn {
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-success {
            background-color: #10b981;
            border-color: #10b981;
        }

        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
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

        .alert {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar Layout Navigation -->
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
                            <div><i class="fas fa-columns main-icon"></i>Dashboard</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#applicationsCollapse" role="button" aria-expanded="false" aria-controls="applicationsCollapse">
                            <div><i class="fas fa-file-invoice main-icon"></i>Applications</div>
                            <i class="fas fa-chevron-down small text-muted"></i>
                        </a>
                        <div class="collapse" id="applicationsCollapse">
                            <ul class="nav flex-column">
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
                        <a class="nav-link active" data-bs-toggle="collapse" href="#councilCollapse" role="button" aria-expanded="true" aria-controls="councilCollapse">
                            <div><i class="fas fa-landmark main-icon"></i>Council</div>
                            <i class="fas fa-chevron-down small text-white"></i>
                        </a>
                        <div class="collapse show" id="councilCollapse">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= base_url('admin/officials'); ?>">Elected Officials</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/management'); ?>">Management</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/services') ?>">
                            <div><i class="fas fa-cogs main-icon"></i>Services</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/projects') ?>">
                            <div><i class="fas fa-project-diagram main-icon"></i>Projects</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/news') ?>">
                            <div><i class="fas fa-newspaper main-icon"></i>News</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/notifications') ?>">
                            <div><i class="fas fa-bell main-icon"></i>Notifications</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">
                            <div><i class="fas fa-users main-icon"></i>Users</div>
                        </a>
                    </li>
                    <li class="nav-item mt-4 pt-3 border-top border-secondary">
                        <a class="nav-link text-danger-hover" href="<?= base_url('logout') ?>">
                            <div><i class="fas fa-sign-out-alt main-icon text-danger"></i>Logout</div>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Workspace View Content Module -->
            <main class="col-md-10 main-content">
                
                <!-- Page Main Header Block Area -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-1">Add New Official</h2>
                        <p class="text-muted small mb-0">Create a new elected official profile record and upload their directory photo.</p>
                    </div>
                    <div>
                        <a href="<?= base_url('admin/officials') ?>" class="btn btn-secondary btn-sm d-flex align-items-center">
                            <i class="fas fa-arrow-left me-2"></i>Back to Officials
                        </a>
                    </div>
                </div>

                <!-- Server Side Validation Summary Notifications -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success shadow-sm border-start border-4 border-success mb-4">
                        <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger shadow-sm border-start border-4 border-danger mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger shadow-sm border-start border-4 border-danger mb-4">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Document Form Panel Container -->
                <div class="card form-card">
                    <div class="card-header">
                        <i class="fas fa-user-plus text-muted me-2"></i>Official Profile Editor
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('admin/officials/create') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" placeholder="e.g. Hon. John Phiri" required>
                            </div>

                            <div class="mb-4">
                                <label for="position" class="form-label">Council Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" name="position" value="<?= old('position') ?>" list="officialPositions" placeholder="Select or type a position" required>
                                <datalist id="officialPositions">
                                    <option value="Member of Parliament">
                                    <option value="Ward Councilor">
                                    <option value="Council Chair">
                                </datalist>
                            </div>

                            <div class="mb-4">
                                <label for="department" class="form-label">Constituency / Ward / Department</label>
                                <input type="text" class="form-control" id="department" name="department" value="<?= old('department') ?>" placeholder="e.g. Blantyre North, Linjidzi Ward">
                            </div>

                            <div class="mb-4">
                                <label for="bio" class="form-label">Brief Biography</label>
                                <textarea name="bio" id="bio" rows="4" class="form-control" placeholder="Short professional background statement displayed on the public registry page..."><?= old('bio') ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="photo" class="form-label">Official Portrait Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png,image/jpg">
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle me-1"></i>Please select a high-quality vertical portrait. Supported formats: JPG, PNG (Max 5MB).
                                </div>
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?> />
                                <label class="form-check-label form-label mb-0 ms-2" for="is_active">Publish Status (Active Profile)</label>
                            </div>
                            
                            <hr class="text-muted opacity-25 my-4">

                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>Save Official Record
                            </button>
                        </form>
                    </div>
                </div>
                
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>