<?= $this->extend('templates/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 pb-3 border-bottom">
        <div>
            <div class="mb-2">
                <a href="<?= base_url('admin/business-licenses') ?>" class="btn btn-sm btn-light border text-secondary fw-medium px-3">
                    <i class="fas fa-arrow-left me-2"></i>Back to Licenses
                </a>
            </div>
            <h2 class="fw-bold text-dark m-0 d-flex align-items-center">
                <i class="fas fa-id-card text-info me-3"></i>
                <span>Business License Details</span>
            </h2>
        </div>
        
        <div class="btn-toolbar mb-2 mb-md-0">
            <?php if ($license['status'] === 'pending' || $license['status'] === 'under_review'): ?>
            <button type="button" class="btn btn-sm btn-outline-success me-2 px-3 fw-medium" onclick="showStatusModal('approved')">
                <i class="fas fa-check me-1"></i> Approve
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger px-3 fw-medium" onclick="showStatusModal('rejected')">
                <i class="fas fa-times me-1"></i> Reject
            </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-secondary bg-opacity-10 me-3">
                        <i class="fas fa-hashtag text-secondary"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">License Number</div>
                        <h5 class="fw-bold mb-0 text-dark"><?= esc($license['license_number'] ?? 'N/A') ?></h5>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
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
                    <div class="icon-box bg-<?= $statusClass ?> bg-opacity-10 me-3">
                        <i class="fas fa-circle-notch text-<?= $statusClass ?>"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">Current Status</div>
                        <h5 class="mb-0">
                            <span class="badge bg-<?= $statusClass ?>"><?= ucfirst(str_replace('_', ' ', $license['status'])) ?></span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 me-3">
                        <i class="fas fa-folder-open text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">Application Reference</div>
                        <h5 class="fw-bold mb-0 text-dark"><?= esc($license['application']['reference_number'] ?? 'N/A') ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-danger bg-opacity-10 me-3">
                        <i class="far fa-calendar-alt text-danger"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">Expiry Date</div>
                        <h5 class="fw-bold mb-0 text-dark"><?= $license['expiry_date'] ? date('M j, Y', strtotime($license['expiry_date'])) : 'N/A' ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-6">
            <div class="card dashboard-card h-100">
                <div class="card-header">
                    <i class="fas fa-store text-muted me-2"></i>Business Information
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted" width="40%">Business Name</th>
                                    <td class="fw-semibold ps-3 text-dark"><?= esc($license['business_name']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Business Type</th>
                                    <td class="ps-3"><?= esc($license['business_type']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Business Category</th>
                                    <td class="ps-3"><?= esc($license['business_category'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Market Location</th>
                                    <td class="ps-3"><?= esc($license['market'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Location Type</th>
                                    <td class="ps-3"><?= esc($license['location_type'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Zone Code</th>
                                    <td class="ps-3"><code class="text-dark bg-light px-2 py-1 rounded"><?= esc($license['code'] ?? '-') ?></code></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Registration Date</th>
                                    <td class="ps-3"><?= $license['registration_date'] ? date('M j, Y', strtotime($license['registration_date'])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Fee Amount</th>
                                    <td class="fw-bold text-dark ps-3"><?= $license['fee_amount'] ? 'MWK ' . number_format($license['fee_amount'], 2) : '-' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 pb-3 bg-light text-muted">Inspection Required</th>
                                    <td class="ps-3 pb-3">
                                        <?= $license['inspection_required'] ? '<span class="badge bg-warning text-dark">Yes</span>' : '<span class="badge bg-secondary">No</span>' ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card dashboard-card h-100">
                <div class="card-header">
                    <i class="fas fa-user text-muted me-2"></i>Owner Information
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted" width="40%">Full Name</th>
                                    <td class="fw-semibold ps-3 text-dark"><?= esc($license['owner_name']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Email Address</th>
                                    <td class="ps-3"><a href="mailto:<?= esc($license['owner_email']) ?>" class="text-primary"><?= esc($license['owner_email']) ?></a></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Phone Contact</th>
                                    <td class="ps-3"><?= esc($license['owner_phone']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Identity ID Type</th>
                                    <td class="ps-3"><?= esc($license['owner_id_type'] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">National ID / Doc Number</th>
                                    <td class="fw-mono ps-3 text-dark"><?= esc($license['owner_id_number']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 bg-light text-muted">Application Type</th>
                                    <td class="ps-3"><?= $license['is_renewal'] ? '<span class="badge bg-info">Renewal</span>' : '<span class="badge bg-primary">New Registration</span>' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="ps-4 pb-4 bg-light text-muted">Previous License</th>
                                    <td class="ps-3 pb-4 text-muted">
                                        <?= $license['previous_license_number'] ? esc($license['previous_license_number']) : '<em>No previous history</em>' ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-header">
                    <i class="fas fa-file-alt text-muted me-2"></i>Uploaded Verification Documents
                </div>
                <div class="card-body">
                    <?php if (!empty($documents)): ?>
                        <div class="list-group list-group-flush border rounded">
                            <?php foreach ($documents as $doc): ?>
                            <a href="<?= base_url('writable/' . $doc['file_path']) ?>" class="list-group-item list-group-item-action p-3" target="_blank">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold text-dark">
                                        <i class="fas fa-file-pdf text-danger me-2"></i><?= esc($doc['document_type']) ?>
                                    </h6>
                                    <small class="text-muted fw-medium bg-light border px-2 py-0.5 rounded"><?= date('M j, Y', strtotime($doc['uploaded_at'])) ?></small>
                                </div>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span><?= esc($doc['file_name']) ?></span>
                                    <span class="fw-medium text-secondary"><?= number_format($doc['file_size'] / 1024, 1) ?> KB</span>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-folder-open fa-2x mb-2 text-opacity-20 text-secondary"></i>
                            <p class="mb-0 small">No dynamic attachments uploaded for this license asset record.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-header">
                    <i class="fas fa-history text-muted me-2"></i>Audit Status History Logs
                </div>
                <div class="card-body">
                    <?php if (!empty($status_history)): ?>
                        <div class="ps-2" style="border-left: 2px solid #e2e8f0;">
                            <?php foreach ($status_history as $index => $log): ?>
                            <div class="position-relative mb-4 ps-4">
                                <span class="position-absolute start-0 translate-middle bg-white border border-2 border-primary rounded-circle" style="width: 12px; height: 12px; top: 8px; left: -1px !important;"></span>
                                
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="fw-semibold text-dark text-slate-800">
                                        <?= ucfirst(str_replace('_', ' ', $log['new_status'])) ?>
                                    </span>
                                    <small class="text-muted bg-light px-2 py-0.5 rounded border small">
                                        <?= date('M j, Y \a\t H:i', strtotime($log['created_at'])) ?>
                                    </small>
                                </div>
                                <?php if ($log['old_status']): ?>
                                <div class="text-muted small mb-1">
                                    Changed from <span class="text-decoration-line-through"><?= ucfirst(str_replace('_', ' ', $log['old_status'])) ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if ($log['notes']): ?>
                                <div class="p-2 bg-light rounded text-secondary border-start border-3 border-secondary small mt-1">
                                    <i class="fas fa-comment-alt text-muted me-1 small"></i> <em><?= esc($log['notes']) ?></em>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-history fa-2x mb-2 text-opacity-20 text-secondary"></i>
                            <p class="mb-0 small">No past state transaction history available.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom bg-light py-3">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-sliders-h text-muted me-2"></i>Update License Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="post" action="<?= base_url('admin/business-licenses/' . $license['application_id'] . '/status') ?>">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary text-uppercase">Select New Action State</label>
                        <select name="status" class="form-select py-2" required>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="under_review">Under Review</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-semibold text-secondary text-uppercase">Internal Review Notes</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="Enter process audit reasons or conditions specified for this merchant item..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3 text-secondary fw-medium" data-bs-dismiss="modal">Cancel Action</button>
                    <button type="submit" class="btn btn-sm btn-primary px-3 fw-medium">Save state updates</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showStatusModal(status) {
    const modal = new bootstrap.Modal(document.getElementById('statusModal'));
    document.querySelector('#statusForm select[name="status"]').value = status;
    modal.show();
}
</script>

<?= $this->endSection() ?>