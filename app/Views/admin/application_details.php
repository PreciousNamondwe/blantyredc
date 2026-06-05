<!-- ======================================================================== -->
<!-- UPDATED DYNAMIC WORKSPACE MODAL FOR BLANTYRE DISTRICT COUNCIL             -->
<!-- ======================================================================== -->
<div class="modal-header bg-dark text-white">
    <h5 class="modal-title fw-bold" id="viewEditModalLabel">
        <i class="fas fa-folder-open text-warning me-2"></i> Application Workspace Details (ID: <?= esc($id) ?>)
    </h5>
    <button type="button" class="btn-close btn-close-white d-print-none" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body p-0">
    <!-- Printable Header Segment -->
    <div id="modalPrintHeader" class="d-none mb-4 pb-3 border-bottom text-center">
        <h3 class="fw-bold mb-1">Blantyre District Council Management System</h3>
        <p class="text-muted small mb-0">Official Application Records Archive Log Entry</p>
    </div>

    <!-- Administrative Meta Bar (Hidden when printing) -->
    <div class="bg-light p-3 border-bottom d-print-none d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <small class="text-muted text-uppercase d-block fw-semibold" style="font-size: 0.75rem;">Service Class</small>
            <span class="badge bg-primary fs-6 text-capitalize"><?= esc(str_replace('_', ' ', $application['service_key'] ?? 'General')) ?></span>
        </div>
        <div>
            <small class="text-muted text-uppercase d-block fw-semibold" style="font-size: 0.75rem;">Submission Date</small>
            <span class="fw-medium text-dark"><?= esc($application['submitted_at'] ?? 'Not Submitted') ?></span>
        </div>
        <div>
            <small class="text-muted text-uppercase d-block fw-semibold" style="font-size: 0.75rem;">Current Assignment</small>
            <?php if (!empty($application['assigned_to'])): ?>
                <span class="badge bg-dark">Officer ID: <?= esc($application['assigned_to']) ?></span>
            <?php else: ?>
                <span class="badge bg-warning text-dark">Unassigned Pool</span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Interface Panel Navigation Tabs (Hidden when printing) -->
    <ul class="nav nav-tabs custom-tabs px-3 pt-2 bg-white d-print-none" id="applicationWorkspaceTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="workflow-tab" data-bs-toggle="tab" data-bs-target="#workflow-panel" type="button" role="tab">
                <i class="fas fa-sliders-h me-2 text-primary"></i>Workflow & Actions
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data-panel" type="button" role="tab">
                <i class="fas fa-file-invoice me-2 text-success"></i>Form Data & Details
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="docs-tab" data-bs-toggle="tab" data-bs-target="#docs-panel" type="button" role="tab">
                <i class="fas fa-paperclip me-2 text-info"></i>Attachments (<?= isset($documents) ? count($documents) : 0 ?>)
            </button>
        </li>
    </ul>

    <!-- Core Process Form Wrapper -->
    <form id="updateApplicationForm" action="<?= base_url('admin/applications/update') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="application_id" value="<?= esc($id) ?>">
        <input type="hidden" name="current_status" value="<?= esc($application['status'] ?? '') ?>">

        <div class="tab-content p-4" id="applicationWorkspaceTabsContent">
            
            <!-- PANEL 1: WORKFLOW CONTROL ACTION CENTER -->
            <div class="tab-pane fade show active d-print-none" id="workflow-panel" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="statusSelect" class="form-label fw-bold text-secondary">
                            <i class="fas fa-arrow-circle-right me-1 text-primary"></i>Transition Status
                        </label>
                        <select class="form-select form-select-lg border-2" id="statusSelect" name="status" required>
                            <?php $currStatus = $application['status'] ?? 'submitted'; ?>
                            <option value="draft" <?= $currStatus == 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="submitted" <?= $currStatus == 'submitted' ? 'selected' : '' ?>>Submitted</option>
                            <option value="under_review" <?= $currStatus == 'under_review' ? 'selected' : '' ?>>Under Review</option>
                            <option value="approved" <?= $currStatus == 'approved' ? 'selected' : '' ?>>Approved</option>
                            <option value="rejected" <?= $currStatus == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            <option value="completed" <?= $currStatus == 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $currStatus == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="prioritySelect" class="form-label fw-bold text-secondary">
                            <i class="fas fa-exclamation-triangle me-1 text-warning"></i>Urgency Level
                        </label>
                        <select class="form-select form-select-lg" id="prioritySelect" name="priority" required>
                            <?php $currPriority = $application['priority'] ?? 'normal'; ?>
                            <option value="low" <?= $currPriority == 'low' ? 'selected' : '' ?>>Low</option>
                            <option value="normal" <?= $currPriority == 'normal' ? 'selected' : '' ?>>Normal</option>
                            <option value="high" <?= $currPriority == 'high' ? 'selected' : '' ?>>High</option>
                            <option value="urgent" <?= $currPriority == 'urgent' ? 'selected' : '' ?>>Urgent</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="statusNotes" class="form-label fw-bold text-secondary">
                            <i class="fas fa-journal-whills me-1 text-secondary"></i>Audit & Processing Logs Note
                        </label>
                        <textarea class="form-control" id="statusNotes" name="notes" rows="4" placeholder="Enter formal contextual review comments or precise rejection feedback terms here..." required></textarea>
                    </div>
                </div>
            </div>

            <!-- PANEL 2: COMPREHENSIVE LOOP FORM METADATA DATA -->
            <div class="tab-pane fade" id="data-panel" role="tabpanel">
                <?php if (!empty($applicationData) && is_array($applicationData)): ?>
                    <div class="row g-3">
                        <?php foreach ($applicationData as $groupName => $fields): ?>
                            <div class="col-12 mt-3">
                                <h6 class="text-uppercase text-primary fw-bold border-bottom pb-2 small mb-1">
                                    <?= esc(ucwords(str_replace('_', ' ', $groupName))) ?>
                                </h6>
                            </div>
                            
                            <?php if (is_array($fields)): ?>
                                <?php foreach ($fields as $key => $value): ?>
                                    <div class="col-md-6 mb-2">
                                        <label class="text-muted small d-block fw-semibold mb-1">
                                            <?= esc(ucwords(str_replace('_', ' ', $key))) ?>
                                        </label>
                                        <div class="p-2 bg-light border rounded text-dark font-monospace small">
                                            <?php if (is_array($value)): ?>
                                                <pre class="mb-0 text-start" style="font-size: 0.775rem;"><?= esc(json_encode($value, JSON_PRETTY_PRINT)) ?></pre>
                                            <?php else: ?>
                                                <?= esc($value ?? '—') ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-database mb-2 fa-2x opacity-30"></i>
                        <p class="mb-0">No metadata profile records or custom payload blocks found for this entry.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- PANEL 3: ATTACHMENTS REPOSITORY -->
            <div class="tab-pane fade d-print-none" id="docs-panel" role="tabpanel">
                <div class="row g-3">
                    <?php if (!empty($documents) && is_array($documents)): ?>
                        <?php foreach ($documents as $doc): ?>
                            <div class="col-md-6">
                                <div class="card h-100 border-start border-3 border-info shadow-sm bg-white">
                                    <div class="card-body d-flex align-items-center py-3">
                                        <div class="me-3 fs-3 text-secondary">
                                            <?php if (strpos($doc['mime_type'] ?? '', 'image') !== false): ?>
                                                <i class="fas fa-file-image text-success"></i>
                                            <?php elseif (strpos($doc['mime_type'] ?? '', 'pdf') !== false): ?>
                                                <i class="fas fa-file-pdf text-danger"></i>
                                            <?php else: ?>
                                                <i class="fas fa-file-alt text-primary"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1 min-width-0">
                                            <h6 class="text-truncate mb-1 text-dark fw-bold" title="<?= esc($doc['file_name']) ?>">
                                                <?= esc($doc['file_name']) ?>
                                            </h6>
                                            <p class="mb-0 text-muted small text-capitalize">
                                                <?= esc(str_replace('_', ' ', $doc['document_type'] ?? 'Attachment')) ?>
                                                (<?= number_format(($doc['file_size'] ?? 0) / 1024, 1) ?> KB)
                                            </p>
                                        </div>
                                        <div class="ms-2">
                                            <a href="<?= base_url($doc['file_path']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="fas fa-cloud-slash fa-2x mb-2 opacity-30"></i>
                            <p class="mb-0">No uploaded verification files or attachments linked to this profile reference.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Footer Control Dashboard (Hidden when printing) -->
        <div class="modal-footer d-print-none bg-light border-top">
            <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
            <button type="button" id="btnPrintModal" class="btn btn-sm btn-outline-dark px-3">
                <i class="fas fa-print me-1"></i> Print Records
            </button>
            <button type="submit" class="btn btn-sm btn-dark px-4 shadow-sm">
                <i class="fas fa-save me-1 text-success"></i> Commit Changes
            </button>
        </div>
    </form>
</div>

<!-- ======================================================================== -->
<!-- PRINT TRIGGER EVENT HANDLER INTERACTION                                   -->
<!-- ======================================================================== -->
<script>
document.getElementById('btnPrintModal').addEventListener('click', function() {
    // Switch view to the Details tab so everything is visible to the printer layout engines
    const dataTabTrigger = document.querySelector('#data-tab');
    if (dataTabTrigger) {
        bootstrap.Tab.getOrCreateInstance(dataTabTrigger).show();
        
        // Brief timeout ensures clean tab DOM drawing settles before invoking print window layout layers
        setTimeout(() => {
            window.print();
        }, 350);
    } else {
        window.print();
    }
});
</script>