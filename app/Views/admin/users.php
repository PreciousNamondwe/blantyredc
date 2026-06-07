<style>
    .filter-toolbar {
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
    }
    .search-input-group {
        position: relative;
    }
    .search-input-group i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    .search-input-group input {
        padding-left: 35px;
        border-radius: 0.5rem;
        border-color: #e2e8f0;
    }
    .search-input-group input:focus, .status-select:focus, .border-smooth:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    .status-select {
        border-radius: 0.5rem;
        border-color: #e2e8f0;
        color: #475569;
    }
    .border-smooth {
        border-color: #e2e8f0;
        border-radius: 0.5rem;
    }
    .user-avatar-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 0.5rem;
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        text-transform: uppercase;
    }
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
</style>

<?php 
    // Double-Guarded RBAC Check: Validates backend state lookup or active token parameters
    $isAdmin = (isset($current_role) && $current_role === 'admin') || (session()->get('role') === 'admin'); 
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1">System Identity Profiles</h2>
        <p class="text-muted small mb-0">
            <?= $isAdmin ? 'Full administrative control over operational system security accounts.' : 'Read-only directory access of organizational clearance identities.'; ?>
        </p>
    </div>
    <div>
        <?php if ($isAdmin): ?>
            <button type="button" class="btn btn-primary px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-plus me-2"></i>Add User Profile
            </button>
        <?php else: ?>
            <span class="badge bg-light text-secondary border px-3 py-2"><i class="fas fa-lock me-1"></i> Directory Read-Only Mode</span>
        <?php endif; ?>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm mb-4 alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger border-0 shadow-sm mb-4 alert-dismissible fade show" role="alert">
        <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="filter-toolbar p-3 mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-6 col-lg-4">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search by name, username, email, phone or department...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select">
                <option value="all">All Statuses</option>
                <option value="yes">Active Members</option>
                <option value="no">Inactive Members</option>
            </select>
        </div>
        <div class="col text-md-end text-muted small" id="filterCount"></div>
    </div>
</div>

