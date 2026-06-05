<div class="modal-header bg-light">
    <h5 class="modal-title fw-bold text-dark" id="viewEditModalLabel">
        <i class="fas fa-folder-open text-primary me-2"></i> Application Workspace Details (ID: <?= esc($id) ?>)
    </h5>
    <button type="button" class="btn-close d-print-none" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div id="modalPrintHeader" class="d-none mb-4 pb-3 border-bottom text-center">
        <h3 class="fw-bold mb-1">Blantyre District Council Management System</h3>
        <p class="text-muted small mb-0">Official Application Records Archive Log Entry</p>
    </div>

    <?php if (!empty($applicationData) && is_array($applicationData)): ?>
        <div class="row g-3">
            <?php foreach ($applicationData as $groupName => $fields): ?>
                <div class="col-12 mt-4">
                    <h6 class="text-uppercase text-primary fw-bold border-bottom pb-2 small">
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

<div class="modal-footer d-print-none bg-light">
    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
    <button type="button" id="btnPrintModal" class="btn btn-sm btn-dark px-3">
        <i class="fas fa-print me-1"></i> Print Records
    </button>
</div>