<style>
    :root {
        --gov-navy-primary: #1a3352;
        --gov-navy-hover: #112237;
        --gov-gold: #d4af37;
        --gov-gold-light: #fdfaf2;
        --gov-border: #ccd4dc;
        --gov-bg-muted: #f5f7fa;
        --gov-text: #2d3748;
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

    .stat-card {
        border: 1px solid var(--excel-border);
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    .icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }

    .gov-badge {
        background-color: var(--gov-gold-light);
        color: var(--gov-navy-primary);
        border: 1px solid var(--gov-gold);
        font-size: 0.8rem;
    }
</style>

<div id="ajaxAlertContainer"></div>

<!-- GOV BANNER HEADER -->
<div class="gov-banner-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div class="gov-title-seal">
        <h4 class="fw-bold tracking-tight mb-1 text-uppercase text-white" style="letter-spacing: 0.5px;">
            <?= esc($page_title ?? 'Dashboard') ?>
        </h4>
        <div class="small opacity-75 text-white font-monospace-gov" style="font-size: 0.75rem;">
            BLANTYRE DISTRICT COUNCIL &bull; REPUBLIC OF MALAWI CENTRAL INTEGRATED REGISTRY SYSTEM
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-3">
        <span class="badge gov-badge px-3 py-2">
            <i class="far fa-clock me-1"></i> 
            Updated: <?= date('F j, Y \a\t g:i A') ?>
        </span>
    </div>
</div>

<div class="excel-card-container p-4 mb-5">

    <!-- STATISTICS ROW -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-4">
            <div class="stat-card p-4 h-100">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 me-3">
                        <i class="fas fa-file-alt fa-lg text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">Total Submissions</div>
                        <h3 class="fw-bold mb-0 text-dark"><?= number_format($stats['total_applications'] ?? 0) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-2">
            <div class="stat-card p-4 h-100">
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
            <div class="stat-card p-4 h-100">
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
            <div class="stat-card p-4 h-100">
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
            <div class="stat-card p-4 h-100">
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

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="row g-4">
        <!-- Application Status Overview -->
        <div class="col-xl-5">
            <div class="excel-card-container h-100">
                <div class="gov-banner-header py-3 px-4" style="border-radius: 4px 4px 0 0; border-bottom: 2px solid var(--gov-gold);">
                    <i class="fas fa-chart-pie me-2"></i> Application Status Overview
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-sm excel-grid-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Status Category</th>
                                    <th class="text-end">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($applications_by_status) && is_array($applications_by_status)): ?>
                                    <?php foreach ($applications_by_status as $row): ?>
                                    <tr>
                                        <td><span class="fw-medium"><?= esc($row['status']) ?></span></td>
                                        <td class="text-end fw-bold"><?= number_format($row['count']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Submissions -->
        <div class="col-xl-7">
            <div class="excel-card-container h-100">
                <div class="gov-banner-header py-3 px-4" style="border-radius: 4px 4px 0 0; border-bottom: 2px solid var(--gov-gold);">
                    <i class="fas fa-history me-2"></i> Recent Submissions (All Modules)
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-sm excel-grid-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Title / Service Type</th>
                                    <th>Applied Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recentApplications) && is_array($recentApplications)): ?>
                                    <?php foreach ($recentApplications as $app): ?>
                                        <?php
                                            $statusRaw = strtolower($app['status'] ?? '');
                                            $statusLabel = ucfirst(str_replace('_',' ',$statusRaw));
                                            
                                            $badgeClass = 'secondary';
                                            if (in_array($statusRaw, ['pending', 'pending notice', 'submitted', 'draft'])) {
                                                $badgeClass = 'warning';
                                            } elseif (in_array($statusRaw, ['approved', 'registered'])) {
                                                $badgeClass = 'success';
                                            } elseif (in_array($statusRaw, ['rejected', 'objected'])) {
                                                $badgeClass = 'danger';
                                            } elseif (in_array($statusRaw, ['under_review', 'inspection_scheduled'])) {
                                                $badgeClass = 'info';
                                            }
                                        ?>
                                        <tr>
                                            <td><span class="fw-bold"><?= esc($app['application_reference'] ?? '—') ?></span></td>
                                            <td><span class="text-slate-600"><?= esc($app['service_name'] ?? '—') ?></span></td>
                                            <td><small class="text-muted"><?= !empty($app['applied_at']) ? esc(date('M j, Y', strtotime($app['applied_at']))) : '—' ?></small></td>
                                            <td>
                                                <span class="badge bg-<?= $badgeClass ?>"><?= esc($statusLabel) ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-folder-open d-block mb-3 fa-2x opacity-50"></i>
                                            No recent records found
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
</div>