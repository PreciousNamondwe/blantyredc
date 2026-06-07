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

    /* Government Panel Layout & Card Definitions */
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

    /* Traditional Grid and Data Streams */
    .excel-grid-table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
        width: 100%;
        table-layout: auto;
    }

    .excel-grid-table th {
        background-color: var(--excel-header-bg) !important;
        color: #1f2328 !important;
        font-weight: 600 !important;
        font-size: 0.78rem !important;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 1px solid var(--excel-border) !important;
        padding: 10px 12px !important;
        vertical-align: middle;
    }

    .excel-grid-table td {
        border: 1px solid var(--excel-border) !important;
        padding: 10px 12px !important;
        font-size: 0.82rem !important;
        color: var(--gov-text);
        vertical-align: middle;
        background-color: #ffffff;
        white-space: normal;
        word-break: break-word;
    }

    .excel-grid-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Classic Form Controls Override */
    .gov-form-control {
        border: 1px solid var(--excel-border) !important;
        border-radius: 4px !important;
        font-size: 0.85rem !important;
        color: var(--gov-text) !important;
        background-color: #ffffff !important;
    }
    .gov-form-control:focus {
        border-color: var(--gov-navy-primary) !important;
        box-shadow: 0 0 0 3px rgba(26, 51, 82, 0.1) !important;
        outline: 0;
    }
    .gov-form-control[readonly], .gov-form-control:disabled {
        background-color: var(--gov-bg-muted) !important;
        opacity: 1;
    }

    /* Primary and Secondary Structured Buttons */
    .btn-gov-primary {
        background-color: var(--gov-navy-primary) !important;
        border: 1px solid var(--gov-navy-primary) !important;
        color: #ffffff !important;
        font-weight: 500;
        font-size: 0.825rem;
        border-radius: 4px !important;
        transition: background-color 0.15s ease-in-out;
    }
    .btn-gov-primary:hover {
        background-color: var(--gov-navy-hover) !important;
        border-color: var(--gov-navy-hover) !important;
    }

    .btn-gov-secondary {
        background-color: #ffffff !important;
        border: 1px solid var(--excel-border) !important;
        color: var(--gov-text) !important;
        font-weight: 500;
        font-size: 0.825rem;
        border-radius: 4px !important;
    }
    .btn-gov-secondary:hover {
        background-color: var(--gov-bg-muted) !important;
        border-color: #b6c1ce !important;
    }

    /* System Status Elements */
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
        white-space: nowrap;
    }

    .text-wrap-truncate {
        max-width: 280px;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: bottom;
    }
</style>

<div id="ajaxAlertContainer"></div>

<div class="gov-banner-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    <div class="gov-title-seal">
        <h4 class="fw-bold tracking-tight mb-1 text-uppercase text-white" style="letter-spacing: 0.5px; font-size: 1.25rem;">
            <i class="fas fa-bell me-2" style="color: var(--gov-gold);"></i><?= esc($page_title ?? 'Official Board Notifications') ?>
        </h4>
        <div class="small opacity-75 text-white font-monospace-gov" style="font-size: 0.7rem; letter-spacing: 0.2px;">
            BLANTYRE DISTRICT COUNCIL &bull; REPUBLIC OF MALAWI CENTRAL INTEGRATED REGISTRY SYSTEM
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-gov-primary px-3 py-2 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createNoticeModal">
            <i class="fas fa-plus-circle me-2" style="color: var(--gov-gold);"></i>Dispatch Notice
        </button>
    </div>
</div>

