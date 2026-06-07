<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div>
        <h2 class="fw-bold text-dark mb-1"><?= esc($page_title ?? 'Service Applications Log') ?></h2>
        <p class="text-muted small mb-0">Blantyre District Council Unified Central Registry</p>
    </div>
</div>

<div class="card dashboard-card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold text-secondary text-uppercase tracking-wider small" style="font-size: 0.8rem;">
                <i class="fas fa-list-alt me-2 text-primary"></i>All Service Submissions Ledger
            </h5>
            <span class="badge bg-light text-dark border px-2 py-1 small fw-normal">
                Total Records: <?= count($applications ?? []) ?>
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary small text-uppercase fw-bold" style="font-size: 0.75rem;">
                    <tr>
                        <th style="padding-left: 1.5rem; width: 15%;">Ref Code</th>
                        <th style="width: 30%;">Applicant Name</th>
                        <th style="width: 25%;">Service Type</th>
                        <th style="width: 15%;">Phone Number</th>
                        <th style="padding-right: 1.5rem; width: 15%;">Status</th>
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
                            <tr>
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
                                <td style="padding-right: 1.5rem;">
                                    <span class="badge <?= $badgeClass ?> px-2 py-1 text-capitalize" style="font-size: 0.75rem; font-weight: 500; border-radius: 4px;">
                                        <?= esc(str_replace('_', ' ', $statusRaw)) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open d-block mb-3 fa-2x opacity-40 text-secondary"></i>
                                <span class="d-block fw-medium">No application records found inside database datastores.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>