<?= $this->extend('templates/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            <h5 class="text-white mb-4"><i class="fas fa-cogs me-2"></i>Admin Panel</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#applicationsCollapse" role="button" aria-expanded="false" aria-controls="applicationsCollapse">
                        <i class="fas fa-file-alt me-2"></i>Applications
                        <span class="float-end"><i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div class="collapse" id="applicationsCollapse">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/applications'); ?>">All Applications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/business-applications'); ?>">Business Applications</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#councilCollapse" role="button" aria-expanded="false" aria-controls="councilCollapse">
                        <i class="fas fa-landmark me-2"></i>Council
                        <span class="float-end"><i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div class="collapse" id="councilCollapse">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/officials'); ?>">Elected Officials</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/management'); ?>">Management</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/services') ?>">
                        <i class="fas fa-cogs me-2"></i>Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/projects') ?>">
                        <i class="fas fa-project-diagram me-2"></i>Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/news') ?>">
                        <i class="fas fa-chart-bar me-2"></i>News
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/notifications') ?>">
                        <i class="fas fa-bell me-2"></i>Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/users') ?>">
                        <i class="fas fa-users me-2"></i>Users
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="<?= base_url('logout') ?>">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><i class="fas fa-id-card me-2"></i>Business License Management</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="<?= base_url('business-license') ?>" class="btn btn-sm btn-outline-primary me-2" target="_blank">
                        <i class="fas fa-plus me-1"></i> New Application
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportData()">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?= $stats['total_business_licenses'] ?? 0 ?></h5>
                            <p class="card-text">Total Licenses</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title"><?= $stats['pending_business_licenses'] ?? 0 ?></h5>
                            <p class="card-text">Pending Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?= $stats['approved_business_licenses'] ?? 0 ?></h5>
                            <p class="card-text">Active Licenses</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?= $stats['expiring_soon_licenses'] ?? 0 ?></h5>
                            <p class="card-text">Expiring Soon</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" action="<?= base_url('admin/business-licenses') ?>" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="under_review">Under Review</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Business Type</label>
                            <select name="business_type" class="form-select">
                                <option value="">All Types</option>
                                <option>Agriculture / Food</option>
                                <option>Education / Health</option>
                                <option>Manufacturing / Industrial</option>
                                <option>Retail / Shops</option>
                                <option>Transport / Mobile</option>
                                <option>ICT / Financial</option>
                                <option>Hospitality / Recreation</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Market</label>
                            <select name="market" class="form-select">
                                <option value="">All Markets</option>
                                <option value="Lunzu">Lunzu</option>
                                <option value="Machinjiri">Machinjiri</option>
                                <option value="Chadzunda">Chadzunda</option>
                                <option value="Chikuli">Chikuli</option>
                                <option value="Mdeka">Mdeka</option>
                                <option value="Chilobwe">Chilobwe</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="<?= base_url('admin/business-licenses') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-list me-2"></i>Business Licenses</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>License Number</th>
                                    <th>Business Name</th>
                                    <th>Owner</th>
                                    <th>Business Type</th>
                                    <th>Market</th>
                                    <th>Status</th>
                                    <th>Expiry Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($business_licenses)): ?>
                                    <?php foreach ($business_licenses as $license): ?>
                                        <tr>
                                            <td>
                                                <strong><?= esc($license['license_number'] ?? 'N/A') ?></strong>
                                            </td>
                                            <td><?= esc($license['business_name']) ?></td>
                                            <td>
                                                <?= esc($license['owner_name']) ?><br>
                                                <small class="text-muted"><?= esc($license['owner_email']) ?></small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info"><?= esc($license['business_type']) ?></span>
                                            </td>
                                            <td><?= esc($license['market'] ?? '-') ?></td>
                                            <td>
                                                <?php
                                                $statusClass = match($license['status']) {
                                                    'pending' => 'warning',
                                                    'under_review' => 'info',
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    'expired' => 'dark',
                                                    default => 'secondary'
                                                };
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?>">
                                                    <?= ucfirst(str_replace('_', ' ', $license['status'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($license['expiry_date']): ?>
                                                    <?= date('M j, Y', strtotime($license['expiry_date'])) ?>
                                                    <?php if (strtotime($license['expiry_date']) < strtotime('+30 days') && $license['status'] === 'approved'): ?>
                                                        <span class="badge bg-danger ms-1">Expiring Soon</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/business-licenses/' . $license['application_id']) ?>" 
                                                       class="btn btn-sm btn-outline-primary" 
                                                       title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if ($license['status'] === 'pending' || $license['status'] === 'under_review'): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                                onclick="updateStatus(<?= $license['application_id'] ?>, 'approved')"
                                                                title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                onclick="updateStatus(<?= $license['application_id'] ?>, 'rejected')"
                                                                title="Reject">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            No business licenses found
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (isset($pager)): ?>
                        <div class="mt-3">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update License Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="statusForm" method="post" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="under_review">Under Review</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Add notes (optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateStatus(applicationId, status) {
    const modal = new bootstrap.Modal(document.getElementById('statusModal'));
    const form = document.getElementById('statusForm');
    form.action = "<?= base_url('api/business-license/') ?>/" + applicationId + "/status";
    form.querySelector('select[name="status"]').value = status;
    modal.show();
}

function exportData() {
    // Implement export functionality
    alert('Export functionality coming soon!');
}
</script>

<?= $this->endSection() ?>