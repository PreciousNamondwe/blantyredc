<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Types - Blantyre District Council</title>
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
                        <h1 class="h3 mb-0 fw-bold">Business Types</h1>
                        <p class="text-muted small mb-0">Create and manage business type values shown on the public business license form.</p>
                    </div>
                    <a href="<?= base_url('admin/business-types/create') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus me-2"></i>Add Business Type</a>
                </div>

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

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0 fw-semibold">Business Type Catalog</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($businessTypes)): ?>
                                        <?php foreach ($businessTypes as $index => $type): ?>
                                            <tr>
                                                <td><?= esc($index + 1) ?></td>
                                                <td><?= esc($type['name']) ?></td>
                                                <td><?= esc($type['category'] ?: 'General') ?></td>
                                                <td>
                                                    <?php if ((int) $type['is_active'] === 1): ?>
                                                        <span class="badge bg-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= esc($type['created_at']) ?></td>
                                                <td class="text-end">
                                                    <div class="d-inline-flex gap-2">
                                                        <a href="<?= base_url('admin/business-types/' . $type['id'] . '/edit') ?>" class="btn btn-sm btn-outline-secondary" title="Edit Business Type">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="post" action="<?= base_url('admin/business-types/' . $type['id'] . '/delete') ?>" class="d-inline m-0">
                                                            <?= csrf_field() ?>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this business type?');" title="Delete Business Type">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No business types have been created yet. Use the button above to add one.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
