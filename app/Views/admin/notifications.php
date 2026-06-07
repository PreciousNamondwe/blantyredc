<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="m-0 fw-bold tracking-tight text-dark">
            <i class="fas fa-bell text-warning me-2 animate-bell"></i>Official Board Notifications
        </h2>
        <p class="text-muted m-0 mt-1 small">Manage public board updates, urgent council notifications, and media press announcements.</p>
    </div>
    <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
        <button type="button" class="btn btn-primary btn-sm px-3 py-2 shadow-sm fw-medium rounded-2" data-bs-toggle="modal" data-bs-target="#createNoticeModal">
            <i class="fas fa-plus-circle me-2"></i>Dispatch Notice
        </button>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center justify-content-between p-3 rounded-3" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fs-5 me-2 text-success"></i>
            <span class="fw-medium small text-success"><?= session()->getFlashdata('success') ?></span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger border-0 shadow-sm mb-4 p-3 rounded-3" role="alert">
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

<div class="card border-0 shadow-sm dashboard-card overflow-hidden rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary border-bottom">
                    <tr style="font-size: 0.825rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <th class="ps-4 py-3" style="width: 140px;">Tracking ID</th>
                        <th class="py-3">Notice Info</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Urgency</th>
                        <th class="py-3">Status</th>
                        <th class="pe-4 py-3 text-end" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notices) && is_array($notices)) : ?>
                        <?php foreach ($notices as $item) : ?>
                            <tr class="transition-all">
                                <td class="ps-4 text-muted font-monospace small fw-bold">
                                    <?= esc($item['reference']) ?>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark text-truncate mb-1" style="max-width: 260px;"><?= esc($item['title']) ?></div>
                                    <span class="text-muted small text-wrap-300"><?= character_limiter(esc($item['content']), 60) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded small fw-medium text-capitalize">
                                        <?= esc($item['category']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                        $urgencyClass = 'bg-secondary text-secondary';
                                        if($item['urgency_level'] === 'urgent') $urgencyClass = 'bg-danger text-danger';
                                        elseif($item['urgency_level'] === 'high') $urgencyClass = 'bg-warning text-warning';
                                        elseif($item['urgency_level'] === 'medium') $urgencyClass = 'bg-info text-info';
                                    ?>
                                    <span class="badge rounded-pill px-2 py-1 <?= $urgencyClass ?> bg-opacity-10 small fw-semibold text-capitalize">
                                        <?= esc($item['urgency_level']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($item['status'] === 'published') : ?>
                                        <span class="badge rounded-pill px-2 py-1 bg-success text-success bg-opacity-10 small fw-medium">Live Board</span>
                                    <?php elseif ($item['status'] === 'draft') : ?>
                                        <span class="badge rounded-pill px-2 py-1 bg-warning text-warning bg-opacity-10 small fw-medium">Draft Node</span>
                                    <?php else : ?>
                                        <span class="badge rounded-pill px-2 py-1 bg-secondary text-secondary bg-opacity-10 small fw-medium">Archived</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-sm btn-light border bg-white text-dark px-2 py-1 btn-action" data-bs-toggle="modal" data-bs-target="#editNoticeModal<?= $item['id'] ?>">
                                            <i class="fas fa-edit text-primary me-1"></i>Edit
                                        </button>
                                        <form action="<?= base_url('admin/notices/delete/' . $item['id']) ?>" method="POST" class="d-inline m-0" onsubmit="return confirm('Securely delete this announcement notice from records?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-light border bg-white text-danger px-2 py-1 btn-action">
                                                <i class="fas fa-trash-alt me-1"></i>Purge
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editNoticeModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-3">
                                        <form action="<?= base_url('admin/notices/edit/' . $item['id']) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <div class="modal-header border-bottom bg-light px-4 py-3">
                                                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit text-primary me-2"></i>Edit Notice Settings</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-medium text-secondary small">Notification Title Headline</label>
                                                        <input type="text" name="title" class="form-control px-3 py-2 border-smooth" value="<?= esc($item['title']) ?>" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-medium text-secondary small">Tracking ID (Immutable)</label>
                                                        <input type="text" class="form-control px-3 py-2 border-smooth bg-light fw-bold text-dark font-monospace" value="<?= esc($item['reference']) ?>" readonly>
                                                        <input type="hidden" name="reference" value="<?= esc($item['reference']) ?>">
                                                    </div>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-medium text-secondary small">Category Context</label>
                                                        <select name="category" class="form-select px-3 py-2 border-smooth" required>
                                                            <option value="General" <?= $item['category'] == 'General' ? 'selected' : '' ?>>General Bulletin</option>
                                                            <option value="Tenders" <?= $item['category'] == 'Tenders' ? 'selected' : '' ?>>Procurement & Tenders</option>
                                                            <option value="Vacancies" <?= $item['category'] == 'Vacancies' ? 'selected' : '' ?>>Council Careers / Vacancies</option>
                                                            <option value="Public Health" <?= $item['category'] == 'Public Health' ? 'selected' : '' ?>>Public Health Alert</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-medium text-secondary small">Urgency Status</label>
                                                        <select name="urgency_level" class="form-select px-3 py-2 border-smooth" required>
                                                            <option value="low" <?= $item['urgency_level'] == 'low' ? 'selected' : '' ?>>Low Priority</option>
                                                            <option value="medium" <?= $item['urgency_level'] == 'medium' ? 'selected' : '' ?>>Medium Priority</option>
                                                            <option value="high" <?= $item['urgency_level'] == 'high' ? 'selected' : '' ?>>High Priority</option>
                                                            <option value="urgent" <?= $item['urgency_level'] == 'urgent' ? 'selected' : '' ?>>Urgent / Critical</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-medium text-secondary small">Visibility Strategy</label>
                                                        <select name="status" class="form-select px-3 py-2 border-smooth" required>
                                                            <option value="draft" <?= $item['status'] == 'draft' ? 'selected' : '' ?>>Draft Blueprint</option>
                                                            <option value="published" <?= $item['status'] == 'published' ? 'selected' : '' ?>>Live Public Board</option>
                                                            <option value="archived" <?= $item['status'] == 'archived' ? 'selected' : '' ?>>Archived Node</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-medium text-secondary small">Detailed Message Body</label>
                                                    <textarea name="content" class="form-control px-3 py-2 border-smooth" rows="6" required><?= esc($item['content']) ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light border-top px-4 py-3">
                                                <button type="button" class="btn btn-sm btn-secondary px-3 py-2 fw-medium rounded-2" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-sm btn-primary px-4 py-2 fw-medium rounded-2">Save Dynamic Updates</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="py-4">
                                    <i class="far fa-bell-slash d-block fs-2 text-muted mb-3 opacity-50"></i>
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
        <div class="modal-content border-0 shadow-lg rounded-3">
            <form action="<?= base_url('admin/notices/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom bg-light px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center"><i class="fas fa-bullhorn text-success me-2"></i>Dispatch New Board Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-medium text-secondary small">Notification Title Headline</label>
                            <input type="text" name="title" class="form-control px-3 py-2 border-smooth" placeholder="Provide distinct headline label summary..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">Reference Tracking ID</label>
                            <div class="form-control px-3 py-2 border-smooth bg-light text-muted d-flex align-items-center small" style="height: 41px;">
                                <i class="fas fa-magic text-primary opacity-75 me-2"></i> Auto-Generated (System)
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">Category Stream</label>
                            <select name="category" class="form-select px-3 py-2 border-smooth" required>
                                <option value="General" selected>General Bulletin</option>
                                <option value="Tenders">Procurement & Tenders</option>
                                <option value="Vacancies">Council Careers / Vacancies</option>
                                <option value="Public Health">Public Health Alert</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">Urgency Metric</label>
                            <select name="urgency_level" class="form-select px-3 py-2 border-smooth" required>
                                <option value="low">Low Priority</option>
                                <option value="medium" selected>Medium Priority</option>
                                <option value="high">High Priority</option>
                                <option value="urgent">Urgent / Critical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary small">Visibility Strategy</label>
                            <select name="status" class="form-select px-3 py-2 border-smooth" required>
                                <option value="draft" selected>Draft Blueprint</option>
                                <option value="published">Live Public Board</option>
                                <option value="archived">Archived Node</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-medium text-secondary small">Detailed Message Content Body</label>
                        <textarea name="content" class="form-control px-3 py-2 border-smooth" rows="6" placeholder="Write core public announcement profile specifications explicitly here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top px-4 py-3">
                    <button type="button" class="btn btn-sm btn-secondary px-3 py-2 fw-medium rounded-2" data-bs-dismiss="modal">Abort</button>
                    <button type="submit" class="btn btn-sm btn-success px-4 py-2 fw-medium text-white rounded-2">Publish Board Pathway</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .border-smooth { border-color: #e2e8f0; border-radius: 0.375rem; }
    .border-smooth:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); }
    .btn-action { font-size: 0.825rem; font-weight: 500; border-radius: 0.375rem; }
    .transition-all { transition: all 0.2s ease-in-out; }
    .text-wrap-300 { max-width: 280px; display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: bottom; }
    .animate-bell { display: inline-block; }
    tr:hover .animate-bell { animation: bell-ring 0.6s ease-in-out; }
    @keyframes bell-ring {
        0%, 100% { transform: rotate(0); }
        20%, 60% { transform: rotate(15deg); }
        40%, 80% { transform: rotate(-15deg); }
    }
</style>