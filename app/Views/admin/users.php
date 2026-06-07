<style>
    :root {
        /* Government & Institutional Brand Guide */
        --gov-navy-primary: #1a3352;
        --gov-navy-hover: #112237;
        --gov-gold: #d4af37;
        --gov-gold-light: #fdfaf2;
        --gov-border: #ccd4dc;
        --gov-text: #2d3748;
        
        /* Microsoft Excel Grid System Specific Palette */
        --excel-border: #d0d7de;
        --excel-header-bg: #f6f8fa;
        --excel-focus-blue: #0066cc;
    }

    /* Government Institutional Header Banner */
    .gov-banner-header {
        background: linear-gradient(135deg, var(--gov-navy-primary) 0%, #2c4d75 100%);
        border-bottom: 4px solid var(--gov-gold);
        border-radius: 6px 6px 0 0;
        padding: 1.5rem 1.75rem;
        color: #ffffff;
    }

    .gov-title-seal {
        border-left: 4px solid var(--gov-gold);
        padding-left: 1.25rem;
    }

    /* Administrative Filter Matrix Toolbar Component */
    .filter-toolbar-matrix {
        background: #ffffff;
        border-left: 1px solid var(--excel-border);
        border-right: 1px solid var(--excel-border);
        border-bottom: 1px solid var(--excel-border);
        padding: 1rem 1.25rem;
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
        border-radius: 4px;
        border-color: var(--excel-border);
        font-size: 0.875rem;
    }

    .search-input-group input:focus,
    .status-select-matrix:focus {
        border-color: var(--excel-focus-blue);
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.15);
    }

    .status-select-matrix {
        border-radius: 4px;
        border-color: var(--excel-border);
        color: var(--gov-text);
        font-size: 0.875rem;
    }

    /* Excel High-Density Spreadsheet Data Engine Layout */
    .excel-card-container {
        border-left: 1px solid var(--excel-border);
        border-right: 1px solid var(--excel-border);
        border-bottom: 1px solid var(--excel-border);
        background-color: #ffffff;
        border-radius: 0 0 6px 6px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .excel-grid-table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
    }

    /* High-Density Microsoft Excel Boundary Grid Matching System */
    .excel-grid-table th {
        background-color: var(--excel-header-bg) !important;
        color: #24292f !important;
        font-weight: 600 !important;
        font-size: 0.775rem !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid var(--excel-border) !important;
        padding: 10px 12px !important;
        vertical-align: middle;
    }

    .excel-grid-table td {
        border: 1px solid var(--excel-border) !important;
        padding: 8px 12px !important; 
        font-size: 0.85rem !important;
        color: var(--gov-text);
        vertical-align: middle;
        background-color: #ffffff;
    }

    .excel-grid-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* System Operational Icons Context Box */
    .project-icon-box-matrix { 
        width: 32px; 
        height: 32px; 
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(26, 51, 82, 0.08);
        color: var(--gov-navy-primary);
        font-weight: 600;
        border-radius: 4px; 
        border: 1px solid rgba(26, 51, 82, 0.15);
    }

    /* Native Sheet Simulation Inputs inside Modals */
    .excel-grid-input {
        border: 1px solid var(--excel-border) !important;
        background-color: #ffffff !important;
        border-radius: 4px !important;
        font-size: 0.875rem !important;
        padding: 6px 10px !important;
        width: 100%;
        transition: all 0.15s ease-in-out;
    }

    .excel-grid-input:focus {
        border: 1px solid var(--excel-focus-blue) !important;
        box-shadow: inset 0 0 0 1px var(--excel-focus-blue);
        outline: none;
    }

    /* Buttons Typography Profiles */
    .gov-btn-primary {
        background-color: var(--gov-navy-primary);
        border-color: var(--gov-navy-primary);
        color: #ffffff;
        font-weight: 500;
        font-size: 0.875rem;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .gov-btn-primary:hover, .gov-btn-primary:focus {
        background-color: var(--gov-navy-hover) !important;
        border-color: var(--gov-navy-hover) !important;
        color: #ffffff !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }

    .gov-btn-secondary-outline {
        border-color: var(--excel-border);
        color: #475569;
        font-size: 0.85rem;
        background-color: #ffffff;
    }
    
    .gov-btn-secondary-outline:hover {
        background-color: #f1f5f9;
        color: #1e293b;
    }

    .font-monospace-gov {
        font-family: 'SFMono-Regular', Consolas, "Liberation Mono", Menlo, monospace !important;
    }

    /* Unified View/Edit Operational Switch Framework Styles */
    .modal-view-mode .form-control-plaintext { font-weight: 500; color: #1e293b; padding: 0.375rem 0.75rem; }
    .modal-view-mode .editable-field { display: none !important; }
    .modal-view-mode .modal-footer-edit { display: none !important; }

    .modal-edit-mode .static-text-field { display: none !important; }
    .modal-edit-mode .editable-field { display: block !important; }
    .modal-edit-mode .modal-footer-view { display: none !important; }

    /* Alert and notification containers overlays */
    .gov-toast-alert {
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-left: 4px solid transparent;
    }
    .gov-toast-alert.alert-success { border-left-color: #2f855a; background-color: #f0fff4; color: #22543d; }
    .gov-toast-alert.alert-danger { border-left-color: #c53030; background-color: #fff5f5; color: #742a2a; }

    /* Custom Status Indicators for Directory Engine */
    .matrix-status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 3px;
        border: 1px solid transparent;
        display: inline-block;
    }
</style>

<?php 
    // Double-Guarded RBAC Access Token Check
    $isAdmin = (isset($current_role) && $current_role === 'admin') || (session()->get('role') === 'admin'); 
?>

<div class="gov-banner-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div class="gov-title-seal">
        <h4 class="fw-bold tracking-tight mb-1 text-uppercase text-white" style="letter-spacing: 0.5px;">
            System Identity Registry Matrix
        </h4>
        <div class="small opacity-75 text-white font-monospace-gov" style="font-size: 0.75rem;">
            BLANTYRE DISTRICT COUNCIL &bull; REPUBLIC OF MALAWI SECURITY CLEARANCE SERVICE MODULE
        </div>
    </div>
    <div>
        <?php if ($isAdmin): ?>
            <button type="button" class="btn btn-light px-3 fw-semibold shadow-sm" style="color: var(--gov-navy-primary); font-size: 0.85rem; border: 1px solid var(--gov-gold);" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-plus-square me-2 text-warning"></i>Provision Security Profile
            </button>
        <?php else: ?>
            <span class="badge bg-light text-dark px-3 py-2 border font-monospace-gov" style="font-size: 0.75rem; border-color: var(--gov-gold) !important;">
                <i class="fas fa-lock me-1"></i> READ-ONLY SECURITY NODE
            </span>
        <?php endif; ?>
    </div>
</div>

<div id="alertWrapper" class="px-0">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 gov-toast-alert p-3 mb-0 filter-toolbar-matrix border-bottom-0" role="alert" style="border-left: 4px solid #2f855a !important;">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger border-0 gov-toast-alert p-3 mb-0 filter-toolbar-matrix border-bottom-0" role="alert" style="border-left: 4px solid #c53030 !important;">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <span class="fw-bold">Configuration errors structural breakdown:</span>
            <ul class="mb-0 mt-1 ps-3 font-monospace-gov" style="font-size: 0.8rem;">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<div class="filter-toolbar-matrix">
    <div class="row g-3 align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search system node arrays by name, token, email, assigned department...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select-matrix">
                <option value="all">All Operational Statuses</option>
                <option value="yes">Active Nodes</option>
                <option value="no">Suspended Nodes</option>
            </select>
        </div>
        <div class="col text-md-end text-muted font-monospace-gov" id="filterCount" style="font-size: 0.75rem; color: var(--gov-text) !important;">
            Evaluating organizational structural matrix...
        </div>
    </div>
</div>

<div class="excel-card-container">
    <div class="table-responsive">
        <table class="table table-hover excel-grid-table align-middle" id="managementTable">
            <thead>
                <tr>
                    <th style="width: 55px; text-align: center;">Node</th>
                    <th>User Identity Token</th>
                    <th>Clearance Profile</th>
                    <th>Assigned Department</th>
                    <th>Authorized Email Area</th>
                    <th>Direct Comm Line</th>
                    <th>Last Active Record</th>
                    <th>Status Matrix</th>
                    <?php if ($isAdmin): ?>
                        <th style="text-align: right; width: 160px;">Operational Controls</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr id="noDataRow">
                        <td colspan="<?= $isAdmin ? '9' : '8' ?>" class="text-center text-muted py-5 font-monospace-gov" style="font-size: 0.85rem;">
                            <i class="fas fa-network-wired d-block mb-3 fa-2x opacity-25" style="color: var(--gov-navy-primary);"></i>
                            Zero (0) identity profiles loaded into the core system matrix.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="member-row" 
                            data-search="<?= strtolower(esc($user['full_name'] . ' ' . $user['username'] . ' ' . $user['email'] . ' ' . (!empty($user['phone']) ? $user['phone'] : '') . ' ' . $user['department'])) ?>"
                            data-active="<?= $user['is_active'] ? 'yes' : 'no' ?>">
                            
                            <td style="text-align: center;">
                                <div class="project-icon-box-matrix mx-auto font-monospace-gov" style="font-size: 0.75rem;">
                                    <?= strtoupper(substr(esc($user['full_name']), 0, 2)) ?>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold d-block mb-0.5" style="color: var(--gov-navy-primary); font-size: 0.875rem;"><?= esc($user['full_name']) ?></span>
                                <span class="font-monospace-gov text-muted small" style="font-size: 0.725rem;">@<?= esc($user['username']) ?></span>
                            </td>
                            <td>
                                <?php 
                                    $badgeStyle = 'background-color: var(--gov-bg-muted); color: var(--gov-text); border-color: var(--excel-border);';
                                    if ($user['role'] === 'admin') $badgeStyle = 'background-color: #e2eafc; color: var(--gov-navy-primary); border-color: #ccd4dc;';
                                    elseif ($user['role'] === 'department_head') $badgeStyle = 'background-color: var(--gov-gold-light); color: #856404; border-color: var(--gov-gold);';
                                ?>
                                <span class="matrix-status-badge text-uppercase font-monospace-gov" style="<?= $badgeStyle ?> font-size: 0.7rem;">
                                    <?= str_replace('_', ' ', esc($user['role'])) ?>
                                </span>
                            </td>
                            <td>
                                <span class="fw-semibold" style="font-size: 0.825rem;"><?= !empty($user['department']) ? esc($user['department']) : '<span class="text-muted opacity-50 font-italic">UNASSIGNED</span>' ?></span>
                            </td>
                            <td>
                                <a href="mailto:<?= esc($user['email']) ?>" class="font-monospace-gov text-decoration-none" style="color: var(--excel-focus-blue); font-size: 0.825rem;"><?= esc($user['email']) ?></a>
                            </td>
                            <td>
                                <span class="font-monospace-gov small" style="font-size: 0.8rem;"><?= !empty($user['phone']) ? esc($user['phone']) : '<span class="text-muted opacity-25">-</span>' ?></span>
                            </td>
                            <td>
                                <span class="font-monospace-gov small" style="font-size: 0.8rem; color: #555;">
                                    <?= !empty($user['last_login']) ? date('Y-m-d H:i:s', strtotime($user['last_login'])) : '<span class="text-muted opacity-50">NEVER</span>' ?>
                                </span>
                            </td>
                            <td>
                                <?= $user['is_active'] 
                                    ? '<span class="matrix-status-badge font-monospace-gov" style="background-color: #e6fffa; color: #006d5b; border-color: #b2f5ea; font-size: 0.7rem;">ACTIVE</span>' 
                                    : '<span class="matrix-status-badge font-monospace-gov" style="background-color: #f7fafc; color: #4a5568; border-color: #e2e8f0; font-size: 0.7rem;">SUSPENDED</span>' ?>
                            </td>
                            
                            <?php if ($isAdmin): ?>
                                <td style="text-align: right;">
                                    <div class="d-flex gap-1 justify-content-end">
                                        <button type="button" class="btn btn-sm gov-btn-secondary-outline px-2 py-0.5 font-monospace-gov" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $user['id'] ?>">
                                            <i class="fas fa-edit me-1"></i>EDIT
                                        </button>
                                        <form method="POST" action="<?= base_url('admin/users/delete/' . $user['id']) ?>" class="m-0" onsubmit="return confirm('Completely revoke system clearances for <?= esc($user['full_name'], 'js') ?>?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm gov-btn-secondary-outline text-danger px-2 py-0.5 font-monospace-gov" style="font-size: 0.75rem; border-color: rgba(197,48,48,0.2);">
                                                <i class="fas fa-trash me-1"></i>PRG
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>

                        <?php if ($isAdmin): ?>
                            <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content style-matrix-container" style="border-radius: 4px !important;">
                                        <form action="<?= base_url('admin/users/edit/' . $user['id']) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <div class="modal-header d-flex align-items-center" style="background-color: var(--excel-header-bg); border-bottom: 1px solid var(--excel-border);">
                                                <h6 class="modal-title fw-bold text-uppercase font-monospace-gov" style="color: var(--gov-navy-primary); letter-spacing: 0.5px;">
                                                    <i class="fas fa-database me-2 text-warning"></i>Cell Record Context Edit: Node #<?= $user['id'] ?>
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[FIELD: FULL_NAME]</label>
                                                        <input type="text" name="full_name" class="excel-grid-input" value="<?= esc($user['full_name']) ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[FIELD: USERNAME_TOKEN]</label>
                                                        <input type="text" name="username" class="excel-grid-input" value="<?= esc($user['username']) ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[FIELD: AUTHORIZED_EMAIL]</label>
                                                        <input type="email" name="email" class="excel-grid-input" value="<?= esc($user['email']) ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[FIELD: DIRECT_PHONE]</label>
                                                        <input type="text" name="phone" class="excel-grid-input" value="<?= esc($user['phone']) ?>">
                                                    </div>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[MATRIX: SECURITY_ROLE]</label>
                                                        <select name="role" class="form-select excel-grid-input" style="height: 35px;" required>
                                                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Root Administrator (admin)</option>
                                                            <option value="department_head" <?= $user['role'] === 'department_head' ? 'selected' : '' ?>>Department Chief Head (department_head)</option>
                                                            <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Operations Staff (staff)</option>
                                                            <option value="reviewer" <?= $user['role'] === 'reviewer' ? 'selected' : '' ?>>External Auditor (reviewer)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[MATRIX: REGISTRY_DEPT]</label>
                                                        <input type="text" name="department" class="excel-grid-input" value="<?= esc($user['department']) ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[FLAG: OPERATIONAL_STATE]</label>
                                                        <select name="is_active" class="form-select excel-grid-input" style="height: 35px;" required>
                                                            <option value="1" <?= $user['is_active'] ? 'selected' : '' ?>>Authorize Account (Active)</option>
                                                            <option value="0" <?= !$user['is_active'] ? 'selected' : '' ?>>Suspend System Node</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row g-3 mb-0">
                                                    <div class="col-12">
                                                        <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[OVERRIDE: CRYPTO_PASSWORD_GATE]</label>
                                                        <input type="password" name="password" class="excel-grid-input" placeholder="Leave empty to retain existing structural key...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light" style="border-top: 1px solid var(--excel-border);">
                                                <button type="button" class="btn btn-sm gov-btn-secondary-outline px-3" data-bs-dismiss="modal">ABORT CELL EDIT</button>
                                                <button type="submit" class="btn btn-sm gov-btn-primary px-4">COMMIT RECORD OVERWRITE</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>
                    
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="<?= $isAdmin ? '9' : '8' ?>" class="text-center text-muted py-5 font-monospace-gov" style="font-size: 0.85rem;">
                            <i class="fas fa-search-minus d-block mb-2 fa-2x opacity-25"></i>
                            Query error: Zero (0) spreadsheet arrays matching search criteria parameters.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($isAdmin): ?>
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content style-matrix-container" style="border-radius: 4px !important;">
                <form action="<?= base_url('admin/users/create') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-header d-flex align-items-center" style="background-color: var(--excel-header-bg); border-bottom: 1px solid var(--excel-border);">
                        <h6 class="modal-title fw-bold text-uppercase font-monospace-gov" style="color: var(--gov-navy-primary); letter-spacing: 0.5px;">
                            <i class="fas fa-user-plus me-2 text-success"></i>Append Row Matrix Node: Identity Account Provision
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: FULL_NAME]</label>
                                <input type="text" name="full_name" class="excel-grid-input" placeholder="e.g. Chimwemwe Phiri" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: USERNAME_TOKEN]</label>
                                <input type="text" name="username" class="excel-grid-input" placeholder="e.g. cphiri_clearance" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: AUTHORIZED_EMAIL]</label>
                                <input type="email" name="email" class="excel-grid-input" placeholder="e.g. cphiri@blantyre.gov.mw" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: INITIAL_PASSWORD_HASH]</label>
                                <input type="password" name="password" class="excel-grid-input" placeholder="Minimum length of 8 characters..." required>
                            </div>
                        </div>
                        <div class="row g-3 mb-0">
                            <div class="col-md-4">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: SECURITY_ROLE]</label>
                                <select name="role" class="form-select excel-grid-input" style="height: 35px;" required>
                                    <option value="staff" selected>Operations Support Staff (staff)</option>
                                    <option value="department_head">Department Chief Head (department_head)</option>
                                    <option value="reviewer">External Reviewer Auditor (reviewer)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: REGISTRY_DEPT]</label>
                                <input type="text" name="department" class="excel-grid-input" placeholder="e.g. Finance Sector, Engineering Division">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label font-monospace-gov small fw-bold mb-1" style="color: var(--gov-text);">[NEW_ROW: DIRECT_PHONE]</label>
                                <input type="text" name="phone" class="excel-grid-input" placeholder="e.g. +265...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light" style="border-top: 1px solid var(--excel-border);">
                        <button type="button" class="btn btn-sm gov-btn-secondary-outline px-3" data-bs-dismiss="modal">ABORT ROW INSERTION</button>
                        <button type="submit" class="btn btn-sm gov-btn-primary px-4">SAVE NEW RECORD ROW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    (function() {
        function initMatrixFilters() {
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.member-row');
            const noResultsRow = document.getElementById('noResultsRow');
            const filterCountOutput = document.getElementById('filterCount');

            if (!searchInput || !statusFilter) return;

            function processMatrixEvaluation() {
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
                    filterCountOutput.textContent = `INDEXED NODES: ${visibleCount} / ${tableRows.length} RECORDS RUNNING`;
                    noResultsRow.style.display = (visibleCount === 0) ? '' : 'none';
                }
            }

            searchInput.addEventListener('input', processMatrixEvaluation);
            statusFilter.addEventListener('change', processMatrixEvaluation);
            processMatrixEvaluation();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMatrixFilters);
        } else {
            initMatrixFilters();
        }
    })();
</script>