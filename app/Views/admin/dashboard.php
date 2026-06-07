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
        border-radius: 6px 6px 0 0;
        padding: 1.25rem 1.5rem;
        color: #ffffff;
    }

    .gov-title-seal {
        border-left: 4px solid var(--gov-gold);
        padding-left: 1rem;
    }

    .excel-card-container {
        border: 1px solid var(--excel-border);
        background-color: #ffffff;
        border-radius: 0 0 6px 6px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
    }

    .panel-card-wrapper {
        border: 1px solid var(--excel-border);
        background-color: #ffffff;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .excel-grid-table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
        width: 100%;
        table-layout: auto; /* Allows browser to automatically compress widths tightly to content */
    }

    .excel-grid-table th {
        background-color: var(--excel-header-bg) !important;
        color: #1f2328 !important;
        font-weight: 600 !important;
        font-size: 0.78rem !important;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 1px solid var(--excel-border) !important;
        padding: 8px 10px !important;
        vertical-align: middle;
    }

    .excel-grid-table td {
        border: 1px solid var(--excel-border) !important;
        padding: 9px 10px !important;
        font-size: 0.82rem !important;
        color: var(--gov-text);
        vertical-align: middle;
        background-color: #ffffff;
        white-space: normal; /* Permits wrapping to stay within container boundaries */
        word-break: break-word;
    }

    .excel-grid-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    .stat-card {
        border: 1px solid var(--excel-border);
        background-color: #ffffff;
        border-radius: 6px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .stat-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.05);
        transform: translateY(-2px);
        border-color: #b6c1ce;
    }

    .icon-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        flex-shrink: 0;
    }

    .gov-badge {
        background-color: var(--gov-gold-light);
        color: var(--gov-navy-primary);
        border: 1px solid var(--gov-gold);
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 4px;
    }
    
    .status-pill {
        font-size: 0.72rem !important;
        font-weight: 600 !important;
        padding: 0.25rem 0.5rem !important;
        border-radius: 4px !important;
        letter-spacing: 0.2px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        white-space: nowrap; /* Keeps small status pill texts intact */
    }
</style>

<div id="ajaxAlertContainer"></div>

<!-- GOV BANNER HEADER -->
<div class="gov-banner-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div class="gov-title-seal">
        <h4 class="fw-bold tracking-tight mb-1 text-uppercase text-white" style="letter-spacing: 0.5px; font-size: 1.25rem;">
            <?= esc($page_title ?? 'Dashboard Canvas') ?>
        </h4>
        <div class="small opacity-75 text-white font-monospace-gov" style="font-size: 0.7rem; letter-spacing: 0.2px;">
            BLANTYRE DISTRICT COUNCIL &bull; REPUBLIC OF MALAWI CENTRAL INTEGRATED REGISTRY SYSTEM
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-3">
        <span class="badge gov-badge px-3 py-2 d-flex align-items-center gap-2">
            <i class="far fa-clock text-warning"></i> 
            <span>Updated: <?= date('F j, Y \a\t g:i A') ?></span>
        </span>
    </div>
</div>

