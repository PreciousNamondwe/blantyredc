<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Official | Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        
        /* Inherited Sidebar & Layout */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; padding: 1.5rem; }
                .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; transition: all 0.2s; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }
        
        /* Modern UI Components */
        .card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; padding: 1.25rem; font-weight: 600; }
        
        .official-photo { width: 150px; height: 150px; object-fit: cover; border-radius: 0.75rem; border: 4px solid #f8fafc; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        
        .form-label { font-weight: 500; font-size: 0.9rem; color: #64748b; }
        .form-control { border: 1px solid #e2e8f0; padding: 0.6rem 0.75rem; border-radius: 0.5rem; }
        .form-control:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }

        @media (max-width: 768px) {
            .sidebar { position: static; min-height: auto; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar placeholder -->
        <aside class="col-md-2 sidebar">
                        <div class="sidebar-brand mb-4">
                <h5 class="text-white m-0"><i class="fas fa-layer-group text-info me-2"></i>Admin Panel</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-columns me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/officials') ?>"><i class="fas fa-landmark me-2"></i>Officials</a></li>
                </ul>
        </div>
        </aside>

        <main class="col-md-10 main-content">
            <header class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div>
                    <h2 class="fw-bold text-dark">Edit Official</h2>
                    <nav aria-label="breadcrumb">
                        <small class="text-muted">Updating: <span class="text-primary fw-medium"><?= esc($official['name']) ?></span></small>
                    </nav>
                </div>
                <a href="<?= base_url('admin/officials') ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </header>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger shadow-sm border-0 mb-4">
                    <ul class="mb-0 ps-3"><?php foreach (session('errors') as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card shadow-sm p-4 text-center">
                        <img src="<?= base_url($official['photo'] ?? 'image/cropped-BDC-site-logo.png') ?>" alt="Official Photo" class="official-photo mx-auto mb-3">
                        <h5 class="fw-bold mb-1"><?= esc($official['name']) ?></h5>
                        <p class="text-muted small"><?= esc($official['position']) ?></p>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header"><i class="fas fa-edit me-2 text-primary"></i>Profile Details</div>
                        <div class="card-body p-4">
                            <?= form_open_multipart('admin/officials/' . $official['id'] . '/edit') ?>
                                <div class="mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" name="name" value="<?= old('name', $official['name']) ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Position *</label>
                                        <input type="text" class="form-control" name="position" value="<?= old('position', $official['position']) ?>" list="posList" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Constituency/Ward</label>
                                        <input type="text" class="form-control" name="department" value="<?= old('department', $official['department']) ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Update Photo</label>
                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                </div>
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" <?= old('is_active', $official['is_active']) ? 'checked' : '' ?>>
                                    <label class="form-check-label">Active Status</label>
                                </div>
                                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Save Changes</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>