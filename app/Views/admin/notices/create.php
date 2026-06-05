<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($notice) ? 'Edit Notice' : 'Create Notice' ?> - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        
        /* Sidebar Styling */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 0.25rem; transition: all 0.2s; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        
        /* Main Content */
        .main-content { margin-left: 16.666667%; padding: 2rem; }
        .card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; color: #1e293b; }
        
        @media (max-width: 768px) {
            .sidebar { position: static; min-height: auto; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            <div class="sidebar-brand mb-4">
                <h5 class="text-white m-0"><i class="fas fa-layer-group text-info me-2"></i>Admin Panel</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-columns me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/notices') ?>"><i class="fas fa-bullhorn me-2"></i>Notices</a></li>
                <li class="nav-item mt-4 pt-3 border-top border-secondary"><a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>

        <main class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h2 class="fw-bold"><?= isset($notice) ? 'Edit Notice' : 'Create Notice' ?></h2>
                <a href="<?= base_url('admin/notices') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
            </div>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success shadow-sm"><?= esc(session('success')) ?></div>
            <?php endif; ?>

            <div class="card p-4">
                <form method="POST" action="<?= isset($notice) ? base_url('admin/notices/' . $notice['id'] . '/edit') : base_url('admin/notices/create') ?>">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="<?= esc($notice['title'] ?? old('title')) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" rows="8" required><?= esc($notice['content'] ?? old('content')) ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" value="<?= esc($notice['category'] ?? old('category')) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urgency</label>
                            <select class="form-select" name="urgency_level">
                                <option value="low">Low</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary px-4 mt-3"><?= isset($notice) ? 'Update' : 'Create' ?> Notice</button>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>