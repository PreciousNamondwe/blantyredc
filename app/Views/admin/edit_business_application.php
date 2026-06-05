<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business Licence Application - Blantyre District Council</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: #0f172a; }
        .sidebar .nav-link { color: #adb5bd; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: #0284c7; }
    </style>
</head>
<body>
<?php
    $nameParts = explode(' ', $applicant_info['name'] ?? '', 2);
    $firstName = old('first_name', $applicant_info['first_name'] ?? ($nameParts[0] ?? ''));
    $lastName = old('last_name', $applicant_info['last_name'] ?? ($nameParts[1] ?? ''));
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <div class="sidebar-brand mb-4">
                    <h5 class="text-white m-0 d-flex align-items-center">
                        <i class="fas fa-layer-group text-info me-2"></i>
                        <span>Admin Panel</span>
                    </h5>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/dashboard') ?>">
                            <span><i class="fas fa-columns main-icon me-2"></i>Dashboard</span>
                        </a>
                    </li>
                                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/business-applications'); ?>">Business Apps</a>
                                </li>
					<li class="nav-item mt-3">
						<a class="nav-link" href="<?= base_url('logout') ?>">
							<i class="fas fa-sign-out-alt me-2"></i>Logout
						</a>
					</li>
				</ul>
			</div>

            <main class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1"><i class="fas fa-edit me-2"></i>Edit Business Application</h2>
                        <div class="text-muted">Reference: <?= esc($application['reference_number']) ?></div>
                    </div>
                    <a href="<?= base_url('admin/business-applications') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <strong>Please fix the following:</strong>
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/business-applications/' . $application['id'] . '/edit') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <i class="fas fa-user me-2"></i>Applicant Information
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?= esc($firstName) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?= esc($lastName) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= esc(old('email', $applicant_info['email'] ?? '')) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?= esc(old('phone', $applicant_info['phone'] ?? '')) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ID Type</label>
                                    <?php $idType = old('id_type', $applicant_info['id_type'] ?? ''); ?>
                                    <select name="id_type" class="form-select">
                                        <option value="">Select</option>
                                        <?php foreach (['National ID', 'Passport', 'Driving License'] as $option): ?>
                                            <option value="<?= esc($option) ?>" <?= $idType === $option ? 'selected' : '' ?>><?= esc($option) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ID Number</label>
                                    <input type="text" name="id_number" class="form-control" value="<?= esc(old('id_number', $applicant_info['id_number'] ?? '')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control" value="<?= esc(old('date_of_birth', $applicant_info['date_of_birth'] ?? '')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <?php $gender = old('gender', $applicant_info['gender'] ?? ''); ?>
                                    <select name="gender" class="form-select">
                                        <option value="">Select</option>
                                        <?php foreach (['Male', 'Female'] as $option): ?>
                                            <option value="<?= esc($option) ?>" <?= $gender === $option ? 'selected' : '' ?>><?= esc($option) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <i class="fas fa-briefcase me-2"></i>Business Information
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" name="business_name" class="form-control" value="<?= esc(old('business_name', $business_details['business_name'] ?? '')) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Business Type</label>
                                    <input type="text" name="business_type" class="form-control" value="<?= esc(old('business_type', $business_details['business_type'] ?? '')) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Market</label>
                                    <input type="text" name="market" class="form-control" value="<?= esc(old('market', $business_details['market'] ?? '')) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="code" class="form-control" value="<?= esc(old('code', $business_details['code'] ?? '')) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Registering Date</label>
                                    <input type="date" name="registering_date" class="form-control" value="<?= esc(old('registering_date', $business_details['registering_date'] ?? ($business_details['reg_date'] ?? ''))) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Application Status</label>
                                    <?php $status = old('status', $application['status']); ?>
                                    <select name="status" class="form-select" required>
                                        <?php foreach (['submitted', 'under_review', 'approved', 'rejected', 'completed', 'cancelled'] as $option): ?>
                                            <option value="<?= $option ?>" <?= $status === $option ? 'selected' : '' ?>>
                                                <?= esc(ucfirst(str_replace('_', ' ', $option))) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('admin/business-applications') ?>" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
