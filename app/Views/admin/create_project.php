<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }
        
        /* Sidebar (Same as your provided feel) */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; transition: all 0.2s ease; margin-bottom: 0.25rem; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }

        /* Form Styling */
        .form-card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; font-size: 0.875rem; color: #475569; }
        .form-control, .form-select { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.625rem 0.875rem; }
        .form-control:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
        .btn-primary { background-color: #0284c7; border: none; padding: 0.625rem 1.25rem; font-weight: 600; }
        .btn-primary:hover { background-color: #0369a1; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            <div class="sidebar-brand mb-4">
                <h5 class="text-white m-0 d-flex align-items-center">
                    <i class="fas fa-layer-group text-info me-2"></i><span>Admin Panel</span>
                </h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-columns me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/projects') ?>"><i class="fas fa-project-diagram me-2"></i>Projects</a></li>
                </ul>
        </div>

        <main class="col-md-10 main-content">
            <div class="mb-4">
                <h2 class="fw-bold text-slate-800">Create New Project</h2>
                <p class="text-muted">Fill in the details below to add a project to the database.</p>
            </div>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success border-0 shadow-sm"><?= session('success') ?></div>
            <?php endif; ?>

            <div class="card form-card p-4">
                <form method="post" action="<?= base_url('test-project/store') ?>">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter project title">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" placeholder="e.g. Infrastructure">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief overview of the project..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Project area">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="planning">Planning</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Progress (%)</label>
                        <input type="number" name="progress_percentage" class="form-control" placeholder="0 - 100">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estimated Completion</label>
                            <input type="date" name="estimated_completion_date" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Budget</label>
                            <input type="number" step="0.01" name="budget" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Spent Amount</label>
                            <input type="number" step="0.01" name="spent_amount" class="form-control" placeholder="0.00">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contractor</label>
                            <input type="text" name="contractor" class="form-control" placeholder="Company name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fund Source</label>
                            <input type="text" name="fund_source" class="form-control" placeholder="e.g. Government/Donor">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Save Project
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>