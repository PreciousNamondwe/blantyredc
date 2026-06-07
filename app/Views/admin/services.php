<style>
    /* ----------------------------------------------------
       MALAWI GOVERNMENT BRANDING & EXCEL INTERFACE TOKENS
       ---------------------------------------------------- */
    :root {
        --gov-navy-primary: #1a3352;
        --gov-navy-hover: #112237;
        --gov-gold: #d4af37;
        --gov-gold-light: #fdfaf2;
        --gov-border: #ccd4dc;
        --gov-text: #2d3748;
        
        /* Strict Excel Grid Architecture Settings */
        --excel-border: #d0d7de;
        --excel-header-bg: #f6f8fa;
    }

    /* Primary Heading Block */
    .registry-header-block {
        background: var(--gov-navy-primary);
        border: 1px solid var(--excel-border);
        border-bottom: 3px solid var(--gov-navy-hover);
        padding: 16px 20px;
        margin-bottom: -1px; /* Blends cleanly down into the grid filters */
        border-radius: 0px !important;
    }

    /* Action Grid Controls */
    .registry-action-bar {
        background: var(--gov-navy-hover);
        border: 1px solid var(--gov-gold);
        padding: 12px 16px;
        border-radius: 0px !important;
        margin-bottom: 24px;
    }

    /* Sharp Form Field Token Modifications */
    .registry-action-bar .form-control,
    .registry-action-bar .form-select {
        border: 1px solid var(--excel-border) !important;
        border-radius: 0px !important;
        font-size: 0.85rem !important;
        color: var(--gov-text) !important;
        height: 36px;
        background-color: #ffffff;
    }

    .registry-action-bar .form-control:focus,
    .registry-action-bar .form-select:focus,
    .modal-edit-mode .form-control:focus {
        border-color: var(--gov-navy-primary) !important;
        box-shadow: inset 0 0 0 1px var(--gov-gold) !important;
        outline: none;
    }

    /* Embedded Form Search Layout */
    .registry-search-box {
        position: relative;
    }
    
    .registry-search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #748296;
        font-size: 0.9rem;
    }

    .registry-search-box input {
        padding-left: 34px !important;
    }

    /* Government Action Buttons */
    .btn-gov-primary {
        background-color: var(--gov-navy-hover) !important;
        border: 1px solid var(--gov-navy-primary) !important;
        color: #ffffff !important;
        border-radius: 0px !important; /* Strict sharp corporate edge */
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        height: 36px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        transition: all 0.15s ease-in-out;
    }

    .btn-gov-primary:hover {
        background-color: var(--gov-navy-hover) !important;
        border-color: var(--gov-navy-hover) !important;
    }

    .btn-gov-primary i {
        color: var(--gov-gold) !important; /* Gold plus icon badge accent */
    }

    /* Excel Cell Readout */
    .registry-cell-counter {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        font-size: 0.75rem !important;
        font-weight: 700;
        color: #444d56;
        background: #ffffff;
        border: 1px solid var(--excel-border);
        padding: 6px 12px;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    /* Administrative Asset Box */
    .service-icon-box { 
        width: 38px !important; 
        height: 38px !important; 
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--excel-header-bg) !important;
        color: var(--gov-navy-primary) !important;
        font-weight: 700 !important;
        border-radius: 0px !important; 
        border: 1px solid var(--excel-border) !important;
    }

    /* Core Bootstrap Component Overrides to enforce Identity System */
    .btn-primary {
        background-color: var(--gov-navy-primary) !important;
        border-color: var(--gov-navy-primary) !important;
        color: #ffffff !important;
        border-radius: 0px !important;
        font-weight: 500 !important;
    }
    .btn-primary:hover {
        background-color: var(--gov-navy-hover) !important;
        border-color: var(--gov-navy-hover) !important;
    }
    .btn-outline-primary {
        border-color: var(--gov-navy-primary) !important;
        color: var(--gov-navy-primary) !important;
        border-radius: 0px !important;
    }
    .btn-outline-primary:hover {
        background-color: var(--gov-navy-primary) !important;
        color: #ffffff !important;
    }
    .btn-outline-secondary {
        border-color: var(--excel-border) !important;
        color: var(--gov-text) !important;
        border-radius: 0px !important;
    }
    .btn-outline-secondary:hover {
        background-color: var(--excel-header-bg) !important;
    }
    .btn-outline-danger {
        border-radius: 0px !important;
    }
    .btn-success {
        background-color: #2e7d32 !important;
        border-color: #2e7d32 !important;
        border-radius: 0px !important;
    }

    /* Strict Sheet Grid Strategy */
    .dashboard-card {
        border: 1px solid var(--excel-border) !important;
        border-radius: 0px !important;
        box-shadow: none !important;
    }
    .table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
    }
    .table th {
        background-color: var(--excel-header-bg) !important;
        color: #24292f !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase;
        border: 1px solid var(--excel-border) !important;
        padding: 8px 12px !important;
    }
    .table td {
        border: 1px solid var(--excel-border) !important;
        padding: 8px 12px !important; 
        font-size: 0.85rem !important;
        color: var(--gov-text) !important;
        background-color: #ffffff;
    }
    .table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Form Overrides inside Modals */
    .modal-content {
        border: 1px solid var(--excel-border) !important;
        border-radius: 0px !important;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    .modal-header {
        background: linear-gradient(135deg, var(--gov-navy-primary) 0%, #2c4d75 100%) !important;
        border-bottom: 4px solid var(--gov-gold) !important;
        border-radius: 0px !important;
    }
    .modal-header .modal-title {
        color: #ffffff !important;
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .modal-header .form-check-label {
        color: #ffffff !important;
    }
    
    .modal-edit-mode .form-control {
        border: 1px solid var(--excel-border) !important;
        border-radius: 0px !important;
        font-size: 0.85rem !important;
    }
    .modal-edit-mode .input-group-text {
        background-color: var(--excel-header-bg) !important;
        border: 1px solid var(--excel-border) !important;
        border-radius: 0px !important;
        font-size: 0.85rem;
    }
    .modal-footer {
        border-radius: 0px !important;
    }

    /* Fixed System Toast Configurations */
    .auto-dismiss-alert {
        position: fixed;
        top: 25px;
        right: 25px;
        z-index: 1060;
        min-width: 350px;
        border-radius: 0px !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        border: none !important;
        border-left: 4px solid transparent !important;
        transition: all 0.4s ease-in-out;
        opacity: 1;
    }
    .auto-dismiss-alert.alert-success { border-left-color: #2f855a !important; background-color: #f0fff4 !important; color: #22543d !important; }
    .auto-dismiss-alert.alert-danger { border-left-color: #c53030 !important; background-color: #fff5f5 !important; color: #742a2a !important; }

    /* Structural View/Edit toggles */
    .modal-view-mode .form-control-plaintext { font-weight: 600; color: var(--gov-text); padding-left: 4px; }
    .modal-view-mode .editable-field { display: none !important; }
    .modal-view-mode .view-only-badge { display: inline-block; }
    .modal-view-mode .modal-footer-edit { display: none !important; }

    .modal-edit-mode .static-text-field { display: none !important; }
    .modal-edit-mode .editable-field { display: block !important; }
    .modal-edit-mode .view-only-badge { display: none !important; }
    .modal-edit-mode .modal-footer-view { display: none !important; }
</style>

<!-- 1. REGISTRY HEADER PROFILE BLOCK -->
<div class="registry-header-block d-flex justify-content-between align-items-center">
    <div>
        <div class="text-uppercase text-light fw-bold text-muted small tracking-wider mb-1" style="font-size: 0.7rem; letter-spacing: 1px;">
            Malawi Government • Local Government Framework
        </div>
        <h3 class="fw-bold text-uppercase m-0 text-light" style="font-size: 1.4rem; letter-spacing: -0.3px;">Municipal Services Registry</h3>
    </div>
    <div>
        <button type="button" class="btn btn-gov-primary" data-bs-toggle="modal" data-bs-target="#createServiceModal">
            <i class="fas fa-plus-square me-2"></i> Add Service Pathway
        </button>
    </div>
</div>

<!-- 2. REGISTRY INTERFACE GRID BAR -->
<div class="registry-action-bar">
    <div class="row g-2 align-items-center">
        <!-- Search Cell Input -->
        <div class="col-md-5 col-lg-4">
            <div class="registry-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search parameters (Name, Key, Dept)...">
            </div>
        </div>
        
        <!-- Status Filter Selection Dropdown -->
        <div class="col-md-3 col-lg-2">
            <select id="statusFilter" class="form-select">
                <option value="all">All Registry Statuses</option>
                <option value="yes">Active Status [SYS.ACTIVE]</option>
                <option value="no">Inactive Status [SYS.LOCKED]</option>
            </select>
        </div>

        
    </div>
</div>

<div id="alertWrapper">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 alert-dismissible fade show auto-dismiss-alert" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4 alert-dismissible fade show auto-dismiss-alert" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<!-- DATA GRID MODULE -->
<div class="card dashboard-card mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="servicesTable">
                <thead>
                    <tr>
                        <th style="width: 80px; padding-left: 1.5rem;">Key</th>
                        <th>Service Name</th>
                        <th>Department</th>
                        <th>Fee Amount</th>
                        <th>Processing Time</th>
                        <th>Active</th>
                        <th class="text-end" style="padding-right: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($services)): ?>
                        <tr id="noDataRow">
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-concierge-bell d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No municipal services configured yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($services as $service): ?>
                            <tr class="service-row" 
                                id="service-row-<?= $service['id'] ?>"
                                data-search="<?= strtolower(esc($service['service_name'] . ' ' . $service['service_key'] . ' ' . $service['department'])) ?>"
                                data-active="<?= $service['is_active'] ? 'yes' : 'no' ?>"
                                data-id="<?= $service['id'] ?>"
                                data-key="<?= esc($service['service_key']) ?>"
                                data-name="<?= esc($service['service_name']) ?>"
                                data-dept="<?= esc($service['department']) ?>"
                                data-fee="<?= esc($service['fee_amount']) ?>"
                                data-days="<?= esc($service['processing_days']) ?>"
                                data-order="<?= esc($service['sort_order']) ?>"
                                data-desc="<?= esc($service['description']) ?>">
                                <td style="padding-left: 1.5rem;">
                                    <div class="service-icon-box">
                                        <span class="small text-uppercase"><?= esc(substr($service['service_key'], 0, 3)) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block"><?= esc($service['service_name']) ?></span>
                                    <span class="text-muted mini small"><?= esc($service['service_key']) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= esc($service['department']) ?></span></td>
                                <td><span class="fw-medium text-slate-700">MWK <?= esc(number_format($service['fee_amount'], 2)) ?></span></td>
                                <td><span class="text-slate-600"><i class="far fa-clock me-1 text-muted"></i> <?= esc($service['processing_days']) ?> Days</span></td>
                                <td>
                                    <?= $service['is_active'] ? '<span class="badge bg-success bg-opacity-10 text-success">Yes</span>' : '<span class="badge bg-secondary bg-opacity-10 text-secondary">No</span>' ?>
                                </td>
                                <td style="padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary px-3 btn-view-service">
                                            <i class="fas fa-eye me-1"></i> View & Manage
                                        </button>
                                        <form method="POST" action="<?= base_url('admin/services/' . $service['id'] . '/delete') ?>" onsubmit="return confirm('Delete <?= esc($service['service_name'], 'js') ?>?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- CREATION REGISTRY PATHWAY MODAL -->
<div class="modal fade" id="createServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-bottom">
                <h5 class="modal-title fw-bold text-slate-800">Register Public Service Pathway</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('admin/services/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Service Key</label>
                            <input type="text" name="service_key" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Service Name</label>
                            <input type="text" name="service_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Department</label>
                            <input type="text" name="department" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Fee (MWK)</label>
                            <input type="number" step="0.01" name="fee_amount" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Processing Time (Days)</label>
                            <input type="number" name="processing_days" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>
                        <div class="col-md-6 d-flex align-items-end mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                <label class="form-check-label fw-medium text-dark">Active Immediately</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Description / Prerequisites</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Map Into Catalog</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- UNIFIED MANAGEMENT REGISTRY MODAL -->
<div class="modal fade modal-view-mode" id="unifiedServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            
            <form method="POST" id="unifiedServiceForm" action="">
                <?= csrf_field() ?>
                
                <div class="modal-header bg-light border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fw-bold text-slate-800 me-3" id="modalTitleText">Service Pathway Profile</h5>
                        <div class="form-check form-switch m-0 pt-1">
                            <input class="form-check-input btn-check-toggle-edit" type="checkbox" id="enableEditToggle">
                            <label class="form-check-label small fw-semibold" for="enableEditToggle" style="cursor: pointer;">
                                <i class="fas fa-edit me-1"></i>Edit Mode
                            </label>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Service Name</label>
                            <div class="static-text-field form-control-plaintext fs-5 fw-bold text-dark" id="view_service_name"></div>
                            <div class="editable-field">
                                <input type="text" name="service_name" id="edit_service_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Service Identifier Key</label>
                            <div class="static-text-field form-control-plaintext text-secondary font-monospace" id="view_service_key"></div>
                            <div class="editable-field">
                                <input type="text" name="service_key" id="edit_service_key" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Department Assigned</label>
                            <div class="static-text-field form-control-plaintext" id="view_department"></div>
                            <div class="editable-field">
                                <input type="text" name="department" id="edit_department" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Processing Fee</label>
                            <div class="static-text-field form-control-plaintext fw-bold text-success" id="view_fee_amount"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <span class="input-group-text">MWK</span>
                                    <input type="number" step="0.01" name="fee_amount" id="edit_fee_amount" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Processing Time</label>
                            <div class="static-text-field form-control-plaintext" id="view_processing_days"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <input type="number" name="processing_days" id="edit_processing_days" class="form-control" required>
                                    <span class="input-group-text">Days</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Sort Registry Weight</label>
                            <div class="static-text-field form-control-plaintext" id="view_sort_order"></div>
                            <div class="editable-field">
                                <input type="number" name="sort_order" id="edit_sort_order" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center pt-3">
                            <div>
                                <label class="form-label fw-medium small text-muted d-block mb-1">Visibility Status</label>
                                <div class="static-text-field" id="view_is_active_badge"></div>
                                <div class="editable-field form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                                    <label class="form-check-label fw-semibold text-slate-700" for="edit_is_active">Active & Visible Publicly</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label fw-medium small text-muted mb-1">Catalog Description / Dynamic Prerequisites</label>
                            <div class="static-text-field p-3 bg-light rounded border small text-secondary" style="white-space: pre-wrap;" id="view_description"></div>
                            <div class="editable-field">
                                <textarea name="description" id="edit_description" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-view">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-edit">
                    <button type="button" class="btn btn-outline-secondary" id="btnCancelEdit">Cancel Edit</button>
                    <button type="submit" class="btn btn-success px-4 shadow-sm"><i class="fas fa-save me-2"></i>Apply Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        function initUnifiedCatalog() {
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.service-row');
            const filterCountOutput = document.getElementById('filterCount');

            // --- 1. System Notification Auto-Dismiss Routine ---
            const targetAlerts = document.querySelectorAll('.auto-dismiss-alert');
            targetAlerts.forEach(function(alertInstance) {
                setTimeout(function() {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertInstance);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 4000); 
            });

            // --- 2. Client Search Filter ---
            function filterTable() {
                if (!searchInput || !statusFilter) return;
                const queryValue = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const searchableText = row.getAttribute('data-search') || '';
                    const activeStatus = row.getAttribute('data-active') || '';
                    if (searchableText.includes(queryValue) && (statusValue === 'all' || activeStatus === statusValue)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                if (filterCountOutput) filterCountOutput.textContent = `ROW COUNT: ${visibleCount} RECORD(S) FOUND`;
            }
            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);

            // --- 3. Unified Modal Frame Engine ---
            const unifiedModalElement = document.getElementById('unifiedServiceModal');
            if (!unifiedModalElement) return;

            const unifiedModal = new bootstrap.Modal(unifiedModalElement);
            const editToggleSwitch = document.getElementById('enableEditToggle');
            const unifiedForm = document.getElementById('unifiedServiceForm');
            const cancelEditBtn = document.getElementById('btnCancelEdit');

            function setModalMode(isEditMode) {
                if (isEditMode) {
                    unifiedModalElement.classList.remove('modal-view-mode');
                    unifiedModalElement.classList.add('modal-edit-mode');
                    document.getElementById('modalTitleText').innerHTML = '<i class="fas fa-pen-alt text-warning me-2"></i>Modify Service Details';
                } else {
                    unifiedModalElement.classList.remove('modal-edit-mode');
                    unifiedModalElement.classList.add('modal-view-mode');
                    document.getElementById('modalTitleText').innerHTML = 'Service Pathway Profile';
                    if (editToggleSwitch) editToggleSwitch.checked = false;
                }
            }

            document.querySelectorAll('.btn-view-service').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('.service-row');
                    const serviceId = row.getAttribute('data-id');

                    if (unifiedForm) {
                        unifiedForm.action = `<?= base_url('admin/services') ?>/${serviceId}/edit`;
                    }

                    // Bind Display text properties
                    document.getElementById('view_service_name').textContent = row.getAttribute('data-name');
                    document.getElementById('view_service_key').textContent = row.getAttribute('data-key');
                    document.getElementById('view_department').textContent = row.getAttribute('data-dept');
                    document.getElementById('view_fee_amount').textContent = `MWK ${parseFloat(row.getAttribute('data-fee')).toFixed(2)}`;
                    document.getElementById('view_processing_days').textContent = `${row.getAttribute('data-days')} Days`;
                    document.getElementById('view_sort_order').textContent = row.getAttribute('data-order');
                    document.getElementById('view_description').textContent = row.getAttribute('data-desc') || 'No description supplied.';
                    
                    const isActive = row.getAttribute('data-active') === 'yes';
                    document.getElementById('view_is_active_badge').innerHTML = isActive 
                        ? '<span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-2 py-1">ACTIVE</span>' 
                        : '<span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20 px-2 py-1">INACTIVE</span>';

                    // Synchronize Inputs
                    document.getElementById('edit_service_name').value = row.getAttribute('data-name');
                    document.getElementById('edit_service_key').value = row.getAttribute('data-key');
                    document.getElementById('edit_department').value = row.getAttribute('data-dept');
                    document.getElementById('edit_fee_amount').value = row.getAttribute('data-fee');
                    document.getElementById('edit_processing_days').value = row.getAttribute('data-days');
                    document.getElementById('edit_sort_order').value = row.getAttribute('data-order');
                    document.getElementById('edit_description').value = row.getAttribute('data-desc');
                    document.getElementById('edit_is_active').checked = isActive;

                    setModalMode(false);
                    unifiedModal.show();
                });
            });

            if (editToggleSwitch) {
                editToggleSwitch.addEventListener('change', function() {
                    setModalMode(this.checked);
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function() {
                    setModalMode(false);
                });
            }
            
            if (filterCountOutput) filterTable();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initUnifiedCatalog);
        } else {
            initUnifiedCatalog();
        }
    })();
</script>