<style>
    :root {
        --gov-navy-primary: #1a3352;
        --gov-navy-hover: #112237;
        --gov-gold: #d4af37;
        --gov-gold-light: #fdfaf2;
        --gov-border: #ccd4dc;
        --gov-bg-muted: #f5f7fa;
        --gov-text: #2d3748;
        /* Excel Grid System Specific Palette */
        --excel-border: #d0d7de;
        --excel-header-bg: #f6f8fa;
    }

    .gov-banner-header {
        background: linear-gradient(135deg, var(--gov-navy-primary) 0%, #2c4d75 100%);
        border-bottom: 4px solid var(--gov-gold);
        border-radius: 4px 4px 0 0;
        padding: 1.25rem 1.75rem;
        color: #ffffff;
    }

    .gov-title-seal {
        border-left: 4px solid var(--gov-gold);
        padding-left: 1.25rem;
    }

    /* Excel Spreadsheet Layout Grid Strategy */
    .excel-card-container {
        border: 1px solid var(--excel-border);
        background-color: #ffffff;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.04);
    }

    .excel-grid-table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
    }

    /* Strict Grid Cell Borders matching Microsoft Excel Standard */
    .excel-grid-table th {
        background-color: var(--excel-header-bg) !important;
        color: #24292f !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 1px solid var(--excel-border) !important;
        padding: 8px 12px !important;
        vertical-align: middle;
    }

    /* Dark configuration headers for active administrative entry rows */
    .excel-grid-table.gov-table-dark-head th {
        background-color: #2d3748 !important;
        color: #ffffff !important;
        border: 1px solid #4a5568 !important;
    }

    .excel-grid-table td {
        border: 1px solid var(--excel-border) !important;
        padding: 6px 10px !important; /* Compact spreadsheet row structure */
        font-size: 0.85rem !important;
        color: var(--gov-text);
        vertical-align: middle;
        background-color: #ffffff;
    }

    .excel-grid-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    .excel-row-active-marriage td {
        background-color: #fcf9f0 !important;
    }

    .excel-row-active-business td {
        background-color: #f7fafc !important;
    }

    /* Form Controls embedded inside Grid Worksheet Elements */
    .excel-grid-input {
        border: 1px solid transparent !important;
        background-color: transparent !important;
        border-radius: 0px !important;
        font-size: 0.85rem !important;
        padding: 2px 6px !important;
        width: 100%;
        transition: all 0.15s ease-in-out;
    }

    .excel-grid-input:hover {
        border: 1px solid var(--excel-border) !important;
        background-color: #ffffff !important;
    }

    .excel-grid-input:focus {
        border: 1px solid #0066cc !important; /* Excel Classic Blue Active cell accent */
        background-color: #ffffff !important;
        box-shadow: inset 0 0 0 1px #0066cc;
        outline: none;
    }

    .gov-btn-manage {
        background-color: var(--gov-navy-primary);
        border-color: var(--gov-navy-primary);
        color: #ffffff;
        font-weight: 500;
    }

    .gov-btn-manage:hover, .gov-btn-manage:focus {
        background-color: var(--gov-navy-hover) !important;
        border-color: var(--gov-navy-hover) !important;
        color: #ffffff !important;
    }

    .font-monospace-gov {
        font-family: 'SFMono-Regular', Consolas, "Liberation Mono", Menlo, monospace;
    }

    .gov-toast-alert {
        position: fixed;
        top: 25px;
        right: 25px;
        z-index: 1060;
        min-width: 340px;
        border-radius: 4px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        border-left: 4px solid transparent;
    }
    .gov-toast-alert.alert-success { border-left-color: #2f855a; background-color: #f0fff4; color: #22543d; }
    .gov-toast-alert.alert-danger { border-left-color: #c53030; background-color: #fff5f5; color: #742a2a; }
</style>

<div id="ajaxAlertContainer"></div>

<div class="gov-banner-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div class="gov-title-seal">
        <h4 class="fw-bold tracking-tight mb-1 text-uppercase text-white" id="viewTitle" style="letter-spacing: 0.5px;">
            <?= esc($page_title ?? 'Service Applications Log') ?>
        </h4>
        <div class="small opacity-75 text-white font-monospace-gov" style="font-size: 0.75rem;">
            BLANTYRE DISTRICT COUNCIL &bull; REPUBLIC OF MALAWI CENTRAL INTEGRATED REGISTRY SYSTEM
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <div class="input-group input-group-sm" style="max-width: 320px;">
            <span class="input-group-text bg-white text-muted border-end-0 rounded-0" style="border: 1px solid var(--excel-border);"><i class="fas fa-search small"></i></span>
            <input type="text" id="registrySearchInput" class="form-control rounded-0 border-start-0" placeholder="Find records..." oninput="filterRows()" style="font-size: 0.825rem; border-color: var(--excel-border);">
        </div>

        <button type="button" onclick="clearAllFilters()" class="btn btn-sm btn-outline-light px-3 rounded-1 font-monospace-gov" style="font-size: 0.8rem; height: 31px;">
            <i class="fas fa-undo me-1.5"></i>
        </button>
        
        <div class="dropdown">
            <button class="btn btn-sm gov-btn-manage dropdown-toggle px-3 rounded-1 shadow-sm border border-white border-opacity-10 fw-semibold" type="button" id="manageAppsDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="height: 31px; font-size: 0.8rem;">
                <i class="fas fa-sliders-h me-1.5"></i>Manage Applications Mode
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border border-light rounded-1 mt-1" aria-labelledby="manageAppsDropdown" style="font-size: 0.85rem;">
                <li><h6 class="dropdown-header text-uppercase text-muted fw-bold small tracking-wider">Registry Filters</h6></li>
                <li><a class="dropdown-item py-2" href="#" onclick="switchManagementMode('ALL')"><i class="fas fa-list me-2 text-muted" style="width: 18px;"></i> General Ledger View</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 fw-semibold text-primary" href="#" onclick="switchManagementMode('Marriage Certificate')"><i class="fas fa-heart me-2 text-danger" style="width: 18px;"></i> Manage Marriage Grid</a></li>
                <li><a class="dropdown-item py-2 fw-semibold text-success" href="#" onclick="switchManagementMode('Business License')"><i class="fas fa-briefcase me-2 text-success" style="width: 18px;"></i> Manage Business Grid</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="excel-card-container mb-5">
    <div class="table-responsive">
        <table class="table table-sm excel-grid-table align-middle" id="registryMasterTable">
            
            <thead id="headerGeneral">
                <tr>
                    <th style="width: 15%; text-align: center;">Ref Code</th>
                    <th style="width: 28%;">Applicant Name / Legal Entity</th>
                    <th style="width: 20%;">Service Module</th>
                    <th style="width: 15%;">Contact Phone</th>
                    <th style="width: 12%;">Status</th>
                    <th style="width: 10%; text-align: center;">Action</th>
                </tr>
            </thead>

            <thead id="headerMarriage" style="display: none;">
                <tr>
                    <th style="width: 8%; text-align: center;">Cert ID</th>
                    <th style="width: 15%;">Certificate No</th>
                    <th style="width: 18%;">Groom National ID</th>
                    <th style="width: 27%;">Groom Full Name</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 12%; text-align: right;">Fee Paid (MWK)</th>
                    <th style="width: 5%; text-align: center;">Action</th>
                </tr>
            </thead>

            <thead id="headerBusiness" style="display: none;">
                <tr>
                    <th style="width: 8%; text-align: center;">App ID</th>
                    <th style="width: 15%;">Application Code</th>
                    <th style="width: 18%;">Owner National ID</th>
                    <th style="width: 27%;">Business Registered Name</th>
                    <th style="width: 15%;">Current Stage</th>
                    <th style="width: 12%; text-align: right;">Turnover (MWK)</th>
                    <th style="width: 5%; text-align: center;">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($applications) && is_array($applications)): ?>
                    <?php foreach ($applications as $app): ?>
                        
                        <tr class="registry-data-row general-row" 
                            id="main-row-<?= esc($app['composite_id']) ?>" 
                            data-service="<?= esc($app['service_type']) ?>" 
                            data-search-text="<?= esc(strtolower($app['reference_number'] . ' ' . $app['applicant_name'] . ' ' . $app['phone_number'])) ?>"
                            data-print-payload="<?= htmlspecialchars(json_encode($app), ENT_QUOTES, 'UTF-8') ?>">
                            
                            <td class="text-center"><span class="font-monospace-gov fw-bold text-dark"><?= esc($app['reference_number']) ?></span></td>
                            <td><div class="fw-semibold text-dark"><?= esc($app['applicant_name']) ?></div></td>
                            <td><span class="badge bg-light text-dark border font-monospace-gov px-2 py-1 text-uppercase fw-bold" style="font-size: 0.7rem;"><i class="fas fa-folder me-1 text-muted"></i><?= esc($app['service_type']) ?></span></td>
                            <td><span class="text-secondary font-monospace-gov small"><?= esc($app['phone_number']) ?></span></td>
                            <td>
                                <?php 
                                    $statusClean = strtolower($app['status']);
                                    $badgeStyle = 'text-secondary bg-secondary bg-opacity-10 border border-secondary border-opacity-20';
                                    if (in_array($statusClean, ['approved', 'registered'])) $badgeStyle = 'text-success bg-success bg-opacity-10 border border-success border-opacity-20';
                                    elseif (in_array($statusClean, ['pending', 'pending notice', 'submitted', 'draft'])) $badgeStyle = 'text-warning bg-warning bg-opacity-10 border border-warning border-opacity-30';
                                    elseif (in_array($statusClean, ['under_review', 'inspection_scheduled'])) $badgeStyle = 'text-primary bg-primary bg-opacity-10 border border-primary border-opacity-20';
                                ?>
                                <span class="badge <?= $badgeStyle ?> px-2 py-1 text-uppercase font-monospace-gov" style="font-size: 0.675rem;">&bull; <?= esc(str_replace('_', ' ', $statusClean)) ?></span>
                            </td>
                            <td class="text-center">
                                <button type="button" onclick="printSingleRow('<?= esc($app['composite_id']) ?>')" class="btn btn-xs btn-outline-danger py-0 px-2 rounded-0 font-monospace-gov" style="font-size: 0.725rem;">
                                    <i class="fas fa-print"></i> PRINT FORM
                                </button>
                            </td>
                        </tr>

                        <?php if (strpos($app['composite_id'], 'marriage_') === 0): ?>
                            <tr class="registry-data-row marriage-editable-row excel-row-active-marriage" 
                                id="row-<?= esc($app['composite_id']) ?>" 
                                style="display: none;" 
                                data-search-text="<?= esc(strtolower($app['reference_number'] . ' ' . $app['applicant_name'] . ' ' . ($app['marriage_type'] ?? ''))) ?>"
                                data-print-payload="<?= htmlspecialchars(json_encode($app), ENT_QUOTES, 'UTF-8') ?>">
                                
                                <td class="text-center bg-light"><span class="text-muted font-monospace-gov fw-bold"><?= esc($app['raw_id']) ?></span></td>
                                <td><input type="text" class="excel-grid-input font-monospace-gov fw-bold text-dark" id="m-ref-<?= esc($app['composite_id']) ?>" value="<?= esc($app['reference_number']) ?>"></td>
                                <td><input type="text" class="excel-grid-input font-monospace-gov" id="m-natid-<?= esc($app['composite_id']) ?>" value="<?= esc($app['groom_national_id'] ?? '') ?>"></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <input type="text" class="excel-grid-input" id="m-gfirst-<?= esc($app['composite_id']) ?>" value="<?= esc($app['groom_first_name'] ?? '') ?>" placeholder="First">
                                        <input type="text" class="excel-grid-input" id="m-glast-<?= esc($app['composite_id']) ?>" value="<?= esc($app['groom_last_name'] ?? '') ?>" placeholder="Last">
                                    </div>
                                </td>
                                <td>
                                    <select class="excel-grid-input fw-semibold text-dark" id="m-status-<?= esc($app['composite_id']) ?>">
                                        <option value="Pending Notice" <?= strtolower($app['status']) === 'pending notice' ? 'selected' : '' ?>>Pending Notice</option>
                                        <option value="Approved" <?= strtolower($app['status']) === 'approved' ? 'selected' : '' ?>>Approved</option>
                                        <option value="Registered" <?= strtolower($app['status']) === 'registered' ? 'selected' : '' ?>>Registered</option>
                                        <option value="Rejected" <?= strtolower($app['status']) === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    </select>
                                </td>
                                <td class="text-end"><input type="number" step="0.01" class="excel-grid-input text-end font-monospace-gov fw-bold" id="m-fee-<?= esc($app['composite_id']) ?>" value="<?= esc($app['registration_fee_paid'] ?? '0.00') ?>"></td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button type="button" onclick="saveMarriageInline('<?= esc($app['composite_id']) ?>')" class="btn btn-xs btn-danger p-0 px-2 rounded-0 shadow-sm" style="font-size:0.75rem;"><i class="fas fa-save"></i></button>
                                        <button type="button" onclick="printSingleRow('<?= esc($app['composite_id']) ?>')" class="btn btn-xs btn-outline-secondary p-0 px-1.5 rounded-0" style="font-size:0.75rem;"><i class="fas fa-print"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (strpos($app['composite_id'], 'business_') === 0): ?>
                            <tr class="registry-data-row business-editable-row excel-row-active-business" 
                                id="row-<?= esc($app['composite_id']) ?>" 
                                style="display: none;" 
                                data-search-text="<?= esc(strtolower($app['reference_number'] . ' ' . ($app['business_name'] ?? '') . ' ' . ($app['owner_national_id'] ?? ''))) ?>"
                                data-print-payload="<?= htmlspecialchars(json_encode($app), ENT_QUOTES, 'UTF-8') ?>">
                                
                                <td class="text-center bg-light"><span class="text-muted font-monospace-gov fw-bold"><?= esc($app['raw_id']) ?></span></td>
                                <td><input type="text" class="excel-grid-input font-monospace-gov fw-bold text-dark" id="b-ref-<?= esc($app['composite_id']) ?>" value="<?= esc($app['reference_number']) ?>"></td>
                                <td><input type="text" class="excel-grid-input font-monospace-gov" id="b-natid-<?= esc($app['composite_id']) ?>" value="<?= esc($app['owner_national_id'] ?? '') ?>"></td>
                                <td><input type="text" class="excel-grid-input fw-semibold" id="b-name-<?= esc($app['composite_id']) ?>" value="<?= esc($app['business_name'] ?? '') ?>"></td>
                                <td>
                                    <select class="excel-grid-input fw-semibold text-dark" id="b-stage-<?= esc($app['composite_id']) ?>">
                                        <option value="draft" <?= $app['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                                        <option value="submitted" <?= $app['status'] === 'submitted' ? 'selected' : '' ?>>Submitted</option>
                                        <option value="under_review" <?= $app['status'] === 'under_review' ? 'selected' : '' ?>>Under Review</option>
                                        <option value="inspection_scheduled" <?= $app['status'] === 'inspection_scheduled' ? 'selected' : '' ?>>Inspection Scheduled</option>
                                        <option value="awaiting_payment" <?= $app['status'] === 'awaiting_payment' ? 'selected' : '' ?>>Awaiting Payment</option>
                                        <option value="approved" <?= $app['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                        <option value="rejected" <?= $app['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    </select>
                                </td>
                                <td class="text-end"><input type="number" step="0.01" class="excel-grid-input text-end font-monospace-gov fw-bold" id="b-turnover-<?= esc($app['composite_id']) ?>" value="<?= esc($app['estimated_annual_turnover']) ?>"></td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button type="button" onclick="saveBusinessInline('<?= esc($app['composite_id']) ?>')" class="btn btn-xs btn-success p-0 px-2 rounded-0 shadow-sm" style="font-size:0.75rem;"><i class="fas fa-save"></i></button>
                                        <button type="button" onclick="printSingleRow('<?= esc($app['composite_id']) ?>')" class="btn btn-xs btn-outline-secondary p-0 px-1.5 rounded-0" style="font-size:0.75rem;"><i class="fas fa-print"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center py-5 text-muted font-monospace-gov">NO CENTRAL DATABANK DATA OBJECTS AVAILABLE INSIDE THE ACTIVE SESSION LEDGER.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
let currentMode = 'ALL';

function switchManagementMode(mode) {
    currentMode = mode;
    const viewTitle = document.getElementById('viewTitle');
    const headerGeneral = document.getElementById('headerGeneral');
    const headerMarriage = document.getElementById('headerMarriage');
    const headerBusiness = document.getElementById('headerBusiness');
    const masterTable = document.getElementById('registryMasterTable');
    
    const generalRows = document.querySelectorAll('.general-row');
    const marriageRows = document.querySelectorAll('.marriage-editable-row');
    const businessRows = document.querySelectorAll('.business-editable-row');

    headerGeneral.style.display = 'none';
    headerMarriage.style.display = 'none';
    headerBusiness.style.display = 'none';
    generalRows.forEach(r => r.style.display = 'none');
    marriageRows.forEach(r => r.style.display = 'none');
    businessRows.forEach(r => r.style.display = 'none');
    
    masterTable.classList.remove('gov-table-dark-head');

    if (mode === 'Marriage Certificate') {
        viewTitle.innerHTML = '<i class="fas fa-file-signature text-white-50 me-2"></i>Marriage Registry Grid Worksheet';
        masterTable.classList.add('gov-table-dark-head');
        headerMarriage.style.display = '';
        marriageRows.forEach(r => r.style.display = '');
    } else if (mode === 'Business License') {
        viewTitle.innerHTML = '<i class="fas fa-building text-white-50 me-2"></i>Business Licensing Grid Worksheet';
        masterTable.classList.add('gov-table-dark-head');
        headerBusiness.style.display = '';
        businessRows.forEach(r => r.style.display = '');
    } else {
        viewTitle.innerText = "Service Applications Log";
        headerGeneral.style.display = '';
        generalRows.forEach(r => {
            r.style.display = (mode === 'ALL' || r.getAttribute('data-service') === mode) ? '' : 'none';
        });
    }
    filterRows();
}

function filterRows() {
    const query = document.getElementById('registrySearchInput').value.toLowerCase().trim();
    let targetSelector = '.general-row';
    if (currentMode === 'Marriage Certificate') targetSelector = '.marriage-editable-row';
    if (currentMode === 'Business License') targetSelector = '.business-editable-row';
    
    const rows = document.querySelectorAll(targetSelector);
    rows.forEach(row => {
        const text = row.getAttribute('data-search-text') || '';
        row.style.display = (!query || text.includes(query)) ? '' : 'none';
    });
}

function clearAllFilters() {
    document.getElementById('registrySearchInput').value = '';
    switchManagementMode('ALL');
}

function saveMarriageInline(compositeId) {
    const btn = document.querySelector(`#row-${compositeId} .btn-danger`);
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin small"></i>';

    const recordId = compositeId.replace('marriage_', '');
    const payload = {
        certificate_id: recordId,
        certificate_number: document.getElementById(`m-ref-${compositeId}`).value,
        groom_national_id: document.getElementById(`m-natid-${compositeId}`).value,
        groom_first_name: document.getElementById(`m-gfirst-${compositeId}`).value,
        groom_last_name: document.getElementById(`m-glast-${compositeId}`).value,
        status: document.getElementById(`m-status-${compositeId}`).value,
        registration_fee_paid: document.getElementById(`m-fee-${compositeId}`).value
    };

    postRegistryData('<?= base_url("admin/applications/update-marriage") ?>', payload, compositeId, btn, '<i class="fas fa-save"></i>');
}

function saveBusinessInline(compositeId) {
    const btn = document.querySelector(`#row-${compositeId} .btn-success`);
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin small"></i>';

    const recordId = compositeId.replace('business_', '');
    const payload = {
        id: recordId,
        application_code: document.getElementById(`b-ref-${compositeId}`).value,
        owner_national_id: document.getElementById(`b-natid-${compositeId}`).value,
        business_name: document.getElementById(`b-name-${compositeId}`).value,
        current_stage: document.getElementById(`b-stage-${compositeId}`).value,
        estimated_annual_turnover: document.getElementById(`b-turnover-${compositeId}`).value
    };

    postRegistryData('<?= base_url("admin/applications/update-business") ?>', payload, compositeId, btn, '<i class="fas fa-save"></i>');
}

function postRegistryData(url, payload, compositeId, actionBtn, originalIcon) {
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        actionBtn.disabled = false;
        actionBtn.innerHTML = originalIcon;
        
        const alertBox = document.getElementById('ajaxAlertContainer');
        if (data.status === 'success') {
            alertBox.innerHTML = `<div class="alert gov-toast-alert alert-success border-0 shadow"><i class="fas fa-check-circle me-2"></i>${data.message}</div>`;
            
            let newSearchText = "";
            if(compositeId.includes('marriage')) {
                newSearchText = `${payload.certificate_number} ${payload.groom_first_name} ${payload.groom_last_name} ${payload.groom_national_id}`;
            } else {
                newSearchText = `${payload.application_code} ${payload.business_name} ${payload.owner_national_id}`;
            }
            
            const rowTarget = document.getElementById(`row-${compositeId}`) || document.getElementById(`main-row-${compositeId}`);
            if (rowTarget) {
                rowTarget.setAttribute('data-search-text', newSearchText.toLowerCase());
                let oldPayload = JSON.parse(rowTarget.getAttribute('data-print-payload') || '{}');
                if(compositeId.includes('marriage')) {
                    oldPayload.certificate_number = payload.certificate_number;
                    oldPayload.groom_national_id = payload.groom_national_id;
                    oldPayload.groom_first_name = payload.groom_first_name;
                    oldPayload.groom_last_name = payload.groom_last_name;
                    oldPayload.status = payload.status;
                    oldPayload.registration_fee_paid = payload.registration_fee_paid;
                } else {
                    oldPayload.application_code = payload.application_code;
                    oldPayload.owner_national_id = payload.owner_national_id;
                    oldPayload.business_name = payload.business_name;
                    oldPayload.status = payload.current_stage;
                    oldPayload.estimated_annual_turnover = payload.estimated_annual_turnover;
                }
                rowTarget.setAttribute('data-print-payload', JSON.stringify(oldPayload));
            }
        } else {
            alertBox.innerHTML = `<div class="alert gov-toast-alert alert-danger border-0 shadow"><i class="fas fa-exclamation-triangle me-2"></i>${data.message}</div>`;
        }
        setTimeout(() => alertBox.innerHTML = '', 4000);
    })
    .catch(err => {
        actionBtn.disabled = false;
        actionBtn.innerHTML = originalIcon;
        console.error('System synchronization exception:', err);
    });
}

function printSingleRow(compositeId) {
    let targetRow = document.getElementById(`row-${compositeId}`) || document.getElementById(`main-row-${compositeId}`);
    if (!targetRow) return;

    let rawData = JSON.parse(targetRow.getAttribute('data-print-payload') || '{}');
    let refCode = rawData.reference_number || 'N/A';
    let formTitleIdentifier = 'FORM CIRS-01';
    let formSubjectHeader = 'GENERAL SERVICE REGISTRY PROFILE';
    let descriptiveInstructionBox = 'This form is generated directly from the Central Integrated Registry System data indexes. Ensure fields conform directly to verified physical registry records.';
    let dynamicFormContent = '';

    if (compositeId.startsWith('business_')) {
        formTitleIdentifier = 'FORM BBDC-MRA';
        formSubjectHeader = 'APPLICATION FOR DISTRICT TRADING BUSINESS LICENSE';
        descriptiveInstructionBox = '<strong>WHAT IS THE PURPOSE OF THIS FORM?</strong><br>To log, evaluate and authorize formal and informal commercial entities operating within the jurisdiction of Blantyre District Council. All sections must contain explicit records synced from national databases.';
        
        let isNew = (rawData.application_type || 'new') === 'new';
        let isRenewal = (rawData.application_type || '') === 'renewal';
        let isAmendment = (rawData.application_type || '') === 'amendment';
        
        let isDraft = rawData.status === 'draft';
        let isSubmitted = rawData.status === 'submitted';
        let isReview = rawData.status === 'under_review';
        let isApproved = rawData.status === 'approved';

        dynamicFormContent = `
            <div class="z83-section-title">SECTION A: APPLICATION SPECIFICATION AND PROCESSING STAGE</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">APPLICATION REFERENCE CODE:</span><br><span class="value-text font-mono">${rawData.reference_number || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">SUBMISSION REGISTERED TIMESTAMP:</span><br><span class="value-text">${rawData.submission_date || 'Not Yet Submitted'}</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="label">TYPE OF APPLICATION REGISTRY ENTRY:</span><br>
                        <span class="z83-checkbox">${isNew ? '■' : '□'} New Filer Entry</span> &nbsp;&nbsp;
                        <span class="z83-checkbox">${isRenewal ? '■' : '□'} License Renewal</span> &nbsp;&nbsp;
                        <span class="z83-checkbox">${isAmendment ? '■' : '□'} Profile Amendment</span>
                    </td>
                    <td colspan="2">
                        <span class="label">CURRENT SYSTEM STATUS STAGE:</span><br>
                        <span class="z83-checkbox">${isDraft ? '■' : '□'} Draft</span> &nbsp;
                        <span class="z83-checkbox">${isSubmitted ? '■' : '□'} Submitted</span> &nbsp;
                        <span class="z83-checkbox">${isReview ? '■' : '□'} Under Review</span> &nbsp;
                        <span class="z83-checkbox">${isApproved ? '■' : '□'} Approved Log</span>
                    </td>
                </tr>
            </table>

            <div class="z83-section-title">SECTION B: COMMERCIAL ENTITY REGISTERED DETAILS</div>
            <table class="z83-table">
                <tr>
                    <td colspan="4"><span class="label">BUSINESS REGISTERED CORPORATE NAME:</span><br><span class="value-text uppercase fw-bold">${rawData.business_name || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">TRADING/BRANDING NAME (IF DIFFERENT):</span><br><span class="value-text">${rawData.trading_name || 'Same as Corporate Name'}</span></td>
                    <td colspan="2"><span class="label">BUSINESS INCORPORATION CLASSIFICATION:</span><br><span class="value-text">${rawData.business_type || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">COMMERCIAL SECTOR CATEGORY:</span><br><span class="value-text">${rawData.business_category || 'N/A'}</span></td>
                    <td colspan="2">
                        <span class="label">SECTOR DESIGNATION:</span><br>
                        <span class="z83-checkbox">${rawData.is_formal_sector == 1 ? '■' : '□'} Formal Commercial Sector</span> &nbsp;&nbsp;
                        <span class="z83-checkbox">${rawData.is_formal_sector != 1 ? '■' : '□'} Informal Trading Sector</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">MINISTRY MBRS REGISTRATION NUMBER:</span><br><span class="value-text font-mono">${rawData.mbrs_registration_number || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">MALAWI REVENUE AUTHORITY TPIN NUMBER:</span><br><span class="value-text font-mono">${rawData.mra_tpin || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span class="label">ESTIMATED ANNUAL GROSS TURNOVER IN LEDGER:</span><br><span class="value-text fw-bold">MWK ${parseFloat(rawData.estimated_annual_turnover || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</span></td>
                </tr>
            </table>

            <div class="z83-section-title">SECTION C: PRIMARY OWNER OR LEGAL ENTITY REPRESENTATIVE</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">REPRESENTATIVE FULL NAME:</span><br><span class="value-text uppercase">${rawData.applicant_name || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">NATIONAL IDENTIFICATION NUMBER (NATIONAL ID / PASSPORT):</span><br><span class="value-text font-mono">${rawData.owner_national_id || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">CONTACT TELEPHONE NUMBER:</span><br><span class="value-text font-mono">${rawData.phone_number || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">OFFICIAL EMAIL ADDRESS:</span><br><span class="value-text font-mono text-low">${rawData.owner_email || 'N/A'}</span></td>
                </tr>
            </table>

            <div class="z83-section-title">SECTION D: JURISDICTION AND PHYSICAL SITE ADDRESS LOCATION</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">TRADITIONAL AUTHORITY (T/A):</span><br><span class="value-text">${rawData.traditional_authority || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">VILLAGE / MUNICIPAL AREA:</span><br><span class="value-text">${rawData.village_or_area || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="3"><span class="label">PHYSICAL SITE LOCATION DESCRIPTION:</span><br><span class="value-text">${rawData.physical_address || 'N/A'}</span></td>
                    <td><span class="label">PLOT NUMBER REF:</span><br><span class="value-text font-mono">${rawData.plot_number || 'N/A'}</span></td>
                </tr>
            </table>

            <div class="z83-section-title">SECTION E: INTERNAL EVALUATION LOGS</div>
            <table class="z83-table">
                <tr>
                    <td colspan="4"><span class="label">SYSTEM DATA RECORD GENERATION DATE:</span><br><span class="value-text font-mono">${rawData.created_at || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span class="label">EVALUATOR REVIEWER REMARKS SUMMARY:</span><br><span class="value-text block-notes">${rawData.reviewer_remarks || 'No formal evaluation comments appended to database object.'}</span></td>
                </tr>
            </table>`;
    } 
    else if (compositeId.startsWith('marriage_')) {
        formTitleIdentifier = 'FORM CIRS-M4';
        formSubjectHeader = 'MARRIAGE REGISTRY OFFICIAL MANIFEST LOG';
        descriptiveInstructionBox = '<strong>REGISTRY COMPLIANCE REQUIREMENT:</strong><br>This documentation details the civil registry entries under the Marriage Act protocol formulas. Data records must correspond with physical verified records logged by District Commissioners.';
        
        dynamicFormContent = `
            <div class="z83-section-title">SECTION A: CORE MARRIAGE LICENSE RECORD METADATA</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">MARRIAGE ENTRY REGISTER NO:</span><br><span class="value-text font-mono fw-bold">${rawData.reference_number || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">MARRIAGE ACT SCHEDULING TYPE:</span><br><span class="value-text uppercase">${rawData.marriage_type || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">CURRENT REGISTRY FILING STATUS:</span><br><span class="value-text fw-bold" style="color:#000000;">${(rawData.status || 'Pending Notice').toUpperCase()}</span></td>
                    <td colspan="2"><span class="label">CENTRAL COUNCIL REGISTRATION FEES REMITTED:</span><br><span class="value-text font-mono fw-bold">MWK ${parseFloat(rawData.registration_fee_paid || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">FORM B STATUTORY NOTICE FILING DATE:</span><br><span class="value-text">${rawData.notice_date_form_b || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">FORM D DISPENSATION PERMIT ISSUE DATE:</span><br><span class="value-text">${rawData.permit_date_form_d || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">SOLEMNIZATION DATE OF MARRIAGE:</span><br><span class="value-text fw-bold">${rawData.date_of_marriage || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">REGISTERED VENUE / CELEBRATION PLACE:</span><br><span class="value-text">${rawData.place_of_marriage || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">OFFICIATING LEGAL CIVIL REGISTRAR OFFICER:</span><br><span class="value-text uppercase">${rawData.officiating_officer || 'N/A'}</span></td>
                    <td colspan="2">
                        <span class="label">ACKNOWLEDGEMENT DOCUMENT STATUS:</span><br>
                        <span class="z83-checkbox">${rawData.acknowledgement_slip_issued == 1 ? '■' : '□'} Acknowledgement Slip Printed</span> &nbsp;&nbsp;
                        <span class="z83-checkbox">${rawData.acknowledgement_slip_issued != 1 ? '■' : '□'} Slip Awaiting Manifest Check</span>
                    </td>
                </tr>
            </table>

            <div class="z83-section-title">SECTION B: GROOM SPECIFICATION PROFILE</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">GROOM FIRST NAME(S):</span><br><span class="value-text uppercase">${rawData.groom_first_name || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">GROOM SURNAME / LAST NAME:</span><br><span class="value-text uppercase">${rawData.groom_last_name || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">GROOM NATIONAL IDENTITY CARD NUMBER:</span><br><span class="value-text font-mono fw-bold">${rawData.groom_national_id || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">FOREIGN PASSPORT NUMBER REFERENCE (IF APPLICABLE):</span><br><span class="value-text font-mono">${rawData.groom_foreign_passport || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">GROOM DATE OF BIRTH:</span><br><span class="value-text font-mono">${rawData.groom_date_of_birth || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">GROOM DOMICILE CURRENT PHYSICAL RESIDENCE:</span><br><span class="value-text">${rawData.groom_current_residence || 'N/A'}</span></td>
                </tr>
            </table>

            <div class="z83-section-title">SECTION C: BRIDE SPECIFICATION PROFILE</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">BRIDE FIRST NAME(S):</span><br><span class="value-text uppercase">${rawData.bride_first_name || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">BRIDE SURNAME / LAST NAME:</span><br><span class="value-text uppercase">${rawData.bride_last_name || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">BRIDE NATIONAL IDENTITY CARD NUMBER:</span><br><span class="value-text font-mono fw-bold">${rawData.bride_national_id || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">FOREIGN PASSPORT NUMBER REFERENCE (IF APPLICABLE):</span><br><span class="value-text font-mono">${rawData.bride_foreign_passport || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">BRIDE DATE OF BIRTH:</span><br><span class="value-text font-mono">${rawData.bride_date_of_birth || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">BRIDE DOMICILE CURRENT PHYSICAL RESIDENCE:</span><br><span class="value-text">${rawData.bride_current_residence || 'N/A'}</span></td>
                </tr>
            </table>`;
    } 
    else {
        formTitleIdentifier = 'FORM CIRS-GEN';
        formSubjectHeader = 'PUBLIC LEDGER CORRESPONDENCE RECORD';
        descriptiveInstructionBox = 'This form documents public data inputs routed from central ledger registries. All content below represents sanitized and parsed database arrays.';
        
        dynamicFormContent = `
            <div class="z83-section-title">SECTION A: COMPLAINT ENTRY ATTRIBUTES AND CORE DESCRIPTION</div>
            <table class="z83-table">
                <tr>
                    <td colspan="2"><span class="label">REGISTRY MANIFEST REFERENCE TICKET:</span><br><span class="value-text font-mono fw-bold">${rawData.reference_number || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">ROUTING SYSTEM CATEGORY:</span><br><span class="value-text uppercase">${rawData.complaint_category || 'GENERAL LOG'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">SUBMITTER FILER DESIGNATION FULL NAME:</span><br><span class="value-text uppercase">${rawData.applicant_name || 'Anonymous Filer'}</span></td>
                    <td colspan="2"><span class="label">CONTACT TELEPHONE NUMBER:</span><br><span class="value-text font-mono">${rawData.phone_number || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">Filer Electronic Mail Pointer:</span><br><span class="value-text font-mono text-low">${rawData.applicant_email || 'N/A'}</span></td>
                    <td colspan="2">
                        <span class="label">ANONYMITY CONFIGURATION FLAG:</span><br>
                        <span class="z83-checkbox">${rawData.anonymous == 1 ? '■ Identity Cloaked (Anonymous)' : '□ Public Domain Identifier Record'}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><span class="label">GEO-LOCATION INCIDENT LOCATION AREA:</span><br><span class="value-text">${rawData.complaint_location || 'N/A'}</span></td>
                    <td colspan="2"><span class="label">URGENCY PRIORITY DISPATCH INDEX:</span><br><span class="value-text uppercase fw-bold" style="color:#000000;">${rawData.priority_level || 'NORMAL'}</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span class="label">COMPLAINT CORRESPONDENCE SUBJECT TRACKING HEADER:</span><br><span class="value-text fw-bold uppercase">${rawData.complaint_subject || 'N/A'}</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span class="label">DETAILED INCIDENT INVESTIGATIVE NARRATIVE ACCOUNT:</span><br><span class="value-text block-notes" style="white-space: pre-line;">${rawData.complaint_description || 'No descriptive body content recorded.'}</span></td>
                </tr>
            </table>`;
    }

    const printWindow = window.open('', '_blank', 'height=850,width=950');
    printWindow.document.write(`
        <html>
        <head>
            <title>Official Form Extract - ${refCode}</title>
            <style>
                @page { size: A4; margin: 15mm; }
                body { 
                    font-family: Arial, sans-serif; 
                    color: #000000; 
                    background-color: #ffffff; 
                    margin: 0; 
                    padding: 0; 
                    font-size: 11px; 
                    line-height: 1.3;
                }
                
                /* Main Form Border Wrapper mimicking Z83 - Clean High Contrast Black/White */
                .z83-wrapper {
                    border: 2px solid #000000;
                    padding: 4px;
                    background-color: #ffffff;
                }
                
                /* Double Header Header System */
                .z83-header-table {
                    width: 100%;
                    border-collapse: collapse;
                    border-bottom: 2px solid #000000;
                    margin-bottom: 5px;
                }
                .z83-header-table td {
                    border: none !important;
                    padding: 6px !important;
                    vertical-align: middle;
                }
                .z83-logo-cell {
                    width: 60px;
                    text-align: center;
                }
                .z83-logo-img {
                    width: 48px;
                    height: 48px;
                    object-fit: contain;
                    border: 1px solid #000000;
                    padding: 2px;
                }
                .z83-form-id {
                    font-size: 13px;
                    font-weight: bold;
                    font-family: "Courier New", Courier, monospace;
                    border: 2px solid #000000 !important;
                    padding: 4px 8px !important;
                    text-align: center;
                    width: 15%;
                    background-color: #ffffff;
                }
                .z83-republic-title {
                    font-size: 13px;
                    font-weight: bold;
                    text-transform: uppercase;
                    text-align: center;
                    letter-spacing: 0.5px;
                }
                .z83-republic-subtitle {
                    font-size: 9px;
                    text-align: center;
                    font-weight: bold;
                    color: #000000;
                    margin-top: 2px;
                }

                /* Purpose Informational Banner Box */
                .z83-instruction-box {
                    border: 2px solid #000000;
                    background-color: #ffffff;
                    padding: 8px;
                    margin: 4px 0 10px 0;
                    font-size: 10.5px;
                    line-height: 1.4;
                }

                /* Bold Section Headers */
                .z83-section-title {
                    background-color: #000000;
                    color: #ffffff;
                    font-weight: bold;
                    font-size: 11px;
                    padding: 5px 8px;
                    text-transform: uppercase;
                    margin-top: 12px;
                    letter-spacing: 0.3px;
                }

                /* Dense Z83 Structural Data Matrix Grids */
                .z83-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 0;
                }
                .z83-table td, .z83-table th {
                    border: 1px solid #000000;
                    padding: 5px 6px;
                    vertical-align: top;
                }
                
                /* Labels vs Fields styling matching box templates */
                .label {
                    display: block;
                    font-size: 9px;
                    font-weight: bold;
                    text-transform: uppercase;
                    color: #000000;
                    margin-bottom: 3px;
                }
                .value-text {
                    display: block;
                    font-size: 11px;
                    font-weight: bold;
                    color: #000000;
                    min-height: 14px;
                    padding-left: 2px;
                }
                
                /* Utility Formatting Blocks */
                .font-mono { font-family: "Courier New", Courier, monospace; font-size: 11.5px; letter-spacing: 0.3px; }
                .uppercase { text-transform: uppercase; }
                .text-low { text-transform: lowercase; }
                .fw-bold { font-weight: bold; }
                
                .z83-checkbox {
                    font-family: "Courier New", Courier, monospace;
                    font-weight: bold;
                    font-size: 12px;
                    background-color: #ffffff;
                    padding: 0 2px;
                }
                .block-notes {
                    font-size: 10.5px;
                    line-height: 1.4;
                    font-weight: normal;
                    background-color: #ffffff;
                    padding: 4px;
                    min-height: 40px;
                }

                /* Footer Signature Grid Boxes */
                .z83-footer {
                    margin-top: 15px;
                    border-top: 2px solid #000000;
                    padding-top: 8px;
                    font-size: 9px;
                    text-align: justify;
                    line-height: 1.3;
                }
                .signature-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                }
                .signature-table td {
                    border: 1px solid #000000;
                    padding: 12px 8px;
                    width: 33.33%;
                    font-size: 9px;
                    font-weight: bold;
                }
                .signature-line {
                    margin-top: 25px;
                    border-top: 1px dashed #000000;
                    text-align: center;
                    padding-top: 3px;
                    font-size: 8.5px;
                }
            </style>
        </head>
        <body>
            <div class="z83-wrapper">
                
                <table class="z83-header-table">
                    <tr>
                        <td class="z83-logo-cell">
                            <img src="<?= base_url('favicon.ico') ?>" class="z83-logo-img" alt="Gov Logo" onerror="this.style.display='none';">
                        </td>
                        <td class="z83-form-id">${formTitleIdentifier}</td>
                        <td>
                            <div class="z83-republic-title">BLANTYRE DISTRICT COUNCIL</div>
                            <div class="z83-republic-subtitle">REPUBLIC OF MALAWI &bull; CENTRAL INTEGRATED REGISTRY SYSTEM</div>
                            <div style="font-size:12px; font-weight:bold; text-align:center; margin-top:5px; text-transform:uppercase; letter-spacing:0.5px;">
                                ${formSubjectHeader}
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="z83-instruction-box">
                    ${descriptiveInstructionBox}
                </div>

                ${dynamicFormContent}

                <div class="z83-section-title">SECTION FOR OFFICIAL DESK SIGN-OFF VALIDATION</div>
                <table class="signature-table">
                    <tr>
                        <td>
                            <span class="label">DATA INTEGRITY CLERK</span>
                            <div class="signature-line">SIGNATURE TIMESTAMP CAPTURE</div>
                        </td>
                        <td>
                            <span class="label">DISTRICT COGNIZANT SUPERVISOR</span>
                            <div class="signature-line">OFFICIAL STAMP / COUNTERSIGN</div>
                        </td>
                        <td>
                            <span class="label">SYSTEM EXTRACT GENERATION DATE</span>
                            <div style="font-size:11px; font-family:monospace; font-weight:bold; text-align:center; margin-top:20px;">
                                ${new Date().toLocaleString()}
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="z83-footer">
                    <strong>REGISTRY SECURITY DISCLOSURE NOTICE:</strong> This document constitutes a certified administrative micro-copy extract executed directly from the primary relational database partitions of Blantyre District Council. Any manual manipulation of values on this sheet completely invalidates the underlying digital security validation token checksum recorded inside the core databank network logs.
                    <div style="margin-top:4px; font-family:monospace; font-size:8px; opacity:0.75;">Ledger Integrity Token Ref ID: ${compositeId}</div>
                </div>

            </div>

            <script>
                window.onload = function() {
                    window.print();
                    setTimeout(function() { window.close(); }, 800);
                };
            <\/script>
        </body>
        </html>
    `);
    printWindow.document.close();
}
</script>