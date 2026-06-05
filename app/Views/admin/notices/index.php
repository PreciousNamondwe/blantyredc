<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices Management - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0f172a;
            --primary-accent: #0984e3;
            --main-bg: #f8f9fa;
        }
        body { background-color: var(--main-bg); font-family: 'Segoe UI', Tahoma, sans-serif; }
        .sidebar { min-height: 100vh; background: var(--sidebar-bg); color: white; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .sidebar .nav-link { color: #b2bec3; padding: 0.8rem 1.2rem; transition: 0.3s; border-radius: 8px; margin-bottom: 4px; }
        .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.05); }
        .sidebar .nav-link.active { color: #fff; background: var(--primary-accent); box-shadow: 0 4px 6px rgba(9,132,227,0.3); }
        
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .table thead { background: #f1f2f6; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; }
        .btn { border-radius: 8px; padding: 0.5rem 1rem; }
        .badge { padding: 0.5em 0.8em; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-4">
                <h5 class="text-white mb-4"><i class="fas fa-shield-alt me-2"></i>Admin UI</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/applications') ?>"><i class="fas fa-file-alt me-2"></i>Applications</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/business-applications') ?>"><i class="fas fa-briefcase me-2"></i>Business</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/services') ?>"><i class="fas fa-cogs me-2"></i>Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/projects') ?>"><i class="fas fa-project-diagram me-2"></i>Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/news') ?>"><i class="fas fa-newspaper me-2"></i>News</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/notices') ?>"><i class="fas fa-bullhorn me-2"></i>Notices</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/notifications') ?>"><i class="fas fa-bell me-2"></i>Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/users') ?>"><i class="fas fa-users me-2"></i>Users</a></li>
                    <hr class="text-secondary">
                    <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
            
            <main class="col-md-10 px-md-5 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-dark">Notices Management</h2>
                    <a href="<?= base_url('admin/notices/create') ?>" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> Create New
                    </a>
                </div>

                <div class="card mb-4 shadow-sm">
                    <div class="card-body p-4">
                        <form method="GET" action="<?= base_url('admin/notices') ?>" class="row g-3">
                            <div class="col-md-10">
                                <label class="form-label small text-muted">Filter by Status</label>
                                <select name="status" class="form-select border-0 bg-light">
                                    <option value="">All Statuses</option>
                                    <option value="draft" <?= $status_filter === 'draft' ? 'selected' : '' ?>>Draft</option>
                                    <option value="published" <?= $status_filter === 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="archived" <?= $status_filter === 'archived' ? 'selected' : '' ?>>Archived</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Urgency</th>
                                    <th>Date</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($notices)): foreach ($notices as $notice): ?>
                                <tr>
                                    <td class="ps-4 fw-medium"><?= esc(substr($notice['title'], 0, 40)) ?>...</td>
                                    <td><span class="badge bg-light text-dark border"><?= esc($notice['category']) ?></span></td>
                                    <td><span class="badge bg-opacity-10 text-<?= match($notice['status']) { 'published' => 'success', 'draft' => 'secondary', default => 'warning' } ?> bg-<?= match($notice['status']) { 'published' => 'success', 'draft' => 'secondary', default => 'warning' } ?>"><?= ucfirst($notice['status']) ?></span></td>
                                    <td><?= ucfirst($notice['urgency_level']) ?></td>
                                    <td><?= $notice['published_at'] ? date('M d, Y', strtotime($notice['published_at'])) : '-' ?></td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-light"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No records found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>