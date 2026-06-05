<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notice - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        
        /* Sidebar - Aligned with your dashboard */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; left: 0; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 0.25rem; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        
        /* Layout */
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }
        @media (max-width: 768px) { .sidebar { position: static; min-height: auto; } .main-content { margin-left: 0; } }

        /* Card & UI components */
        .admin-card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); background: #fff; }
        .card-header { background-color: #fff; border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; font-weight: 600; color: #1e293b; }
        .form-label { font-weight: 600; font-size: 0.85rem; color: #475569; }
        .form-control, .form-select { border-radius: 0.5rem; border: 1px solid #e2e8f0; padding: 0.65rem 1rem; }
        .btn-primary { background: #0284c7; border: none; padding: 0.65rem 1.5rem; }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <div class="sidebar-brand mb-4"><h5 class="text-white m-0">Admin Panel</h5></div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-columns me-2"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/notices') ?>"><i class="fas fa-bullhorn me-2"></i>Notices</a></li>
                </ul>
            </div>

            <main class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h2 class="fw-bold text-slate-800">Edit Notice</h2>
                    <a href="<?= base_url('admin/notices') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>

                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success border-0 shadow-sm"><?= esc(session('success')) ?></div>
                <?php endif; ?>

                <div class="card admin-card">
                    <div class="card-header">Notice Details</div>
                    <div class="card-body p-4">
                        <form method="POST" action="<?= base_url('admin/notices/' . $notice['id'] . '/edit') ?>">
                            <?= csrf_field() ?>
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?= esc($notice['title'] ?? old('title')) ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" class="form-control" rows="8" required><?= esc($notice['content'] ?? old('content')) ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" class="form-control" value="<?= esc($notice['category'] ?? old('category')) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="draft" <?= ($notice['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                                        <option value="published" <?= ($notice['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publish</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">Update Notice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>