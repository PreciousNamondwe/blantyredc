<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News | Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        
        /* Sidebar - Matches Dashboard */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 0.25rem; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        
        /* Main Content Layout */
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }
        
        /* Polished UI Components */
        .card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; font-weight: 600; color: #1e293b; }
        .form-control { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.75rem; }
        .btn-primary { background: #0284c7; border: none; padding: 0.6rem 1.5rem; }
        .btn-primary:hover { background: #0369a1; }

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
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/news') ?>"><i class="fas fa-newspaper me-2"></i>Manage News</a></li>
                    <li class="nav-item mt-4 pt-3 border-top border-secondary"><a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>

            <main class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-slate-800">Edit News</h2>
                        <nav aria-label="breadcrumb">
                            <small class="text-muted">Updating: <strong><?= esc($news['title']) ?></strong></small>
                        </nav>
                    </div>
                    <a href="<?= base_url('admin/news') ?>" class="btn btn-outline-secondary px-3"><i class="fas fa-chevron-left me-2"></i>Back</a>
                </div>

                <div class="card p-4">
                    <form method="post" action="<?= base_url('admin/news/' . $news['id'] . '/edit') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label fw-600">Headline</label>
                                    <input type="text" name="title" class="form-control form-control-lg" value="<?= old('title', $news['title']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-600">News Content</label>
                                    <textarea name="content" rows="12" class="form-control"><?= old('content', $news['content']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card bg-light border p-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-select mb-3">
                                        <option value="published" <?= old('status', $news['status']) === 'published' ? 'selected' : '' ?>>Published</option>
                                        <option value="draft" <?= old('status', $news['status']) === 'draft' ? 'selected' : '' ?>>Draft</option>
                                    </select>
                                    
                                    <label class="form-label fw-bold">Featured Image</label>
                                    <input type="file" name="featured_images[]" class="form-control mb-2" accept="image/*" multiple>
                                    <small class="text-muted">Uploading will replace existing images.</small>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3 py-2"><i class="fas fa-save me-2"></i>Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>