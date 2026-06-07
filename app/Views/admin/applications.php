<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 pb-3 border-bottom gap-3">
    <div>
        <h2 class="fw-bold text-dark mb-1"><?= esc($page_title ?? 'Service Applications Log') ?></h2>
        <p class="text-muted small mb-0">Blantyre District Council Unified Central Registry</p>
    </div>
    
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-secondary btn-sm rounded-2 px-3">
            <i class="fas fa-chart-pie me-2"></i>Dashboard Analytics
        </a>
        <button type="button" onclick="window.location.reload();" class="btn btn-outline-primary btn-sm rounded-2 px-3">
            <i class="fas fa-sync-alt me-2"></i>Refresh Registry
        </button>
        <div class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle rounded-2 px-3" type="button" id="manageAppsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-tasks me-2"></i>Manage Applications
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="manageAppsDropdown">
                <li><h6 class="dropdown-header small text-uppercase tracking-wider">Registry Controls</h6></li>
                <li><a class="dropdown-item py-2" href="#" onclick="filterByServiceType('Business License')"><i class="fas fa-briefcase me-2 text-muted text-center" style="width:20px;"></i>View Business Registry</a></li>
                <li><a class="dropdown-item py-2" href="#" onclick="filterByServiceType('Marriage Certificate')"><i class="fas fa-heart me-2 text-muted text-center" style="width:20px;"></i>View Marriage Registry</a></li>
                <li><a class="dropdown-item py-2" href="#" onclick="filterByServiceType('Complaint')"><i class="fas fa-exclamation-circle me-2 text-muted text-center" style="width:20px;"></i>View Complaint Registry</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="#" onclick="clearAllFilters()"><i class="fas fa-undo me-2 text-center" style="width:20px;"></i>Reset View Filters</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3 mb-4 bg-light">
    <div class="card-body p-3">
        <div class="row g-3">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" 
                           id="registrySearchInput" 
                           class="form-control border-start-0 ps-1" 
                           placeholder="Search by reference code, applicant name, or phone number..."
                           oninput="evaluateRegistryFilters()"
                           onchange="evaluateRegistryFilters()">
                </div>
            </div>
            
            <div class="col-12 col-md-5 col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted small font-monospace">
                        <i class="fas fa-filter"></i>
                    </span>
                    <select id="serviceTypeSelector" 
                            class="form-select border-start-0 ps-1 text-secondary"
                            onchange="evaluateRegistryFilters()">
                        <option value="ALL">All Service Modules</option>
                        <option value="Business License">Business License Submissions</option>
                        <option value="Marriage Certificate">Marriage Certificate Logs</option>
                        <option value="Complaint">Citizens Complaint Reports</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card dashboard-card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold text-secondary text-uppercase tracking-wider small" style="font-size: 0.8rem;">
                <i class="fas fa-list-alt me-2 text-primary"></i>All Service Submissions Ledger
            </h5>
            <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">
                Displaying: <strong id="visibleCount"><?= count($applications ?? []) ?></strong> of <?= count($applications ?? []) ?> Records
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="registryMasterTable">
                <thead class="table-light text-secondary small text-uppercase fw-bold" style="font-size: 0.75rem;">
                    <tr>
                        <th style="padding-left: 1.5rem; width: 15%;">Ref Code</th>
                        <th style="width: 25%;">Applicant Name</th>
                        <th style="width: 20%;">Service Type</th>
                        <th style="width: 15%;">Phone Number</th>
                        <th style="width: 13%;">Status</th>
                        <th style="padding-right: 1.5rem; width: 12%; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.875rem;">
                    <?php if (!empty($applications) && is_array($applications)): ?>
                        <?php foreach ($applications as $app): ?>
                            <?php
                                $statusRaw = strtolower($app['status'] ?? 'pending');
                                $badgeClass = 'bg-secondary text-white';
                                
                                if (in_array($statusRaw, ['approved', 'registered'])) {
                                    $badgeClass = 'bg-success text-white';
                                } elseif (in_array($statusRaw, ['pending', 'pending notice', 'submitted', 'draft'])) {
                                    $badgeClass = 'bg-warning text-dark';
                                } elseif (in_array($statusRaw, ['under_review', 'in_review', 'inspection_scheduled'])) {
                                    $badgeClass = 'bg-info text-dark';
                                } elseif ($statusRaw === 'rejected') {
                                    $badgeClass = 'bg-danger text-white';
                                }
                            ?>
                            <tr class="registry-data-row" 
                                data-ref="<?= esc(strtolower($app['reference_number'])) ?>"
                                data-name="<?= esc(strtolower($app['applicant_name'])) ?>"
                                data-phone="<?= esc(strtolower($app['phone_number'])) ?>"
                                data-service="<?= esc($app['service_type']) ?>">
                                
                                <td style="padding-left: 1.5rem;">
                                    <span class="font-monospace fw-bold text-dark"><?= esc($app['reference_number']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= esc($app['applicant_name'] ?: 'Not Specified') ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace px-2 py-1" style="font-size: 0.75rem;">
                                        <?= esc($app['service_type']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted font-monospace small"><?= esc($app['phone_number']) ?></span>
                                </td>
                                <td>
                                    <span class="badge <?= $badgeClass ?> px-2 py-1 text-capitalize" style="font-size: 0.75rem; font-weight: 500; border-radius: 4px;">
                                        <?= esc(str_replace('_', ' ', $statusRaw)) ?>
                                    </span>
                                </td>
                                <td style="padding-right: 1.5rem; text-align: right;">
                                    <a href="<?= base_url('admin/applications/download/' . esc($app['composite_id'])) ?>" 
                                       class="btn btn-outline-danger btn-sm rounded-2 py-1 px-2 d-inline-flex align-items-center gap-1 font-monospace shadow-sm"
                                       title="Export File Stream Record to PDF Document"
                                       style="font-size: 0.75rem; font-weight: 500;">
                                        <i class="fas fa-file-pdf"></i> Download
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr id="emptyStateRow">
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open d-block mb-3 fa-2x opacity-40 text-secondary"></i>
                                <span class="d-block fw-medium">No application records found inside database datastores.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <tr id="noResultsFallbackRow" style="display: none;">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-search-minus d-block mb-3 fa-2x opacity-40 text-secondary"></i>
                            <span class="d-block fw-medium">No system records match your current criteria query variables.</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function evaluateRegistryFilters() {
    const searchQuery = document.getElementById('registrySearchInput').value.trim().toLowerCase();
    const serviceFilter = document.getElementById('serviceTypeSelector').value;
    
    const rows = document.querySelectorAll('.registry-data-row');
    const noResultsRow = document.getElementById('noResultsFallbackRow');
    const emptyStateRow = document.getElementById('emptyStateRow');
    
    let activeMatches = 0;

    rows.forEach(row => {
        const refAttr = row.getAttribute('data-ref') || '';
        const nameAttr = row.getAttribute('data-name') || '';
        const phoneAttr = row.getAttribute('data-phone') || '';
        const serviceAttr = row.getAttribute('data-service') || '';

        // Evaluate conditions matching standard sub-strings
        const matchesSearch = !searchQuery || 
                              refAttr.includes(searchQuery) || 
                              nameAttr.includes(searchQuery) || 
                              phoneAttr.includes(searchQuery);
        
        // Evaluate service classification string conditions (matching text elements or starts-with tokens)
        const matchesService = (serviceFilter === 'ALL') || 
                               (serviceAttr.toLowerCase().includes(serviceFilter.toLowerCase()));

        if (matchesSearch && matchesService) {
            row.style.display = '';
            activeMatches++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update Counter Element Dynamic Metrics
    const countBadge = document.getElementById('visibleCount');
    if (countBadge) {
        countBadge.innerText = activeMatches;
    }

    // Toggle Empty Response Warnings visibility gracefully
    if (noResultsRow) {
        if (activeMatches === 0 && (!emptyStateRow || emptyStateRow.style.display === 'none')) {
            noResultsRow.style.display = '';
        } else {
            noResultsRow.style.display = 'none';
        }
    }
}

function filterByServiceType(serviceName) {
    const selector = document.getElementById('serviceTypeSelector');
    if (selector) {
        selector.value = serviceName;
        evaluateRegistryFilters();
    }
}

function clearAllFilters() {
    const searchInput = document.getElementById('registrySearchInput');
    const selector = document.getElementById('serviceTypeSelector');
    
    if (searchInput) searchInput.value = '';
    if (selector) selector.value = 'ALL';
    
    evaluateRegistryFilters();
}
</script>