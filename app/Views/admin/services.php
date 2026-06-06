<style>
    .filter-toolbar {
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
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
    .search-input-group input:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    .status-select {
        border-radius: 0.5rem;
        border-color: #e2e8f0;
        color: #475569;
    }
    .status-select:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    .service-icon-box { 
        width: 44px; 
        height: 44px; 
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(56, 189, 248, 0.1);
        color: #0284c7;
        font-weight: 600;
        border-radius: 0.5rem; 
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    /* Toggle states for unified viewer */
    .modal-view-mode .form-control-plaintext { font-weight: 500; color: #1e293b; }
    .modal-view-mode .editable-field { display: none !important; }
    .modal-view-mode .view-only-badge { display: inline-block; }
    .modal-view-mode .modal-footer-edit { display: none !important; }

    .modal-edit-mode .static-text-field { display: none !important; }
    .modal-edit-mode .editable-field { display: block !important; }
    .modal-edit-mode .view-only-badge { display: none !important; }
    .modal-edit-mode .modal-footer-view { display: none !important; }
    
    /* Smooth custom drop transition for system notifications */
    .auto-dismiss-alert {
        transition: all 0.4s ease-in-out;
        opacity: 1;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1">Municipal Services Registry</h2>
        <p class="text-muted small mb-0">Manage public service pathways and process criteria from this unified screen.</p>
    </div>
    <div>
        <button type="button" class="btn btn-primary px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#createServiceModal">
            <i class="fas fa-plus me-2"></i>Add Service Pathway
        </button>
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

<div class="filter-toolbar p-3 mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-6 col-lg-4">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search by name, key, or department...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select">
                <option value="all">All Statuses</option>
                <option value="yes">Active Services</option>
                <option value="no">Inactive Services</option>
            </select>
        </div>
        <div class="col text-md-end text-muted small" id="filterCount"></div>
    </div>
</div>

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
                                <td><span class="fw-medium text-slate-700">$<?= esc(number_format($service['fee_amount'], 2)) ?></span></td>
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
                            <label class="form-label fw-medium small text-muted">Fee ($)</label>
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
                                <label class="form-check-label fw-medium">Active Immediately</label>
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
                            <label class="form-check-label small fw-semibold text-primary" for="enableEditToggle" style="cursor: pointer;">
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
                                    <span class="input-group-text">$</span>
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
                    // Use native Bootstrap alert dynamic disposal method
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertInstance);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 3000); // Triggers automatically after exactly 3 seconds
            });

            // --- 2. Client Search Filter ---
            function filterTable() {
                if (!searchInput || !statusFilter) return;
                const queryValue = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const searchableText = row.getAttribute('data-search');
                    const activeStatus = row.getAttribute('data-active');
                    if (searchableText.includes(queryValue) && (statusValue === 'all' || activeStatus === statusValue)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                if (filterCountOutput) filterCountOutput.textContent = `Showing ${visibleCount} of ${tableRows.length} services`;
            }
            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);

            // --- 3. Unified Modal Frame Engine ---
            const unifiedModalElement = document.getElementById('unifiedServiceModal');
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
                    editToggleSwitch.checked = false;
                }
            }

            document.querySelectorAll('.btn-view-service').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('.service-row');
                    const serviceId = row.getAttribute('data-id');

                    unifiedForm.action = `<?= base_url('admin/services') ?>/${serviceId}/edit`;

                    // Bind Display text properties
                    document.getElementById('view_service_name').textContent = row.getAttribute('data-name');
                    document.getElementById('view_service_key').textContent = row.getAttribute('data-key');
                    document.getElementById('view_department').textContent = row.getAttribute('data-dept');
                    document.getElementById('view_fee_amount').textContent = `$${parseFloat(row.getAttribute('data-fee')).toFixed(2)}`;
                    document.getElementById('view_processing_days').textContent = `${row.getAttribute('data-days')} Days`;
                    document.getElementById('view_sort_order').textContent = row.getAttribute('data-order');
                    document.getElementById('view_description').textContent = row.getAttribute('data-desc') || 'No description supplied.';
                    
                    const isActive = row.getAttribute('data-active') === 'yes';
                    document.getElementById('view_is_active_badge').innerHTML = isActive 
                        ? '<span class="badge bg-success bg-opacity-10 text-success">Listed / Active</span>' 
                        : '<span class="badge bg-secondary bg-opacity-10 text-secondary">Hidden / Suspended</span>';

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

            editToggleSwitch.addEventListener('change', function() {
                setModalMode(this.checked);
            });

            cancelEditBtn.addEventListener('click', function() {
                setModalMode(false);
            });
            
            if (filterCountOutput) filterTable();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initUnifiedCatalog);
        } else {
            initUnifiedCatalog();
        }
    })();
</script>