<div class="excel-card-container p-3 p-md-4 mb-5">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center justify-content-between p-3 rounded-2" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fs-5 me-2 text-success"></i>
                <span class="fw-medium small text-success"><?= session()->getFlashdata('success') ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4 p-3 rounded-2" role="alert">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-exclamation-circle fs-5 me-2 text-danger"></i>
                <span class="fw-bold small text-danger">Validation Issues Detected:</span>
            </div>
            <ul class="m-0 small text-danger ps-4">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="panel-card-wrapper mb-2">
        <div class="table-responsive">
            <table class="table excel-grid-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 140px;">Tracking ID</th>
                        <th>Notice Info</th>
                        <th>Category</th>
                        <th>Urgency</th>
                        <th>Status</th>
                        <th class="pe-3 text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notices) && is_array($notices)) : ?>
                        <?php foreach ($notices as $item) : ?>
                            <tr>
                                <td class="ps-3 text-muted font-monospace small fw-bold">
                                    <?= esc($item['reference']) ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark text-truncate mb-0" style="max-width: 260px; font-size: 0.85rem;"><?= esc($item['title']) ?></div>
                                    <span class="text-muted small text-wrap-truncate" style="font-size: 0.78rem;"><?= character_limiter(esc($item['content']), 60) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded small fw-medium text-capitalize" style="font-size: 0.72rem;">
                                        <?= esc($item['category']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                        $urgencyClass = 'bg-secondary text-secondary';
                                        if($item['urgency_level'] === 'urgent') $urgencyClass = 'bg-danger text-danger';
                                        elseif($item['urgency_level'] === 'high') $urgencyClass = 'bg-warning text-dark';
                                        elseif($item['urgency_level'] === 'medium') $urgencyClass = 'bg-info text-dark';
                                    ?>
                                    <span class="status-pill px-2 py-1 <?= $urgencyClass ?> bg-opacity-10 text-capitalize">
                                        <i class="fas fa-circle" style="font-size: 0.4rem;"></i>
                                        <?= esc($item['urgency_level']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($item['status'] === 'published') : ?>
                                        <span class="status-pill px-2 py-1 bg-success text-success bg-opacity-10">Live Board</span>
                                    <?php elseif ($item['status'] === 'draft') : ?>
                                        <span class="status-pill px-2 py-1 bg-warning text-dark bg-opacity-10">Draft Blueprint</span>
                                    <?php else : ?>
                                        <span class="status-pill px-2 py-1 bg-secondary text-secondary bg-opacity-10">Archived Node</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-3 text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <button type="button" class="btn btn-sm btn-gov-secondary px-2 py-1" data-bs-toggle="modal" data-bs-target="#editNoticeModal<?= $item['id'] ?>">
                                            <i class="fas fa-edit text-primary me-1"></i>Edit
                                        </button>
                                        <form action="<?= base_url('admin/notices/' . $item['id'] . '/delete') ?>" method="POST" class="d-inline m-0" onsubmit="return confirm('Securely delete this announcement notice from records?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-gov-secondary text-danger px-2 py-1">
                                                <i class="fas fa-trash-alt me-1"></i>Purge
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editNoticeModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-1 rounded-1 shadow-sm">
                                        <form action="<?= base_url('admin/notices/edit/' . $item['id']) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <div class="modal-header bg-light border-bottom px-4 py-3">
                                                <h5 class="modal-title fw-bold text-dark" style="font-size: 1rem;"><i class="fas fa-edit text-primary me-2"></i>Modify Registry Record Parameters</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-bold text-dark small mb-1">Notification Title Headline</label>
                                                        <input type="text" name="title" class="form-control gov-form-control px-3 py-2" value="<?= esc($item['title']) ?>" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold text-dark small mb-1">Tracking ID (Immutable)</label>
                                                        <input type="text" class="form-control gov-form-control px-3 py-2 font-monospace fw-bold" value="<?= esc($item['reference']) ?>" readonly>
                                                        <input type="hidden" name="reference" value="<?= esc($item['reference']) ?>">
                                                    </div>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold text-dark small mb-1">Category Context</label>
                                                        <select name="category" class="form-select gov-form-control px-3 py-2" required>
                                                            <option value="General" <?= $item['category'] == 'General' ? 'selected' : '' ?>>General Bulletin</option>
                                                            <option value="Tenders" <?= $item['category'] == 'Tenders' ? 'selected' : '' ?>>Procurement & Tenders</option>
                                                            <option value="Vacancies" <?= $item['category'] == 'Vacancies' ? 'selected' : '' ?>>Council Careers / Vacancies</option>
                                                            <option value="Public Health" <?= $item['category'] == 'Public Health' ? 'selected' : '' ?>>Public Health Alert</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold text-dark small mb-1">Urgency Metric</label>
                                                        <select name="urgency_level" class="form-select gov-form-control px-3 py-2" required>
                                                            <option value="low" <?= $item['urgency_level'] == 'low' ? 'selected' : '' ?>>Low Priority</option>
                                                            <option value="medium" <?= $item['urgency_level'] == 'medium' ? 'selected' : '' ?>>Medium Priority</option>
                                                            <option value="high" <?= $item['urgency_level'] == 'high' ? 'selected' : '' ?>>High Priority</option>
                                                            <option value="urgent" <?= $item['urgency_level'] == 'urgent' ? 'selected' : '' ?>>Urgent / Critical</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold text-dark small mb-1">Visibility Strategy</label>
                                                        <select name="status" class="form-select gov-form-control px-3 py-2" required>
                                                            <option value="draft" <?= $item['status'] == 'draft' ? 'selected' : '' ?>>Draft Blueprint</option>
                                                            <option value="published" <?= $item['status'] == 'published' ? 'selected' : '' ?>>Live Public Board</option>
                                                            <option value="archived" <?= $item['status'] == 'archived' ? 'selected' : '' ?>>Archived Node</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-bold text-dark small mb-1">Detailed Message Body</label>
                                                    <textarea name="content" class="form-control gov-form-control px-3 py-2" rows="6" required><?= esc($item['content']) ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light border-top px-4 py-3">
                                                <button type="button" class="btn btn-gov-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-gov-primary px-4">Save Dynamic Updates</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <i class="far fa-bell-slash d-block fs-3 mb-2 opacity-50" style="color: var(--gov-navy-primary);"></i>
                                    <span class="small fw-medium">No system board bulletins found inside the active data model stream.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createNoticeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-1 rounded-1 shadow-sm">
            <form action="<?= base_url('admin/notices/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-header bg-light border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center" style="font-size: 1rem;">
                        <i class="fas fa-bullhorn me-2" style="color: var(--gov-navy-primary);"></i>Dispatch New Board Notice
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-dark small mb-1">Notification Title Headline</label>
                            <input type="text" name="title" class="form-control gov-form-control px-3 py-2" placeholder="Provide distinct headline label summary..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-1">Reference Tracking ID</label>
                            <div class="form-control gov-form-control px-3 py-2 bg-light text-muted d-flex align-items-center small" style="height: 38px;">
                                <i class="fas fa-magic text-muted opacity-75 me-2"></i> Auto-Generated (System)
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-1">Category Stream</label>
                            <select name="category" class="form-select gov-form-control px-3 py-2" required>
                                <option value="General" selected>General Bulletin</option>
                                <option value="Tenders">Procurement & Tenders</option>
                                <option value="Vacancies">Council Careers / Vacancies</option>
                                <option value="Public Health">Public Health Alert</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-1">Urgency Metric</label>
                            <select name="urgency_level" class="form-select gov-form-control px-3 py-2" required>
                                <option value="low">Low Priority</option>
                                <option value="medium" selected>Medium Priority</option>
                                <option value="high">High Priority</option>
                                <option value="urgent">Urgent / Critical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-dark small mb-1">Visibility Strategy</label>
                            <select name="status" class="form-select gov-form-control px-3 py-2" required>
                                <option value="draft" selected>Draft Blueprint</option>
                                <option value="published">Live Public Board</option>
                                <option value="archived">Archived Node</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold text-dark small mb-1">Detailed Message Content Body</label>
                        <textarea name="content" class="form-control gov-form-control px-3 py-2" rows="6" placeholder="Write core public announcement profile specifications explicitly here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top px-4 py-3">
                    <button type="button" class="btn btn-gov-secondary" data-bs-dismiss="modal">Abort</button>
                    <button type="submit" class="btn btn-gov-primary px-4">Publish Board Pathway</button>
                </div>
            </form>
        </div>
    </div>
</div>