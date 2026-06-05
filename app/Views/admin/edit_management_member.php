<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member - Blantyre District Council</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; }

        /* Sidebar Styling */
        .sidebar { min-height: 100vh; background: #0f172a; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; overflow-y: auto; box-shadow: 4px 0 10px rgba(0,0,0,0.05); }
        .sidebar-brand { padding: 1.5rem 1rem; border-bottom: 1px solid #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 0.75rem 1rem; border-radius: 0.375rem; transition: all 0.2s; display: flex; align-items: center; }
        .sidebar .nav-link:hover { color: #fff; background: #1e293b; }
        .sidebar .nav-link.active { color: #fff; background: #0284c7; }
        
        /* Layout Adjustments */
        .main-content { margin-left: 16.666667%; padding: 2rem !important; }
        @media (max-width: 768px) { .sidebar { position: static; } .main-content { margin-left: 0; } }

        /* Card and Form Styling */
        .card { border: none; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        .member-photo { width: 180px; height: 180px; object-fit: cover; border-radius: 0.75rem; border: 4px solid #f8fafc; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .form-label { font-weight: 500; color: #475569; }
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
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('admin/management') ?>"><i class="fas fa-landmark me-2"></i>Management</a></li>
                </ul>
        </div>

        <main class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div>
                    <h2 class="fw-bold text-dark">Edit Management Member</h2>
                    <p class="text-muted mb-0">Update profile details for <?= esc($member['name']) ?></p>
                </div>
                <a href="<?= base_url('admin/management') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card p-4 text-center">
                        <img src="<?= base_url($member['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="Member" class="member-photo mx-auto mb-3">
                        <h5 class="fw-bold"><?= esc($member['name']) ?></h5>
                        <p class="text-primary fw-medium"><?= esc($member['position']) ?></p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card p-4">
                        <form method="POST" action="<?= base_url('admin/management/' . $member['id'] . '/edit') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="<?= old('name', $member['name']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="position" value="<?= old('position', $member['position']) ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= old('email', $member['email']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?= old('phone', $member['phone']) ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" rows="4" class="form-control"><?= old('bio', $member['bio']) ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Change Photo</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" name="sort_order" value="<?= old('sort_order', $member['sort_order']) ?>">
                                </div>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" <?= old('is_active', $member['is_active']) ? 'checked' : '' ?>>
                                <label class="form-check-label">Active Status</label>
                            </div>
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>