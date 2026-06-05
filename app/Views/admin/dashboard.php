<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1"><?= esc($page_title) ?></h2>
        <p class="text-muted small mb-0">Blantyre District Council Management System</p>
    </div>
    <div>
        <span class="badge bg-light text-dark border p-2">
            <i class="far fa-clock me-1 text-primary"></i> 
            Updated: <?= date('F j, Y \a\t g:i A') ?>
        </span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-4">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-primary bg-opacity-10 me-3">
                    <i class="fas fa-file-alt fa-lg text-primary"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-1">Total Applications</div>
                    <h3 class="fw-bold mb-0 text-dark"><?= number_format($stats['total_applications'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-warning bg-opacity-10 me-3">
                    <i class="fas fa-hourglass-half fa-lg text-warning"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-1">Pending</div>
                    <h3 class="fw-bold mb-0 text-dark"><?= number_format($stats['pending_applications'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-success bg-opacity-10 me-3">
                    <i class="fas fa-check-circle fa-lg text-success"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-1">Approved</div>
                    <h3 class="fw-bold mb-0 text-dark"><?= number_format($stats['approved_applications'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-info bg-opacity-10 me-3">
                    <i class="fas fa-users fa-lg text-info"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-1">Total Users</div>
                    <h3 class="fw-bold mb-0 text-dark"><?= number_format($stats['total_users'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-danger bg-opacity-10 me-3">
                    <i class="fas fa-bell fa-lg text-danger"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-1">Total Notices</div>
                    <h3 class="fw-bold mb-0 text-dark"><?= number_format($stats['total_notices'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-5">
        <div class="card dashboard-card h-100">
            <div class="card-header">
                <i class="fas fa-chart-pie text-muted me-2"></i>Application Status Overview
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th class="text-end">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($applications_by_status) && is_array($applications_by_status)): ?>
                                <?php foreach ($applications_by_status as $row): ?>
                                <tr>
                                    <td>
                                        <span class="fw-medium"><?= esc(ucfirst(str_replace('_',' ',$row['status']))) ?></span>
                                    </td>
                                    <td class="text-end fw-bold text-secondary"><?= number_format($row['count']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td><span class="fw-medium">Pending Review</span></td>
                                    <td class="text-end fw-bold text-secondary"><?= number_format($stats['pending_applications'] ?? 0) ?></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-medium">Under Review</span></td>
                                    <td class="text-end fw-bold text-secondary"><?= number_format($stats['under_review_applications'] ?? 0) ?></td>
                                </tr>
                                <tr>
                                    <td><span class="fw-medium">Approved / Active</span></td>
                                    <td class="text-end fw-bold text-secondary"><?= number_format($stats['approved_applications'] ?? 0) ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-7">
        <div class="card dashboard-card h-100">
            <div class="card-header">
                <i class="fas fa-history text-muted me-2"></i>Recent Applications
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Service</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentApplications) && is_array($recentApplications)): ?>
                                <?php foreach ($recentApplications as $app): ?>
                                    <?php
                                        $detailId = $app['id'] ?? $app['application_id'] ?? '';
                                        $detailUrl = $detailId ? base_url('admin/applications/view/'.$detailId) : '#';
                                        $statusRaw = strtolower($app['status'] ?? '');
                                        $statusLabel = ucfirst(str_replace('_',' ',$statusRaw));
                                        $statusMap = [
                                            'pending'   => 'warning text-dark',
                                            'approved'  => 'success',
                                            'rejected'  => 'danger',
                                            'in_review' => 'info text-dark'
                                        ];
                                        $badge = $statusMap[$statusRaw] ?? 'secondary';
                                        $appliedAt = $app['created_at'] ?? $app['applied_at'] ?? $app['date_submitted'] ?? null;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if ($detailUrl !== '#'): ?>
                                                <a href="<?= esc($detailUrl) ?>" class="fw-bold"><?= esc($app['application_reference'] ?? '—') ?></a>
                                            <?php else: ?>
                                                <span class="text-secondary"><?= esc($app['application_reference'] ?? '—') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><span class="text-slate-600"><?= esc($app['service_name'] ?? '—') ?></span></td>
                                        <td><small class="text-muted"><?= $appliedAt ? esc(date('M j, Y', strtotime($appliedAt))) : '—' ?></small></td>
                                        <td>
                                            <span class="badge bg-<?= esc($badge) ?>"><?= esc($statusLabel) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fas fa-folder-open d-block mb-2 fa-2x text-muted opacity-50"></i>
                                        No recent applications found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>