<div class="excel-card-container p-3 p-md-4 mb-5">

    <!-- STATISTICS ROW -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card p-3 h-100 d-flex align-items-center">
                <div class="icon-box bg-primary bg-opacity-10 me-3">
                    <i class="fas fa-file-invoice fa-lg text-primary"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-0">Total Module Submissions</div>
                    <h3 class="fw-bold mb-0 text-dark mt-1" style="font-size: 1.4rem; letter-spacing: -0.5px;"><?= number_format($stats['total_applications'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3 col-xl-2">
            <div class="stat-card p-3 h-100 d-flex align-items-center">
                <div class="icon-box bg-warning bg-opacity-10 me-3">
                    <i class="fas fa-hourglass-start fa-sm text-warning"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-0">Pending</div>
                    <h3 class="fw-bold mb-0 text-dark mt-1" style="font-size: 1.3rem; letter-spacing: -0.5px;"><?= number_format($stats['pending_applications'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3 col-xl-2">
            <div class="stat-card p-3 h-100 d-flex align-items-center">
                <div class="icon-box bg-success bg-opacity-10 me-3">
                    <i class="fas fa-check-double fa-md text-success"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-0">Approved</div>
                    <h3 class="fw-bold mb-0 text-dark mt-1" style="font-size: 1.3rem; letter-spacing: -0.5px;"><?= number_format($stats['approved_applications'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-6 col-xl-2">
            <div class="stat-card p-3 h-100 d-flex align-items-center">
                <div class="icon-box bg-info bg-opacity-10 me-3">
                    <i class="fas fa-user-shield fa-md text-info"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-0">Total Users</div>
                    <h3 class="fw-bold mb-0 text-dark mt-1" style="font-size: 1.3rem; letter-spacing: -0.5px;"><?= number_format($stats['total_users'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-6 col-xl-2">
            <div class="stat-card p-3 h-100 d-flex align-items-center">
                <div class="icon-box bg-danger bg-opacity-10 me-3">
                    <i class="fas fa-bullhorn fa-md text-danger"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium mb-0">Total Notices</div>
                    <h3 class="fw-bold mb-0 text-dark mt-1" style="font-size: 1.3rem; letter-spacing: -0.5px;"><?= number_format($stats['total_notices'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div class="row g-4">
        <!-- Application Status Overview -->
        <div class="col-12 col-xl-4">
            <div class="panel-card-wrapper h-100">
                <div class="gov-banner-header py-2 px-3 d-flex align-items-center gap-2" style="border-radius: 0; border-bottom: 2px solid var(--gov-gold); padding: 0.6rem 1rem;">
                    <i class="fas fa-chart-pie text-warning" style="font-size: 0.90rem;"></i> 
                    <span class="fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.3px;">Status Overview</span>
                </div>
                <div class="p-2">
                    <div class="table-responsive" style="overflow-x: hidden;">
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
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-circle text-secondary opacity-25" style="font-size: 0.45rem;"></i>
                                                <span class="fw-medium text-dark text-wrap"><?= esc($row['status']) ?></span>
                                            </div>
                                        </td>
                                        <td class="text-end fw-bold text-dark font-monospace"><?= number_format($row['count']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-muted small">
                                            No status groups recorded.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Submissions -->
        <div class="col-12 col-xl-8">
            <div class="panel-card-wrapper h-100">
                <div class="gov-banner-header py-2 px-3 d-flex align-items-center gap-2" style="border-radius: 0; border-bottom: 2px solid var(--gov-gold); padding: 0.6rem 1rem;">
                    <i class="fas fa-folder-open text-warning" style="font-size: 0.90rem;"></i> 
                    <span class="fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.3px;">Recent Submissions</span>
                </div>
                <div class="p-2">
                    <div class="table-responsive" style="overflow-x: hidden;">
                        <table class="table table-sm excel-grid-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Title / Service Type</th>
                                    <th>Date</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recentApplications) && is_array($recentApplications)): ?>
                                    <?php foreach ($recentApplications as $app): ?>
                                        <?php
                                            $statusRaw = strtolower($app['status'] ?? '');
                                            $statusLabel = esc(ucfirst(str_replace('_',' ',$statusRaw)));
                                            
                                            $badgeClass = 'secondary';
                                            $iconClass = 'fa-circle';
                                            
                                            if (in_array($statusRaw, ['pending', 'pending notice', 'submitted', 'draft'])) {
                                                $badgeClass = 'warning text-dark';
                                                $iconClass = 'fa-hourglass-half';
                                            } elseif (in_array($statusRaw, ['approved', 'registered'])) {
                                                $badgeClass = 'success';
                                                $iconClass = 'fa-check';
                                            } elseif (in_array($statusRaw, ['rejected', 'objected'])) {
                                                $badgeClass = 'danger';
                                                $iconClass = 'fa-times-circle';
                                            } elseif (in_array($statusRaw, ['under_review', 'inspection_scheduled'])) {
                                                $badgeClass = 'info text-dark';
                                                $iconClass = 'fa-search';
                                            }
                                        ?>
                                        <tr>
                                            <td>
                                                <span class="font-monospace fw-bold text-dark"><?= esc($app['application_reference'] ?? '—') ?></span>
                                            </td>
                                            <td>
                                                <div class="fw-medium text-dark text-wrap">
                                                    <?= esc($app['service_name'] ?? '—') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-secondary small text-nowrap">
                                                    <?= !empty($app['applied_at']) ? esc(date('M j, Y', strtotime($app['applied_at']))) : '—' ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-<?= $badgeClass ?> status-pill">
                                                    <i class="fas <?= $iconClass ?>" style="font-size: 0.6rem;"></i>
                                                    <?= $statusLabel ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-database d-block mb-2 fa-2x opacity-25"></i>
                                            <span class="small d-block">No records active inside system node</span>
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