<div class="card dashboard-card border-0 shadow-sm mb-4 rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="managementTable">
                <thead>
                    <tr class="table-light">
                        <th style="width: 70px; padding-left: 1.5rem;">Avatar</th>
                        <th>User Identity</th>
                        <th>Role Level</th>
                        <th>Department</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Last Portal Activity</th>
                        <th>Status</th>
                        <?php if ($isAdmin): ?>
                            <th class="text-end" style="padding-right: 1.5rem; width: 180px;">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr id="noDataRow">
                            <td colspan="<?= $isAdmin ? '9' : '8' ?>" class="text-center text-muted py-5">
                                <i class="fas fa-user-shield d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No user profiles found within the security matrix.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr class="member-row transition-all" 
                                data-search="<?= strtolower(esc($user['full_name'] . ' ' . $user['username'] . ' ' . $user['email'] . ' ' . (!empty($user['phone']) ? $user['phone'] : '') . ' ' . $user['department'])) ?>"
                                data-active="<?= $user['is_active'] ? 'yes' : 'no' ?>">
                                
                                <td style="padding-left: 1.5rem;">
                                    <div class="user-avatar-placeholder">
                                        <?= substr(esc($user['full_name']), 0, 2) ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block"><?= esc($user['full_name']) ?></span>
                                    <small class="text-muted">@<?= esc($user['username']) ?></small>
                                </td>
                                <td>
                                    <?php 
                                        $badgeStyle = 'bg-secondary text-secondary';
                                        if ($user['role'] === 'admin') $badgeStyle = 'bg-danger text-danger';
                                        elseif ($user['role'] === 'department_head') $badgeStyle = 'bg-warning text-warning';
                                        elseif ($user['role'] === 'reviewer') $badgeStyle = 'bg-info text-info';
                                        elseif ($user['role'] === 'staff') $badgeStyle = 'bg-success text-success';
                                    ?>
                                    <span class="badge <?= $badgeStyle ?> bg-opacity-10 px-2.5 py-1.5 text-capitalize">
                                        <?= str_replace('_', ' ', esc($user['role'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark font-medium"><?= !empty($user['department']) ? esc($user['department']) : '<span class="text-muted italic small">None</span>' ?></span>
                                </td>
                                <td>
                                    <a href="mailto:<?= esc($user['email']) ?>" class="small font-medium text-decoration-none"><?= esc($user['email']) ?></a>
                                </td>
                                <td>
                                    <span class="text-secondary font-mono small"><?= !empty($user['phone']) ? esc($user['phone']) : '<span class="text-muted opacity-50">-</span>' ?></span>
                                </td>
                                <td>
                                    <small class="text-slate-600 font-mono">
                                        <?= !empty($user['last_login']) ? date('Y-m-d H:i:s', strtotime($user['last_login'])) : '<span class="text-muted italic small">Never</span>' ?>
                                    </small>
                                </td>
                                <td>
                                    <?= $user['is_active'] 
                                        ? '<span class="badge bg-success bg-opacity-10 text-success">Active</span>' 
                                        : '<span class="badge bg-secondary bg-opacity-10 text-secondary">Suspended</span>' ?>
                                </td>
                                
                                <?php if ($isAdmin): ?>
                                    <td style="padding-right: 1.5rem;">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-sm btn-outline-primary px-2" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $user['id'] ?>">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <form method="POST" action="<?= base_url('admin/users/delete/' . $user['id']) ?>" onsubmit="return confirm('Completely revoke system clearances for <?= esc($user['full_name'], 'js') ?>?');">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2">
                                                    <i class="fas fa-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>

                            <?php if ($isAdmin): ?>
                                <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-3">
                                            <form action="<?= base_url('admin/users/edit/' . $user['id']) ?>" method="POST">
                                                <?= csrf_field() ?>
                                                <div class="modal-header border-bottom bg-light px-4 py-3">
                                                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-user-edit text-primary me-2"></i>Modify Security Account Profile</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4 text-start">
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium text-secondary small">Full Operational Name</label>
                                                            <input type="text" name="full_name" class="form-control px-3 py-2 border-smooth" value="<?= esc($user['full_name']) ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium text-secondary small">Account Username Access Key</label>
                                                            <input type="text" name="username" class="form-control px-3 py-2 border-smooth" value="<?= esc($user['username']) ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium text-secondary small">Authorized Access Email Address</label>
                                                            <input type="email" name="email" class="form-control px-3 py-2 border-smooth" value="<?= esc($user['email']) ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium text-secondary small">Direct Communications Phone Line</label>
                                                            <input type="text" name="phone" class="form-control px-3 py-2 border-smooth" value="<?= esc($user['phone']) ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label fw-medium text-secondary small">Security Access Clearance Profile</label>
                                                            <select name="role" class="form-select px-3 py-2 border-smooth" required>
                                                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Root Administrator (admin)</option>
                                                                <option value="department_head" <?= $user['role'] === 'department_head' ? 'selected' : '' ?>>Department Chief Head (department_head)</option>
                                                                <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Operations Staff (staff)</option>
                                                                <option value="reviewer" <?= $user['role'] === 'reviewer' ? 'selected' : '' ?>>External Auditor / Reviewer (reviewer)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label fw-medium text-secondary small">Assigned Cluster Department Area</label>
                                                            <input type="text" name="department" class="form-control px-3 py-2 border-smooth" value="<?= esc($user['department']) ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label fw-medium text-secondary small">Operational Status Framework</label>
                                                            <select name="is_active" class="form-select px-3 py-2 border-smooth" required>
                                                                <option value="1" <?= $user['is_active'] ? 'selected' : '' ?>>Authorize Account (Active)</option>
                                                                <option value="0" <?= !$user['is_active'] ? 'selected' : '' ?>>Suspend System Node</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mb-3">
                                                        <div class="col-12">
                                                            <label class="form-label fw-medium text-secondary small">Override Password Gate</label>
                                                            <input type="password" name="password" class="form-control px-3 py-2 border-smooth" placeholder="Leave empty to retain existing cryptographically hashed credentials...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light border-top px-4 py-3">
                                                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-sm btn-primary px-4">Commit Updates</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                        
                        <tr id="noResultsRow" style="display: none;">
                            <td colspan="<?= $isAdmin ? '9' : '8' ?>" class="text-center text-muted py-5">
                                <i class="fas fa-search d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No users found matching your selection criteria.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if ($isAdmin): ?>
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <form action="<?= base_url('admin/users/create') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-header border-bottom bg-light px-4 py-3">
                        <h5 class="modal-title fw-bold text-dark d-flex align-items-center"><i class="fas fa-user-shield text-success me-2"></i>Provision System User Node</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-secondary small">Full Operational Name</label>
                                <input type="text" name="full_name" class="form-control px-3 py-2 border-smooth" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-secondary small">Account Security Username Token</label>
                                <input type="text" name="username" class="form-control px-3 py-2 border-smooth" placeholder="e.g. jdoe_clearance" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-secondary small">Authorized Identity Access Email</label>
                                <input type="email" name="email" class="form-control px-3 py-2 border-smooth" placeholder="e.g. jdoe@domain.org" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-secondary small">Default System Access Password</label>
                                <input type="password" name="password" class="form-control px-3 py-2 border-smooth" placeholder="Minimum length of 8 characters..." required>
                            </div>
                        </div>
                        <div class="row g-3 mb-0">
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small">Security Access Clearance Profile</label>
                                <select name="role" class="form-select px-3 py-2 border-smooth" required>
                                    <option value="staff" selected>Operations Support Staff (staff)</option>
                                    <option value="department_head">Department Chief Head (department_head)</option>
                                    <option value="reviewer">External Reviewer Auditor (reviewer)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small">Assigned Cluster Department</label>
                                <input type="text" name="department" class="form-control px-3 py-2 border-smooth" placeholder="e.g. IT Sector, Management">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium text-secondary small">Direct Communications Line / Phone</label>
                                <input type="text" name="phone" class="form-control px-3 py-2 border-smooth" placeholder="e.g. +265...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top px-4 py-3">
                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Abort</button>
                        <button type="submit" class="btn btn-sm btn-success text-white px-4">Provision Security Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    (function() {
        function initTableFilters() {
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.member-row');
            const noResultsRow = document.getElementById('noResultsRow');
            const filterCountOutput = document.getElementById('filterCount');

            if (!searchInput || !statusFilter) return;

            function filterTable() {
                const queryValue = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const searchableText = row.getAttribute('data-search');
                    const activeStatus = row.getAttribute('data-active');

                    const matchesSearch = searchableText.includes(queryValue);
                    const matchesStatus = (statusValue === 'all') || (activeStatus === statusValue);

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (tableRows.length > 0) {
                    filterCountOutput.textContent = `Showing ${visibleCount} of ${tableRows.length} user nodes`;
                    noResultsRow.style.display = (visibleCount === 0) ? '' : 'none';
                }
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            filterTable();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTableFilters);
        } else {
            initTableFilters();
        }
    })();
</script>