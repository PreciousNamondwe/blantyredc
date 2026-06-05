<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }

        /* Sidebar Styling */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; transition: all 0.2s; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }

        /* Card & UI Improvements */
        .card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); background: #fff; margin-bottom: 1.5rem; }
        .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; padding: 1.25rem 1.5rem; font-weight: 600; }
        .form-control, .form-select { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.6rem 0.75rem; }
        .form-control:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
        .btn { padding: 0.6rem 1.25rem; font-weight: 500; border-radius: 0.5rem; }
        .btn-primary { background: #0284c7; border: none; }
        .btn-secondary { background: #e2e8f0; border: none; color: #475569; }
        .stat-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 1rem; text-align: center; }

        @media (max-width: 768px) { .sidebar { position: static; } .main-content { margin-left: 0; } }
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
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-columns me-2"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-users me-2"></i>Users</a></li>
                <li class="nav-item mt-4 pt-3 border-top border-secondary"><a class="nav-link text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>

        <main class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Edit User Profile</h2>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">General Information</div>
                        <div class="card-body">
                            <?php
                            // Ensure name parts are available (fallback if controller didn't split them)
                            if (!isset($user['first_name'])) {
                                $nameParts = explode(' ', $user['full_name'] ?? '', 2);
                                $user['first_name'] = $nameParts[0] ?? '';
                                $user['last_name'] = $nameParts[1] ?? '';
                            }
                            ?>
                            <form method="POST" action="<?= base_url('admin/users/' . ($user['id'] ?? '') . '/edit') ?>">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control" value="<?= esc($user['first_name'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="<?= esc($user['last_name'] ?? '') ?>">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" value="<?= esc($user['username'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= esc($user['email'] ?? '') ?>">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">Account Activity</div>
                        <div class="card-body">
                            <div class="stat-box">
                                <h4 class="text-primary"><?= $user['total_applications'] ?? 0 ?></h4>
                                <small class="text-muted">Total Requests Processed</small>
                            </div>
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