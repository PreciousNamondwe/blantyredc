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
    .project-icon-box { 
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
    
    /* Toggle states for unified view/edit layout modal */
    .modal-view-mode .form-control-plaintext { font-weight: 500; color: #1e293b; }
    .modal-view-mode .editable-field { display: none !important; }
    .modal-view-mode .modal-footer-edit { display: none !important; }

    .modal-edit-mode .static-text-field { display: none !important; }
    .modal-edit-mode .editable-field { display: block !important; }
    .modal-edit-mode .modal-footer-view { display: none !important; }
    
    .auto-dismiss-alert {
        transition: all 0.4s ease-in-out;
        opacity: 1;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1">District Development Projects</h2>
        <p class="text-muted small mb-0">Monitor, evaluate, and adjust local civil initiatives and structural project criteria.</p>
    </div>
    <div>
        <button type="button" class="btn btn-primary px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#createProjectModal">
            <i class="fas fa-plus me-2"></i>Add Project Initiative
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
                <input type="text" id="tableSearch" class="form-control" placeholder="Search by title, location, category, contractor...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select">
                <option value="all">All Lifecycles</option>
                <option value="planning">Planning Phase</option>
                <option value="ongoing">Ongoing Execution</option>
                <option value="completed">Completed Projects</option>
            </select>
        </div>
        <div class="col text-md-end text-muted small" id="filterCount"></div>
    </div>
</div>

<div class="card dashboard-card mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="projectsTable">
                <thead>
                    <tr>
                        <th style="width: 80px; padding-left: 1.5rem;">Icon</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Budget Allocated</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th class="text-end" style="padding-right: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($projects)): ?>
                        <tr id="noDataRow">
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-map-marked-alt d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No civil development initiatives registered in this system yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($projects as $project): ?>
                            <tr class="project-row" 
                                id="project-row-<?= $project['id'] ?>"
                                data-search="<?= strtolower(esc($project['title'] . ' ' . $project['location'] . ' ' . $project['category'] . ' ' . ($project['contractor'] ?? ''))) ?>"
                                data-lifecycle="<?= esc($project['status']) ?>"
                                data-id="<?= $project['id'] ?>"
                                data-title="<?= esc($project['title']) ?>"
                                data-location="<?= esc($project['location']) ?>"
                                data-category="<?= esc($project['category']) ?>"
                                data-status="<?= esc($project['status']) ?>"
                                data-progress="<?= esc($project['progress_percentage']) ?>"
                                data-start="<?= esc($project['start_date']) ?>"
                                data-completion="<?= esc($project['estimated_completion_date']) ?>"
                                data-budget="<?= esc($project['budget']) ?>"
                                data-spent="<?= esc($project['spent_amount'] ?? '0.00') ?>"
                                data-contractor="<?= esc($project['contractor'] ?? '') ?>"
                                data-fund="<?= esc($project['fund_source'] ?? '') ?>"
                                data-active="<?= esc($project['is_active']) ?>"
                                data-desc="<?= esc($project['description']) ?>">
                                <td style="padding-left: 1.5rem;">
                                    <div class="project-icon-box">
                                        <i class="fas fa-city small"></i>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block"><?= esc($project['title']) ?></span>
                                    <span class="text-muted mini small">System Node Reference #<?= esc($project['id']) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= esc($project['category']) ?></span></td>
                                <td><span class="text-slate-700"><i class="fas fa-map-marker-alt me-1 text-muted"></i> <?= esc($project['location']) ?></span></td>
                                <td><span class="fw-medium text-slate-800">$<?= esc(number_format((float)$project['budget'], 2)) ?></span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress w-100" style="height: 6px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= esc($project['progress_percentage']) ?>%;"></div>
                                        </div>
                                        <span class="small fw-semibold"><?= esc($project['progress_percentage']) ?>%</span>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($project['status'] === 'planning'): ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning text-capitalize">Planning</span>
                                    <?php elseif ($project['status'] === 'ongoing'): ?>
                                        <span class="badge bg-primary bg-opacity-10 text-primary text-capitalize">Ongoing</span>
                                    <?php else: ?>
                                        <span class="badge bg-success bg-opacity-10 text-success text-capitalize">Completed</span>
                                    <?php endif; ?>
                                </td>
                                <td style="padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary px-3 btn-view-project">
                                            <i class="fas fa-eye me-1"></i> View & Manage
                                        </button>
                                        <form method="POST" action="<?= base_url('admin/projects/' . $project['id'] . '/delete') ?>" onsubmit="return confirm('Delete project chart: <?= esc($project['title'], 'js') ?>? operational histories will clear permanently.');">
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
                    
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fas fa-search d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                            No matching projects detected in standard directory indices.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-bottom">
                <h5 class="modal-title fw-bold text-slate-800">Initialize Project Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('admin/projects/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Project Title</label>
                            <input type="text" name="title" class="form-control" required placeholder="e.g., Central Road Expansion Phase II">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Infrastructure Category Area</label>
                            <input type="text" name="category" class="form-control" required placeholder="e.g., Transportation, Utilities">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Development Location Area</label>
                            <input type="text" name="location" class="form-control" required placeholder="e.g., Sector 4 Growth Point">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Current Status Field</label>
                            <select name="status" class="form-select status-select" required>
                                <option value="planning" selected>Planning</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Execution Progress (%)</label>
                            <input type="number" name="progress_percentage" class="form-control" min="0" max="100" value="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Financial Budget ($)</label>
                            <input type="number" step="0.01" name="budget" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Spent Budget Amount ($)</label>
                            <input type="number" step="0.01" name="spent_amount" class="form-control" placeholder="0.00" value="0.00">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Start Tracking Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted">Est. Completion Target</label>
                            <input type="date" name="estimated_completion_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Assigned Engineering Contractor</label>
                            <input type="text" name="contractor" class="form-control" placeholder="Optional contractor company name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Capital Funding Source</label>
                            <input type="text" name="fund_source" class="form-control" placeholder="e.g., Municipal Bonds, Federal Grant">
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="create_is_active">
                                <label class="form-check-label fw-medium" for="create_is_active">Render Visible in Directory Catalogs Publicly</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Scope Statement / Execution Overview</label>
                            <textarea name="description" class="form-control" rows="4" required placeholder="Detail baseline execution parameters, structural bounds, or metric milestones..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Launch Project Track</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-view-mode" id="unifiedProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form method="POST" id="unifiedProjectForm" action="">
                <?= csrf_field() ?>
                
                <div class="modal-header bg-light border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fw-bold text-slate-800 me-3" id="modalTitleText">Project Charter Profile</h5>
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
                            <label class="form-label fw-medium small text-muted mb-1">Project Title</label>
                            <div class="static-text-field form-control-plaintext fs-5 fw-bold text-dark" id="view_title"></div>
                            <div class="editable-field">
                                <input type="text" name="title" id="edit_title" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Infrastructure Category</label>
                            <div class="static-text-field form-control-plaintext font-monospace" id="view_category"></div>
                            <div class="editable-field">
                                <input type="text" name="category" id="edit_category" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Development Location</label>
                            <div class="static-text-field form-control-plaintext" id="view_location"></div>
                            <div class="editable-field">
                                <input type="text" name="location" id="edit_location" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Current Lifecycle Phase</label>
                            <div class="static-text-field form-control-plaintext text-capitalize fw-bold" id="view_status"></div>
                            <div class="editable-field">
                                <select name="status" id="edit_status" class="form-select status-select" required>
                                    <option value="planning">Planning</option>
                                    <option value="ongoing">Ongoing</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Execution Progress</label>
                            <div class="static-text-field form-control-plaintext" id="view_progress_percentage"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <input type="number" name="progress_percentage" id="edit_progress_percentage" class="form-control" min="0" max="100" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Financial Budget</label>
                            <div class="static-text-field form-control-plaintext fw-bold text-success" id="view_budget"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="budget" id="edit_budget" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Capital Amount Expended</label>
                            <div class="static-text-field form-control-plaintext fw-bold text-danger" id="view_spent_amount"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="spent_amount" id="edit_spent_amount" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Tracking Start Date</label>
                            <div class="static-text-field form-control-plaintext" id="view_start_date"></div>
                            <div class="editable-field">
                                <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium small text-muted mb-1">Target End Date</label>
                            <div class="static-text-field form-control-plaintext" id="view_estimated_completion_date"></div>
                            <div class="editable-field">
                                <input type="date" name="estimated_completion_date" id="edit_estimated_completion_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Assigned Engineering Contractor</label>
                            <div class="static-text-field form-control-plaintext" id="view_contractor"></div>
                            <div class="editable-field">
                                <input type="text" name="contractor" id="edit_contractor" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Capital Funding Source</label>
                            <div class="static-text-field form-control-plaintext" id="view_fund_source"></div>
                            <div class="editable-field">
                                <input type="text" name="fund_source" id="edit_fund_source" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center pt-2">
                            <div>
                                <label class="form-label fw-medium small text-muted d-block mb-1">Catalog Registry Visibility</label>
                                <div class="static-text-field" id="view_is_active_badge"></div>
                                <div class="editable-field form-check form-switch m-0">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                                    <label class="form-check-label fw-semibold text-slate-700" for="edit_is_active">Publish and list on directories publicly</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label fw-medium small text-muted mb-1">Scope Statement / Execution Overview</label>
                            <div class="static-text-field p-3 bg-light rounded border small text-secondary" style="white-space: pre-wrap;" id="view_description"></div>
                            <div class="editable-field">
                                <textarea name="description" id="edit_description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-view">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close Profile</button>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-edit">
                    <button type="button" class="btn btn-outline-secondary" id="btnCancelEdit">Cancel Edit</button>
                    <button type="submit" class="btn btn-success px-4 shadow-sm"><i class="fas fa-save me-2"></i>Recalibrate Specs</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        function initProjectDashboard() {
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.project-row');
            const noResultsRow = document.getElementById('noResultsRow');
            const filterCountOutput = document.getElementById('filterCount');

            // --- 1. Notification Alert Box Dismiss Trigger Engine ---
            const targetAlerts = document.querySelectorAll('.auto-dismiss-alert');
            targetAlerts.forEach(function(alertInstance) {
                setTimeout(function() {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertInstance);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 3000);
            });

            // --- 2. Live Client Search Filter Router ---
            function filterTable() {
                if (!searchInput || !statusFilter) return;
                const queryValue = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const searchableText = row.getAttribute('data-search');
                    const lifecycleStatus = row.getAttribute('data-lifecycle');
                    
                    const matchesSearch = searchableText.includes(queryValue);
                    const matchesStatus = (statusValue === 'all' || lifecycleStatus === statusValue);

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (filterCountOutput) {
                    filterCountOutput.textContent = `Showing ${visibleCount} of ${tableRows.length} project items`;
                }
                
                if (noResultsRow) {
                    noResultsRow.style.display = (visibleCount === 0 && tableRows.length > 0) ? '' : 'none';
                }
            }
            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);

            // --- 3. Single-Modal View/Edit Engine Routing ---
            const unifiedModalElement = document.getElementById('unifiedProjectModal');
            const unifiedModal = new bootstrap.Modal(unifiedModalElement);
            const editToggleSwitch = document.getElementById('enableEditToggle');
            const unifiedForm = document.getElementById('unifiedProjectForm');
            const cancelEditBtn = document.getElementById('btnCancelEdit');

            function setModalMode(isEditMode) {
                if (isEditMode) {
                    unifiedModalElement.classList.remove('modal-view-mode');
                    unifiedModalElement.classList.add('modal-edit-mode');
                    document.getElementById('modalTitleText').innerHTML = '<i class="fas fa-sliders-h text-warning me-2"></i>Recalibrate Project Profile';
                } else {
                    unifiedModalElement.classList.remove('modal-edit-mode');
                    unifiedModalElement.classList.add('modal-view-mode');
                    document.getElementById('modalTitleText').innerHTML = 'Project Charter Profile';
                    editToggleSwitch.checked = false;
                }
            }

            document.querySelectorAll('.btn-view-project').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('.project-row');
                    const projectId = row.getAttribute('data-id');

                    // Map specific routing endpoint for operational storage update
                    unifiedForm.action = `<?= base_url('admin/projects') ?>/${projectId}/edit`;

                    // Bind Display Data Nodes
                    document.getElementById('view_title').textContent = row.getAttribute('data-title');
                    document.getElementById('view_category').textContent = row.getAttribute('data-category');
                    document.getElementById('view_location').textContent = row.getAttribute('data-location');
                    document.getElementById('view_status').textContent = row.getAttribute('data-status');
                    document.getElementById('view_progress_percentage').textContent = `${row.getAttribute('data-progress')}%`;
                    document.getElementById('view_budget').textContent = `$${parseFloat(row.getAttribute('data-budget')).toFixed(2)}`;
                    document.getElementById('view_spent_amount').textContent = `$${parseFloat(row.getAttribute('data-spent') || 0).toFixed(2)}`;
                    document.getElementById('view_start_date').textContent = row.getAttribute('data-start');
                    document.getElementById('view_estimated_completion_date').textContent = row.getAttribute('data-completion');
                    document.getElementById('view_contractor').textContent = row.getAttribute('data-contractor') || 'Not Disclosed';
                    document.getElementById('view_fund_source').textContent = row.getAttribute('data-fund') || 'General Consolidated Fund';
                    document.getElementById('view_description').textContent = row.getAttribute('data-desc');
                    
                    const isActive = row.getAttribute('data-active') == '1';
                    document.getElementById('view_is_active_badge').innerHTML = isActive 
                        ? '<span class="badge bg-success bg-opacity-10 text-success">Publicly Visible</span>' 
                        : '<span class="badge bg-secondary bg-opacity-10 text-secondary">Registry Hidden</span>';

                    // Sync Form Inputs
                    document.getElementById('edit_title').value = row.getAttribute('data-title');
                    document.getElementById('edit_category').value = row.getAttribute('data-category');
                    document.getElementById('edit_location').value = row.getAttribute('data-location');
                    document.getElementById('edit_status').value = row.getAttribute('data-status');
                    document.getElementById('edit_progress_percentage').value = row.getAttribute('data-progress');
                    document.getElementById('edit_budget').value = row.getAttribute('data-budget');
                    document.getElementById('edit_spent_amount').value = row.getAttribute('data-spent');
                    document.getElementById('edit_start_date').value = row.getAttribute('data-start');
                    document.getElementById('edit_estimated_completion_date').value = row.getAttribute('data-completion');
                    document.getElementById('edit_contractor').value = row.getAttribute('data-contractor');
                    document.getElementById('edit_fund_source').value = row.getAttribute('data-fund');
                    document.getElementById('edit_description').value = row.getAttribute('data-desc');
                    document.getElementById('edit_is_active').checked = isActive;

                    // Revert to pristine reading environment view layout state
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
            
            filterTable();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initProjectDashboard);
        } else {
            initProjectDashboard();
        }
    })();
</script>