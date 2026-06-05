<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1"><?= esc($page_title ?? 'Applications') ?></h2>
        <p class="text-muted small mb-0">Blantyre District Council Management System</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm mb-4"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger border-0 shadow-sm mb-4"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>

<div class="card dashboard-card mb-4">
    <div class="card-body bg-light bg-opacity-50 p-3">
        <div class="row g-3 align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="appSearchInput" class="form-control border-start-0" placeholder="Search ref or service key...">
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <select id="appStatusFilter" class="form-select form-select-sm text-secondary">
                    <option value="all">All Application Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="in_review">In Review</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="col text-end text-muted small" id="filterStatsCount"></div>
        </div>
    </div>
</div>

<div class="card dashboard-card mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="applicationsDataWorkspace">
                <thead class="table-light text-secondary small text-uppercase">
                    <tr>
                        <th style="padding-left: 1.5rem; width: 140px;">Reference</th>
                        <th>Service Key</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th class="text-end" style="padding-right: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($applications) && is_array($applications)): ?>
                        <?php foreach ($applications as $app): ?>
                            <?php
                                $detailId = $app['id'] ?? $app['application_id'] ?? '';
                                $statusRaw = strtolower($app['status'] ?? 'pending');
                                $statusLabel = ucfirst(str_replace('_', ' ', $statusRaw));
                                
                                $statusMap = [
                                    'pending'     => 'warning text-dark',
                                    'submitted'   => 'warning text-dark',
                                    'under_review'=> 'info text-dark',
                                    'in_review'   => 'info text-dark',
                                    'approved'    => 'success',
                                    'rejected'    => 'danger'
                                ];
                                $badgeClass = $statusMap[$statusRaw] ?? 'secondary';
                                $refNumber = esc($app['reference_number'] ?? $app['application_reference'] ?? '—');
                                $serviceKey = esc($app['service_key'] ?? '—');
                                $createdAt = !empty($app['created_at']) ? esc($app['created_at']) : '';
                            ?>
                            <tr class="app-data-row" 
                                data-search-blob="<?= strtolower($refNumber . ' ' . $serviceKey) ?>" 
                                data-status-blob="<?= $statusRaw ?>">
                                <td style="padding-left: 1.5rem;">
                                    <span class="font-monospace fw-bold text-dark"><?= $refNumber ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace"><?= $serviceKey ?></span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?= !empty($createdAt) ? esc(date('M j, Y \a\t g:i A', strtotime($createdAt))) : '—' ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $badgeClass ?> px-2 py-1.5"><?= $statusLabel ?></span>
                                </td>
                                <td style="padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" 
                                                class="btn btn-sm btn-light border btn-action-hover px-2 py-1 view-application-btn"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewEditModal"
                                                data-id="<?= $detailId ?>"
                                                data-ref="<?= $refNumber ?>">
                                            <i class="far fa-eye text-primary me-1"></i> View & Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr id="emptySearchScopeRow" style="display: none;">
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-search-minus d-block mb-2 fa-2x text-muted opacity-50"></i>
                                No applications match your chosen keywords or filter scopes.
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open d-block mb-2 fa-2x text-muted opacity-50"></i>
                                No structural applications records present inside system datastores.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="viewEditModal" tabindex="-1" aria-labelledby="viewEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow border-0" id="asyncModalTargetContent">
            <div class="modal-body text-center p-5">
                <div class="spinner-border text-primary mb-3" style="width: 2.5rem; height: 2.5rem;" role="status"></div>
                <p class="text-dark fw-medium mb-1">Accessing Data Warehouse Store...</p>
                <p class="text-muted small mb-0">Synchronizing records from backend infrastructure components...</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #viewEditModal, #viewEditModal * {
        visibility: visible;
    }
    #viewEditModal {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
        border: none;
    }
    .modal-dialog {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .modal-content {
        border: none !important;
        box-shadow: none !important;
    }
    .d-print-none {
        display: none !important;
    }
    #modalPrintHeader {
        display: block !important;
    }
    input, select, textarea {
        border: none !important;
        background-color: transparent !important;
        padding: 0 !important;
        appearance: none !important;
        -moz-appearance: none !important;
        -webkit-appearance: none !important;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Filtering Engine Elements ---
        const searchField = document.getElementById('appSearchInput');
        const filterDropdown = document.getElementById('appStatusFilter');
        const rows = document.querySelectorAll('.app-data-row');
        const emptyRow = document.getElementById('emptySearchScopeRow');
        const counterText = document.getElementById('filterStatsCount');

        // --- Filtering Engine Logic ---
        function runLiveFilteringEngine() {
            if (!searchField || !filterDropdown) return;
            const query = searchField.value.toLowerCase().trim();
            const selectedStatus = filterDropdown.value;
            let activeCount = 0;

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search-blob');
                const statusData = row.getAttribute('data-status-blob');

                const textMatch = searchData.includes(query);
                let statusMatch = false;

                if (selectedStatus === 'all') {
                    statusMatch = true;
                } else if (selectedStatus === 'pending' && (statusData === 'pending' || statusData === 'submitted')) {
                    statusMatch = true;
                } else if (selectedStatus === 'in_review' && (statusData === 'in_review' || statusData === 'under_review')) {
                    statusMatch = true;
                } else {
                    statusMatch = (statusData === selectedStatus);
                }

                if (textMatch && statusMatch) {
                    row.style.display = '';
                    activeCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (rows.length > 0) {
                counterText.textContent = `Showing ${activeCount} of ${rows.length} records`;
                emptyRow.style.display = (activeCount === 0) ? '' : 'none';
            }
        }

        if (searchField && filterDropdown) {
            searchField.addEventListener('input', runLiveFilteringEngine);
            filterDropdown.addEventListener('change', runLiveFilteringEngine);
            runLiveFilteringEngine();
        }

        // --- Asynchronous View / Edit / Print Modal Controller ---
        const viewEditModal = document.getElementById('viewEditModal');
        const modalTarget = document.getElementById('asyncModalTargetContent');

        if (viewEditModal && modalTarget) {
            viewEditModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                
                const id = button.getAttribute('data-id');
                const ref = button.getAttribute('data-ref');
                
                // 1. Inject loader layout placeholder
                modalTarget.innerHTML = `
                    <div class="modal-body text-center p-5">
                        <div class="spinner-border text-primary mb-3" style="width: 2.5rem; height: 2.5rem;" role="status"></div>
                        <p class="text-dark fw-medium mb-1">Accessing Data Warehouse Store...</p>
                        <p class="text-muted small mb-0">Re-compiling application lifecycle payload for Reference: ${ref}</p>
                    </div>`;
                
                // 2. Build the exact absolute URI path cleanly depending on standard ports or directory setups
                const segmentArray = window.location.pathname.split('/admin/');
                const appBasePath = segmentArray[0];
                const cleanEndpointUrl = `${window.location.origin}${appBasePath}/admin/applications/view-modal/${id}`;

                // 3. Dispatch server AJAX query transaction request
                fetch(cleanEndpointUrl)
                    .then(response => {
                        if (!response.ok) throw new Error(`Server returned error status code: ${response.status}`);
                        return response.text();
                    })
                    .then(htmlMarkupContent => {
                        modalTarget.innerHTML = htmlMarkupContent;
                        
                        // Dynamically re-bind asset operational features (Print layout rules)
                        const printBtn = document.getElementById('btnPrintModal');
                        if (printBtn) {
                            printBtn.addEventListener('click', function() {
                                window.print();
                            });
                        }
                    })
                    .catch(err => {
                        console.error('AJAX Modal Integration Failure Exception Event:', err);
                        modalTarget.innerHTML = `
                            <div class="modal-body text-center p-5 text-danger">
                                <i class="fas fa-exclamation-triangle fa-3x mb-3 text-warning"></i>
                                <h5 class="fw-bold text-dark">Data Payload Extraction Failure</h5>
                                <p class="text-muted small mb-0 mt-1">Unable to compile details component interface context right now.</p>
                                <p class="text-secondary font-monospace small mt-2 bg-light p-2 border rounded text-start">${err.message}</p>
                                <button type="button" class="btn btn-sm btn-secondary mt-3 px-4" data-bs-dismiss="modal">Close Window</button>
                            </div>`;
                    });
            });
        }
    });
</script>