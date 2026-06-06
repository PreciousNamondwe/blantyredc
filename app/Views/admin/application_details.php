<div class="modal-header bg-light border-bottom border-light-subtle">
    <h5 class="modal-title fw-bold text-dark" id="viewEditModalLabel">
        <i class="fas fa-folder-open text-primary me-2"></i> Application Workspace Details (ID: <?= esc($id) ?>)
    </h5>
    <button type="button" class="btn-close d-print-none" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body bg-white p-4">
    <div id="modalPrintHeader" class="d-none mb-4 pb-3 border-bottom text-center">
        <h3 class="fw-bold mb-1 text-dark">Blantyre District Council Management System</h3>
        <p class="text-muted small mb-0">Official Application Records Archive Log Entry</p>
    </div>

    <?php 
    $hasRenderableData = false; 
    if (!empty($applicationData) && is_array($applicationData)): 
    ?>
        <div class="row g-3">
            <?php foreach ($applicationData as $groupName => $fields): ?>
                <?php 
                // FILTER: Ignore raw layout structure payloads or configuration states
                $normalizedGroupName = strtolower(trim($groupName));
                if (in_array($normalizedGroupName, ['form_data', 'form_fields', 'form_config', 'structural_state'])) {
                    continue; 
                }
                
                if (empty($fields) || !is_array($fields)) {
                    continue;
                }

                // Flag indicating data layout chunks were passed successfully
                $hasRenderableData = true;
                ?>
                
                <div class="col-12 mt-4 first-element-normalize">
                    <h6 class="text-uppercase text-primary fw-bold border-bottom pb-2 small tracking-wider">
                        <i class="fas fa-id-card-alt me-2 text-secondary opacity-75"></i><?= esc(ucwords(str_replace('_', ' ', $groupName))) ?>
                    </h6>
                </div>
                
                <?php foreach ($fields as $key => $value): ?>
                    <div class="col-md-6 mb-2">
                        <label class="text-secondary small d-block fw-semibold mb-1 text-uppercase tracking-wide" style="font-size: 0.725rem;">
                            <?= esc(ucwords(str_replace('_', ' ', $key))) ?>
                        </label>
                        <div class="p-2 bg-light border rounded text-dark font-monospace small shadow-sm min-h-input">
                            <?php if (is_array($value)): ?>
                                <pre class="mb-0 text-start text-dark bg-transparent border-0 p-0" style="font-size: 0.775rem; white-size: pre-wrap;"><?= esc(json_encode($value, JSON_PRETTY_PRINT)) ?></pre>
                            <?php else: ?>
                                <?= esc($value ?? '—') ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!$hasRenderableData): ?>
        <div class="text-center py-5 text-muted my-3 bg-light rounded border border-dashed">
            <i class="fas fa-database mb-3 fa-2x opacity-25 text-secondary"></i>
            <h6 class="fw-bold text-dark mb-1">No Profile Metadata Found</h6>
            <p class="mb-0 small text-muted">No custom payload blocks or user application responses are associated with this file ID.</p>
        </div>
    <?php endif; ?>
</div>

<div class="modal-footer d-print-none bg-light border-top border-light-subtle">
    <button type="button" class="btn btn-sm btn-secondary px-4 py-1.5 shadow-sm rounded" data-bs-dismiss="modal">Close</button>
    <button type="button" id="btnPrintModal" class="btn btn-sm btn-dark px-4 py-1.5 shadow-sm rounded">
        <i class="fas fa-print me-1"></i> Print Records
    </button>
</div>

<style>
.tracking-wider { letter-spacing: 0.05em; }
.tracking-wide { letter-spacing: 0.025em; }
.min-h-input { min-height: 38px; display: flex; align-items: center; }
.first-element-normalize:first-of-type { mt-2 !important; }
</style>