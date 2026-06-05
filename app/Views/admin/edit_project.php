<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        
        /* Sidebar Styling (Matches Dashboard) */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; transition: all 0.2s; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }
        
        /* Form & Card Styling */
        .form-card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .form-card .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; font-weight: 600; }
        .form-label { font-weight: 500; font-size: 0.9rem; }
        .btn-primary { background: #0284c7; border: none; padding: 0.6rem 1.2rem; }
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
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/projects') ?>"><i class="fas fa-project-diagram me-2"></i>Projects</a></li>
                <li class="nav-item mt-4 pt-3 border-top border-secondary"><a class="nav-link" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout</a></li>
            </ul>
        </div>

        <main class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h2 class="fw-bold text-slate-800">Edit Project</h2>
                <a href="<?= base_url('admin/projects') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger shadow-sm border-0"><?php foreach (session('errors') as $error): ?><li><?= $error ?></li><?php endforeach; ?></div>
            <?php endif; ?>

            <div class="card form-card">
                <div class="card-header">Project Information</div>
                <div class="card-body p-4">
                    <form method="post" action="<?= base_url('admin/projects/edit/' . $project['id']) ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Project Title</label>
                                <input type="text" class="form-control" name="title" value="<?= old('title', $project['title']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" name="category" value="<?= old('category', $project['category']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4" required><?= old('description', $project['description']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" value="<?= old('location', $project['location']) ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="planning" <?= old('status', $project['status']) == 'planning' ? 'selected' : '' ?>>Planning</option>
                                    <option value="ongoing" <?= old('status', $project['status']) == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="completed" <?= old('status', $project['status']) == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Budget (MWK)</label>
                                <input type="number" class="form-control" name="budget" step="0.01" value="<?= old('budget', $project['budget']) ?>" required>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>