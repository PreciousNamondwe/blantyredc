<!-- ==========================================
     PRO-GRADE CIVIL INFRASTRUCTURE STYLING MATRIX
     ========================================== -->
<style>
    :root {
        /* Government & Institutional Brand Guide */
        --gov-navy-primary: #1a3352;
        --gov-navy-hover: #112237;
        --gov-gold: #d4af37;
        --gov-gold-light: #fdfaf2;
        --gov-border: #ccd4dc;
        --gov-bg-muted: #f5f7fa;
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
</style>

<!-- ==========================================
     TOP MASTER SYSTEM ADMINISTRATIVE BANNER
     ========================================== -->
<div class="gov-banner-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div class="gov-title-seal">
        <h4 class="fw-bold tracking-tight mb-1 text-uppercase text-white" style="letter-spacing: 0.5px;">
            District Development Projects Matrix
        </h4>
        <div class="small opacity-75 text-white font-monospace-gov" style="font-size: 0.75rem;">
            BLANTYRE DISTRICT COUNCIL &bull; REPUBLIC OF MALAWI CENTRAL INTEGRATED REGISTRY SYSTEM
        </div>
    </div>
    <div>
        <button type="button" class="btn btn-light px-3 fw-semibold shadow-sm" style="color: var(--gov-navy-primary); font-size: 0.85rem; border: 1px solid var(--gov-gold);" data-bs-toggle="modal" data-bs-target="#createProjectModal">
            <i class="fas fa-plus-square me-2 text-warning"></i>Initialize Project Track
        </button>
    </div>
</div>

<!-- ALERT FEEDBACK ENGINE CONTROLLER -->
<div id="alertWrapper" class="px-1 mt-3">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 gov-toast-alert p-3 mb-3 alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 gov-toast-alert p-3 mb-3 alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<!-- ADMINISTRATIVE FILTER TOOLBAR MATRIX -->
<div class="filter-toolbar-matrix">
    <div class="row g-3 align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search system node arrays by title, location, coordinator, asset catalog indices...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select-matrix">
                <option value="all">📁 All Directory Lifecycle Phases</option>
                <option value="planning">📋 Planning Stage Spec</option>
                <option value="ongoing">⚙️ Active Execution Node</option>
                <option value="completed">✅ Certified Complete Registry</option>
            </select>
        </div>
        <div class="col text-md-end text-muted font-monospace-gov small" id="filterCount" style="font-size: 0.8rem;"></div>
    </div>
</div>

<!-- ==========================================
     EXCEL GRID ENGINE WORKSPACE CONTAINER
     ========================================== -->
<div class="excel-card-container mb-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle excel-grid-table" id="projectsTable">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">Node</th>
                    <th>Project Reference Title</th>
                    <th>Structural Area Category</th>
                    <th>Geographic Boundary Area</th>
                    <th>Allocated Capital Envelope</th>
                    <th style="width: 160px;">Execution Matrix</th>
                    <th style="width: 120px;">Lifecycle Phase</th>
                    <th class="text-end" style="width: 140px; padding-right: 1.25rem;">Row Control</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($projects)): ?>
                    <tr id="noDataRow">
                        <td colspan="8" class="text-center text-muted py-5 bg-light">
                            <i class="fas fa-folder-open d-block mb-3 fa-2x opacity-50 text-secondary"></i>
                            <span class="font-monospace-gov small d-block">ERR_EMPTY_REGISTRY_SET</span>
                            <span class="small text-secondary">No active structural localized civil initiatives configured inside database logs.</span>
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
                            
                            <td class="text-center">
                                <div class="project-icon-box-matrix mx-auto">
                                    <i class="fas fa-landmark small"></i>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block" style="font-size: 0.875rem;"><?= esc($project['title']) ?></span>
                                <span class="text-muted font-monospace-gov d-block" style="font-size: 0.725rem;">ID: #_BLANTYRE_INIT_<?= esc($project['id']) ?></span>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border px-2 py-1 font-monospace-gov" style="font-size: 0.75rem;"><?= esc($project['category']) ?></span>
                            </td>
                            <td>
                                <span class="text-dark fw-medium"><i class="fas fa-map-marker-alt me-1 text-muted"></i> <?= esc($project['location']) ?></span>
                            </td>
                            <td>
                                <span class="font-monospace-gov fw-bold text-dark">$<?= esc(number_format((float)$project['budget'], 2)) ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px; border-radius: 2px; background-color: #e2e8f0;">
                                        <div class="progress-bar bg-success shadow-sm" role="progressbar" style="width: <?= esc($project['progress_percentage']) ?>%;"></div>
                                    </div>
                                    <span class="font-monospace-gov fw-bold text-secondary" style="font-size: 0.75rem;"><?= esc($project['progress_percentage']) ?>%</span>
                                </div>
                            </td>
                            <td>
                                <?php if ($project['status'] === 'planning'): ?>
                                    <span class="badge bg-warning text-dark border border-warning border-opacity-20 text-capitalize px-2 py-1 w-100 text-center" style="font-size: 0.725rem; font-weight: 600;">⚠️ Planning</span>
                                <?php elseif ($project['status'] === 'ongoing'): ?>
                                    <span class="badge bg-primary text-white border border-primary border-opacity-20 text-capitalize px-2 py-1 w-100 text-center" style="font-size: 0.725rem; font-weight: 600;">⚡ Ongoing</span>
                                <?php else: ?>
                                    <span class="badge bg-success text-white border border-success border-opacity-20 text-capitalize px-2 py-1 w-100 text-center" style="font-size: 0.725rem; font-weight: 600;">⚙️ Completed</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding-right: 1.25rem;">
                                <div class="d-flex gap-1 justify-content-end">
                                    <button type="button" class="btn btn-sm btn-light gov-btn-secondary-outline px-2 btn-view-project" style="padding-top: 2px; padding-bottom: 2px;">
                                        <i class="fas fa-folder-open me-1 text-primary"></i> Review
                                    </button>
                                    <form method="POST" action="<?= base_url('admin/projects/' . $project['id'] . '/delete') ?>" onsubmit="return confirm('CRITICAL COMPLIANCE NOTICE:\nAre you sure you want to completely clear file chart: [ <?= esc($project['title'], 'js') ?> ]?\nThis action purges structural historical indexes downstream permanently.');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2" style="padding-top: 2px; padding-bottom: 2px; border-color: rgba(220, 53, 69, 0.25);">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <tr id="noResultsRow" style="display: none;">
                    <td colspan="8" class="text-center text-muted py-5 bg-light">
                        <i class="fas fa-search-minus d-block mb-2 fa-2x opacity-50"></i>
                        <span class="font-monospace-gov small text-danger d-block">ZERO_DIR_MATCHES_DETECTED</span>
                        <div class="small">Query yielded zero index references inside current configuration bounds.</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ==========================================
     MODAL: SYSTEM TARGET PROJECT TRACTION FORM
     ========================================== -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white border-bottom" style="background-color: var(--gov-navy-primary); border-bottom: 3px solid var(--gov-gold) !important;">
                <h5 class="modal-title fw-bold text-uppercase tracking-wide" style="font-size: 0.95rem; letter-spacing: 0.5px;">
                    <i class="fas fa-file-invoice me-2 text-warning"></i>Initialize Strategic Project Registry Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('admin/projects/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Project Metric Identification Title</label>
                            <input type="text" name="title" class="excel-grid-input" required placeholder="e.g., Central Road Expansion Phase II">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Infrastructure Area Framework Matrix</label>
                            <input type="text" name="category" class="excel-grid-input" required placeholder="e.g., Transportation, Utilities, Civil Structural">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Development Boundary Demarcation Location</label>
                            <input type="text" name="location" class="excel-grid-input" required placeholder="e.g., Sector 4 Growth Point, Blantyre District">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark mb-1">Lifecycle Matrix State</label>
                            <select name="status" class="form-select status-select-matrix" style="padding: 6px 10px;" required>
                                <option value="planning" selected>Planning Spec</option>
                                <option value="ongoing">Active Execution</option>
                                <option value="completed">Certified Closeout</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark mb-1">Execution Index (%)</label>
                            <input type="number" name="progress_percentage" class="excel-grid-input font-monospace-gov" min="0" max="100" value="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark mb-1">Financial Capital Allocation ($)</label>
                            <input type="number" step="0.01" name="budget" class="excel-grid-input font-monospace-gov" placeholder="0.00" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark mb-1">Expended Capital Balance ($)</label>
                            <input type="number" step="0.01" name="spent_amount" class="excel-grid-input font-monospace-gov" placeholder="0.00" value="0.00">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark mb-1">Tracking Registry Inception</label>
                            <input type="date" name="start_date" class="excel-grid-input font-monospace-gov" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-dark mb-1">Target Assessment Closeout</label>
                            <input type="date" name="estimated_completion_date" class="excel-grid-input font-monospace-gov" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Lead Structural Engineering Contractor</label>
                            <input type="text" name="contractor" class="excel-grid-input" placeholder="Optional enterprise corp context identifier">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Capitalized Allocation Fund Source</label>
                            <input type="text" name="fund_source" class="excel-grid-input" placeholder="e.g., Municipal Capital Allocations, Federal Grant">
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-switch p-3 bg-white rounded border border-light shadow-sm">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input ms-0 me-2" type="checkbox" name="is_active" value="1" checked id="create_is_active">
                                <label class="form-check-label fw-bold small text-dark" for="create_is_active" style="cursor:pointer;">Publish profile context fields directly into the Central Corporate Directory</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Scope Statement / Execution Overview Technical Parameter Logs</label>
                            <textarea name="description" class="form-control excel-grid-input" style="border-radius:4px !important;" rows="4" required placeholder="Detail core baseline parameters, architectural structures, material limits or milestone metrics..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal">Cancel Session</button>
                    <button type="submit" class="btn btn-sm gov-btn-primary px-4 shadow-sm"><i class="fas fa-save me-2"></i>Inject Track Records</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     MODAL: UNIFIED COGNITIVE VIEW & EDIT SUITE
     ========================================== -->
<div class="modal fade modal-view-mode" id="unifiedProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <form method="POST" id="unifiedProjectForm" action="">
                <?= csrf_field() ?>
                
                <div class="modal-header text-white border-bottom d-flex justify-content-between align-items-center" style="background-color: var(--gov-navy-primary); border-bottom: 3px solid var(--gov-gold) !important;">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fw-bold text-uppercase tracking-wide me-3" id="modalTitleText" style="font-size: 0.95rem; letter-spacing: 0.5px;">
                            Project Registry Charter Profile
                        </h5>
                        <div class="form-check form-switch m-0 pt-1">
                            <input class="form-check-input btn-check-toggle-edit" type="checkbox" id="enableEditToggle" style="cursor: pointer;">
                            <label class="form-check-label small fw-bold text-warning" for="enableEditToggle" style="cursor: pointer; font-size: 0.8rem;">
                                <i class="fas fa-edit me-1"></i>Unlock Edit Layer
                            </label>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Project Specification Title</label>
                            <div class="static-text-field form-control-plaintext fs-6 fw-bold text-dark p-0 ps-1" id="view_title"></div>
                            <div class="editable-field">
                                <input type="text" name="title" id="edit_title" class="excel-grid-input" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Structural Infrastructure Field Category</label>
                            <div class="static-text-field form-control-plaintext font-monospace-gov p-0 ps-1 text-secondary" id="view_category"></div>
                            <div class="editable-field">
                                <input type="text" name="category" id="edit_category" class="excel-grid-input" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Geographic Segment Boundary Placement</label>
                            <div class="static-text-field form-control-plaintext p-0 ps-1 text-dark" id="view_location"></div>
                            <div class="editable-field">
                                <input type="text" name="location" id="edit_location" class="excel-grid-input" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Current Lifecycle Node State</label>
                            <div class="static-text-field form-control-plaintext text-capitalize fw-bold p-0 ps-1 text-primary" id="view_status"></div>
                            <div class="editable-field">
                                <select name="status" id="edit_status" class="form-select status-select-matrix" style="padding:6px 10px;" required>
                                    <option value="planning">Planning Spec</option>
                                    <option value="ongoing">Active Execution</option>
                                    <option value="completed">Certified Closeout</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Progress Index</label>
                            <div class="static-text-field form-control-plaintext font-monospace-gov fw-bold p-0 ps-1" id="view_progress_percentage"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <input type="number" name="progress_percentage" id="edit_progress_percentage" class="excel-grid-input font-monospace-gov" min="0" max="100" required>
                                    <span class="input-group-text bg-secondary text-white font-monospace-gov border-0 px-2" style="font-size:0.8rem;">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Authorized Capital Allocation</label>
                            <div class="static-text-field form-control-plaintext font-monospace-gov fw-bold text-success p-0 ps-1" id="view_budget"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <span class="input-group-text bg-success text-white border-0 px-2 font-monospace-gov" style="font-size:0.8rem;">$</span>
                                    <input type="number" step="0.01" name="budget" id="edit_budget" class="excel-grid-input font-monospace-gov" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Total Funds Expended</label>
                            <div class="static-text-field form-control-plaintext font-monospace-gov fw-bold text-danger p-0 ps-1" id="view_spent_amount"></div>
                            <div class="editable-field">
                                <div class="input-group">
                                    <span class="input-group-text bg-danger text-white border-0 px-2 font-monospace-gov" style="font-size:0.8rem;">$</span>
                                    <input type="number" step="0.01" name="spent_amount" id="edit_spent_amount" class="excel-grid-input font-monospace-gov">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Tracking Registry Entry</label>
                            <div class="static-text-field form-control-plaintext font-monospace-gov p-0 ps-1 text-dark" id="view_start_date"></div>
                            <div class="editable-field">
                                <input type="date" name="start_date" id="edit_start_date" class="excel-grid-input font-monospace-gov" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted mb-1">Target Phase Closeout</label>
                            <div class="static-text-field form-control-plaintext font-monospace-gov p-0 ps-1 text-dark" id="view_estimated_completion_date"></div>
                            <div class="editable-field">
                                <input type="date" name="estimated_completion_date" id="edit_estimated_completion_date" class="excel-grid-input font-monospace-gov" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Contracted Corporate Entity</label>
                            <div class="static-text-field form-control-plaintext p-0 ps-1 text-dark" id="view_contractor"></div>
                            <div class="editable-field">
                                <input type="text" name="contractor" id="edit_contractor" class="excel-grid-input">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Capital Ledger Funding Stream</label>
                            <div class="static-text-field form-control-plaintext p-0 ps-1 text-dark" id="view_fund_source"></div>
                            <div class="editable-field">
                                <input type="text" name="fund_source" id="edit_fund_source" class="excel-grid-input">
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center pt-2">
                            <div>
                                <label class="form-label fw-bold small text-muted d-block mb-1">Public Registry Clearance Status</label>
                                <div class="static-text-field" id="view_is_active_badge"></div>
                                <div class="editable-field form-check form-switch m-0">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="is_active" id="edit_is_active" value="1">
                                    <label class="form-check-label fw-bold text-dark small" for="edit_is_active" style="cursor:pointer;">Renders records clear and open to public portal catalogs</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label fw-bold small text-muted mb-1">Technical Scope Framework Parameters Statement</label>
                            <div class="static-text-field p-3 bg-white rounded border small text-secondary font-monospace-gov" style="white-space: pre-wrap; font-size:0.8rem; line-height:1.4;" id="view_description"></div>
                            <div class="editable-field">
                                <textarea name="description" id="edit_description" class="form-control excel-grid-input" rows="4" style="border-radius:4px !important;" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top modal-footer-view">
                    <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal">Close Profile Data</button>
                </div>

                <div class="modal-footer bg-white border-top modal-footer-edit">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btnCancelEdit">Discard Alterations</button>
                    <button type="submit" class="btn btn-sm btn-success px-4 shadow-sm"><i class="fas fa-database me-2"></i>Commit Recalibrated Grid Specs</button>
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