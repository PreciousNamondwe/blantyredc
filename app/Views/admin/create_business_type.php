<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Business Type - Blantyre District Council</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8fafc; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .sidebar { min-height: 100vh; background: #1e293b; }
        .sidebar .nav-link { color: #94a3b8; padding: 0.8rem 1rem; border-radius: 0.375rem; margin-bottom: 0.25rem; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #334155; }
        .sidebar .nav-link.active { color: #fff; background: #0ea5e9; }
        .card { border: none; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(15,23,42,0.08); }
        .form-control, .form-select { border-color: #cbd5e1; }
        .form-control:focus, .form-select:focus { box-shadow: 0 0 0 0.15rem rgba(14,165,233,0.15); border-color: #0ea5e9; }
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
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/applications') ?>"><i class="fas fa-file-alt me-2"></i>Applications</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/business-applications') ?>"><i class="fas fa-briefcase me-2"></i>Business Apps</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/services') ?>"><i class="fas fa-cogs me-2"></i>Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/projects') ?>"><i class="fas fa-project-diagram me-2"></i>Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/news') ?>"><i class="fas fa-newspaper me-2"></i>News</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/notifications') ?>"><i class="fas fa-bell me-2"></i>Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/users') ?>"><i class="fas fa-users me-2"></i>Users</a></li>
                    <li class="nav-item mt-4 border-top border-secondary pt-3"><a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
            <main class="col-md-10 ms-sm-auto px-4 py-4">
                <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                    <div>
                        <h1 class="h3 mb-0 fw-bold">Create Business Type</h1>
                        <p class="text-muted small mb-0">Add a new business type to the public business license application form.</p>
                    </div>
                    <a href="<?= base_url('admin/business-types') ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-2"></i>Back to Catalog</a>
                </div>

                <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6 class="alert-heading fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Please address the following:</h6>
                    <ul class="mb-0 ps-3">
                        <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <?php if ($success = session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?= esc($success) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <?php if ($error = session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?= esc($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 fw-semibold">New Business Type</h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="<?= base_url('admin/business-types/create') ?>">
                            <?= csrf_field() ?>
                            <div class="row g-3 mb-3">
                                <div class="col-md-8">
                                    <label for="name" class="form-label">Business Type Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" value="<?= old('category') ?>" placeholder="e.g. Retail">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?= old('sort_order', '0') ?>" min="0">
                                </div>
                                <div class="col-md-4">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1" <?= old('is_active', '1') === '1' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= old('is_active') === '0' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Save Business Type</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
