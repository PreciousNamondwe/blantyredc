<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News - Blantyre District Council</title>
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
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover { 
            color: #fff; 
            background: #1e293b; 
        }

        .sidebar .nav-link.active { 
            color: #fff; 
            background: #0284c7; /* Vibrant active accent blue */
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
                            <i class="fas fa-columns me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/applications') ?>">
                            <i class="fas fa-file-invoice me-2"></i>Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/business-applications') ?>">
                            <i class="fas fa-briefcase me-2"></i>Business Apps
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/services') ?>">
                            <i class="fas fa-cogs me-2"></i>Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/projects') ?>">
                            <i class="fas fa-project-diagram me-2"></i>Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/news') ?>">
                            <i class="fas fa-newspaper me-2"></i>News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/notifications') ?>">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">
                            <i class="fas fa-users me-2"></i>Users
                        </a>
                    </li>
                    <li class="nav-item mt-4 pt-3 border-top border-secondary">
                        <a class="nav-link text-danger-hover" href="<?= base_url('logout') ?>">
                            <i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Workspace View Content Module -->
            <main class="col-md-10 main-content">
                
                <!-- Page Main Header Block Area -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h2 class="fw-bold text-slate-800 mb-1">Add News Article</h2>
                        <p class="text-muted small mb-0">Publish media alerts, notices, and press releases for the district.</p>
                    </div>
                    <div>
                        <a href="<?= base_url('admin/news') ?>" class="btn btn-secondary btn-sm d-flex align-items-center">
                            <i class="fas fa-arrow-left me-2"></i>Back to News
                        </a>
                    </div>
                </div>

                <!-- Server Side Validation Summary Notifications -->
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger shadow-sm border-start border-4 border-danger mb-4">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Document Form Panel Container -->
                <div class="card form-card">
                    <div class="card-header">
                        <i class="fas fa-edit text-muted me-2"></i>Article Editor
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('admin/news/create') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            
                            <div class="mb-4">
                                <label class="form-label">Headline / Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="<?= old('title') ?>" placeholder="e.g. Blantyre District Unveils Strategic Road Maintenance Program" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">News Content <span class="text-danger">*</span></label>
                                <textarea name="content" rows="8" class="form-control" placeholder="Write the complete news body details here..." required><?= old('content') ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">News Gallery Images <span class="text-muted">(Optional)</span></label>
                                <input type="file" name="featured_images[]" class="form-control" accept="image/*" multiple>
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle me-1"></i>Select multiple images to generate a smooth headline slideshow. Supported formats: JPG, PNG, GIF (Max 5MB each).
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Publication Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="published" <?= old('status') === 'published' ? 'selected' : '' ?>>Publish Now (Live to Public)</option>
                                    <option value="draft" <?= old('status') === 'draft' ? 'selected' : '' ?>>Save as Draft (Internal Review)</option>
                                </select>
                            </div>
                            
                            <hr class="text-muted opacity-25 my-4">

                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>Save News Post
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Async Form Feedback Alerts Placeholder Context -->
                <div id="successAlert" class="alert alert-success alert-dismissible fade show d-none mt-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i><span id="successMessage"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
                <div id="errorAlert" class="alert alert-danger alert-dismissible fade show d-none mt-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><span id="errorMessage"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>