<style>
    :root {
        --gov-navy-primary: #1a3352;
        --gov-navy-hover: #112237;
        --gov-gold: #d4af37;
        --gov-gold-light: #fdfaf2;
        --gov-border: #ccd4dc;
        --gov-bg-muted: #f5f7fa;
        --gov-text: #2d3748;
        /* Excel Grid System Specific Palette */
        --excel-border: #d0d7de;
        --excel-header-bg: #f6f8fa;
    }

    /* Wrap header block with your custom banner variables */
    .gov-banner-header, 
    div[class*="d-flex flex-column flex-md-row justify-content-between align-items-start"] {
        background: linear-gradient(135deg, var(--gov-navy-primary) 0%, #2c4d75 100%) !important;
        border-bottom: 4px solid var(--gov-gold) !important;
        border-radius: 4px 4px 0 0 !important;
        padding: 1.25rem 1.75rem !important;
        color: #ffffff !important;
    }

    /* Inject gold left-border seal into the main identity block */
    div[class*="d-flex flex-column flex-md-row justify-content-between align-items-start"] > div:first-child {
        border-left: 4px solid var(--gov-gold) !important;
        padding-left: 1.25rem !important;
    }

    /* Ensure text visibility remains high against gradient background */
    div[class*="d-flex flex-column flex-md-row justify-content-between align-items-start"] h2,
    div[class*="d-flex flex-column flex-md-row justify-content-between align-items-start"] p {
        color: #ffffff !important;
    }

    /* Primary and utility action buttons */
    button[style*="background-color: #1e3a8a"] {
        background-color: var(--gov-navy-primary) !important;
        border-color: var(--gov-navy-primary) !important;
        font-family: 'SFMono-Regular', Consolas, "Liberation Mono", Menlo, monospace !important;
        border-radius: 4px !important;
        color: var(--gov-gold) !important;
    }
    button[style*="background-color: #1e3a8a"]:hover {
        background-color: var(--gov-navy-hover) !important;
        border-color: var(--gov-navy-hover) !important;
    }

    /* Navigation pill variables linking matching theme values */
    .nav-pills .nav-link {
        color: var(--gov-text) !important;
        font-size: 0.85rem !important;
    }
    .nav-pills .nav-link.active {
        background-color: var(--gov-navy-primary) !important;
        border-bottom: 2px solid var(--gov-gold) !important;
        color: #ffffff !important;
    }

    /* Excel Spreadsheet Grid Strategy */
    .table-responsive {
        border: 1px solid var(--excel-border) !important;
        background-color: #ffffff !important;
        border-radius: 0 0 4px 4px !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.04) !important;
    }

    .excel-grid-table, .table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
    }

    /* Strict Grid Cell Borders matching Microsoft Excel Standard */
    .table thead th,
    thead[style*="background-color: #0f172a"] th {
        background-color: var(--excel-header-bg) !important;
        color: #24292f !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.3px !important;
        border: 1px solid var(--excel-border) !important;
        padding: 8px 12px !important;
        vertical-align: middle !important;
    }

    .table td {
        border: 1px solid var(--excel-border) !important;
        padding: 6px 10px !important; /* Compact spreadsheet row structure */
        font-size: 0.85rem !important;
        color: var(--gov-text) !important;
        vertical-align: middle !important;
        background-color: #ffffff !important;
    }

    .table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Inline Grid Input Elements styling overlay */
    .form-control, .excel-grid-input {
        border: 1px solid var(--excel-border) !important;
        border-radius: 2px !important;
        font-size: 0.85rem !important;
        padding: 4px 8px !important;
        color: var(--gov-text) !important;
    }
    .form-control:focus, .excel-grid-input:focus {
        border: 1px solid #0066cc !important; /* Excel Classic Blue Active cell accent */
        box-shadow: inset 0 0 0 1px #0066cc !important;
        outline: none !important;
    }

    /* Embedded card switch inputs */
    .form-check.form-switch.card {
        background-color: var(--gov-gold-light) !important;
        border: 1px solid var(--excel-border) !important;
    }

    /* System alert mutations mapping target tokens */
    .alert-success { border-left: 4px solid #2f855a !important; background-color: #f0fff4 !important; color: #22543d !important; }
    .alert-danger { border-left: 4px solid #c53030 !important; background-color: #fff5f5 !important; color: #742a2a !important; }
</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 pb-4 border-bottom gap-3">
    <div>
        <h2 class="fw-bold text-dark mb-1 tracking-tight">Leadership & Administration</h2>
        <p class="text-secondary mb-0 small text-uppercase fw-semibold tracking-wider">Official Directory Management Portal</p>
    </div>
    
    <div class="d-flex gap-2 align-self-sm-stretch align-self-md-auto">
        <button type="button" id="addOfficialBtn" class="btn px-4 py-2 fw-bold text-white shadow-sm d-flex align-items-center justify-content-center flex-grow-1 flex-md-grow-0" style="background-color: #1e3a8a; border-color: #1e3a8a;" data-bs-toggle="modal" data-bs-target="#createOfficialModal">
            <i class="fas fa-plus-circle me-2"></i>Add Official
        </button>
        <button type="button" id="addManagementBtn" class="btn px-4 py-2 fw-bold text-white shadow-sm d-none align-items-center justify-content-center flex-grow-1 flex-md-grow-0" style="background-color: #1e3a8a; border-color: #1e3a8a;" data-bs-toggle="modal" data-bs-target="#createManagementModal">
            <i class="fas fa-plus-circle me-2"></i>Add Management Member
        </button>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 border-start border-4 border-success shadow-sm alert-dismissible fade show p-3 mb-4 d-flex align-items-center rounded-3" role="alert">
        <i class="fas fa-check-circle me-3 fs-5 text-success"></i>
        <div class="fw-semibold text-dark"><?= session()->getFlashdata('success') ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger border-0 border-start border-4 border-danger shadow-sm alert-dismissible fade show p-3 mb-4 d-flex align-items-center rounded-3" role="alert">
        <i class="fas fa-exclamation-circle me-3 fs-5 text-danger"></i>
        <div class="fw-semibold text-dark"><?= session()->getFlashdata('error') ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger border-0 border-start border-4 border-danger shadow-sm alert-dismissible fade show p-3 mb-4 d-flex align-items-start rounded-3" role="alert">
        <i class="fas fa-exclamation-circle me-3 mt-1 fs-5 text-danger"></i>
        <div class="w-100">
            <h6 class="fw-bold alert-heading mb-1 text-danger">Form Validation Error:</h6>
            <ul class="mb-0 ps-3 small text-dark fw-medium">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="bg-light p-1 border rounded-3 mb-4 d-inline-block">
    <ul class="nav nav-pills border-0" id="directoryTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold px-4 py-2 border-0 rounded-2" id="officials-tab" data-bs-toggle="pill" data-bs-target="#pills-officials" type="button" role="tab" aria-controls="pills-officials" aria-selected="true" style="--bs-nav-pills-link-active-bg: #1e3a8a;">
                <i class="fas fa-gavel me-2"></i>Elected Officials
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold px-4 py-2 border-0 rounded-2 text-secondary" id="management-tab" data-bs-toggle="pill" data-bs-target="#pills-management" type="button" role="tab" aria-controls="pills-management" aria-selected="false">
                <i class="fas fa-briefcase me-2"></i>Management Team
            </button>
        </li>
    </ul>
</div>

<div class="tab-content" id="directoryTabContent">
    
    <div class="tab-pane fade show active" id="pills-officials" role="tabpanel" aria-labelledby="officials-tab">
        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-dark text-white text-uppercase" style="background-color: #0f172a;">
                            <tr>
                                <th style="width: 90px;" class="ps-4 py-3 text-white-50 small fw-bold">Photo</th>
                                <th class="py-3 text-white-50 small fw-bold">Official Name</th>
                                <th class="py-3 text-white-50 small fw-bold d-none d-md-table-cell">Position Title</th>
                                <th class="py-3 text-white-50 small fw-bold">Department</th>
                                <th class="py-3 text-white-50 small fw-bold d-none d-lg-table-cell">Email Address</th>
                                <th class="py-3 text-white-50 small fw-bold d-none d-xl-table-cell">Phone</th>
                                <th class="py-3 text-white-50 small fw-bold">Status</th>
                                <th style="width: 160px;" class="text-end pe-4 py-3 text-white-50 small fw-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($officials)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <div class="py-4">
                                        <i class="fas fa-folder-open fs-1 text-black-50 opacity-25 mb-3"></i>
                                        <p class="mb-0 fw-medium text-secondary">No elected officials registered inside this system directory.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($officials as $official): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-inline-block p-0.5 bg-white border rounded-circle shadow-sm">
                                            <img src="<?= base_url($official['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark fs-6"><?= esc($official['name']) ?></div>
                                        <span class="text-secondary small d-block d-md-none fw-medium text-uppercase tracking-wide"><?= esc($official['position']) ?></span>
                                        <span class="text-secondary small d-block d-lg-none mt-1"><i class="far fa-envelope me-1 text-primary"></i><?= esc($official['email']) ?></span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <span class="text-dark fw-bold" style="color: #1e3a8a !important;"><?= esc($official['position']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2.5 py-1.5 fw-semibold rounded-2 text-uppercase"><?= esc($official['department']) ?: 'General Administration' ?></span>
                                    </td>
                                    <td class="d-none d-lg-table-cell">
                                        <a href="mailto:<?= esc($official['email']) ?>" class="text-decoration-none text-primary fw-semibold small">
                                            <i class="far fa-envelope me-1.5 opacity-75"></i><?= esc($official['email']) ?>
                                        </a>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="text-secondary font-monospace small fw-medium"><?= esc($official['phone']) ?: '—' ?></span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-bold <?= $official['is_active'] ? 'bg-success text-success bg-opacity-10 border border-success border-opacity-25' : 'bg-secondary text-secondary bg-opacity-10 border border-secondary border-opacity-25' ?>">
                                            <i class="fas fa-circle fs-8 me-1.5 align-middle"></i><?= $official['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-2 justify-content-end align-items-center">
                                            <button type="button" class="btn btn-sm btn-light border text-dark px-2.5 py-1.5 edit-official-btn shadow-xs fw-semibold"
                                                    data-id="<?= $official['id'] ?>"
                                                    data-name="<?= esc($official['name']) ?>"
                                                    data-position="<?= esc($official['position']) ?>"
                                                    data-department="<?= esc($official['department']) ?>"
                                                    data-email="<?= esc($official['email']) ?>"
                                                    data-phone="<?= esc($official['phone']) ?>"
                                                    data-bio="<?= esc($official['bio']) ?>"
                                                    data-sort="<?= esc($official['sort_order']) ?>"
                                                    data-active="<?= $official['is_active'] ?>">
                                                <i class="fas fa-edit text-secondary me-1"></i> Edit
                                            </button>
                                            <form method="POST" action="<?= base_url('admin/officials/' . $official['id'] . '/delete') ?>" class="m-0 dynamic-delete-form">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 btn-delete-submit shadow-xs" title="Remove Profile">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-management" role="tabpanel" aria-labelledby="management-tab">
        <div class="card border border-light-subtle shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-dark text-white text-uppercase" style="background-color: #0f172a;">
                            <tr>
                                <th style="width: 90px;" class="ps-4 py-3 text-white-50 small fw-bold">Photo</th>
                                <th class="py-3 text-white-50 small fw-bold">Full Name</th>
                                <th class="py-3 text-white-50 small fw-bold d-none d-md-table-cell">Management Role</th>
                                <th class="py-3 text-white-50 small fw-bold d-none d-lg-table-cell">Email Address</th>
                                <th class="py-3 text-white-50 small fw-bold d-none d-xl-table-cell">Phone</th>
                                <th class="py-3 text-white-50 small fw-bold">Status</th>
                                <th style="width: 160px;" class="text-end pe-4 py-3 text-white-50 small fw-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($members)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <div class="py-4">
                                        <i class="fas fa-folder-open fs-1 text-black-50 opacity-25 mb-3"></i>
                                        <p class="mb-0 fw-medium text-secondary">No operational management team members found.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($members as $member): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-inline-block p-0.5 bg-white border rounded-circle shadow-sm">
                                            <img src="<?= base_url($member['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark fs-6"><?= esc($member['name']) ?></div>
                                        <span class="text-secondary small d-block d-md-none fw-medium text-uppercase tracking-wide"><?= esc($member['position']) ?></span>
                                        <span class="text-secondary small d-block d-lg-none mt-1"><i class="far fa-envelope me-1 text-primary"></i><?= esc($member['email']) ?></span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <span class="text-dark fw-bold" style="color: #1e3a8a !important;"><?= esc($member['position']) ?></span>
                                    </td>
                                    <td class="d-none d-lg-table-cell">
                                        <a href="mailto:<?= esc($member['email']) ?>" class="text-decoration-none text-primary fw-semibold small">
                                            <i class="far fa-envelope me-1.5 opacity-75"></i><?= esc($member['email']) ?>
                                        </a>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="text-secondary font-monospace small fw-medium"><?= esc($member['phone']) ?: '—' ?></span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-bold <?= $member['is_active'] ? 'bg-success text-success bg-opacity-10 border border-success border-opacity-25' : 'bg-secondary text-secondary bg-opacity-10 border border-secondary border-opacity-25' ?>">
                                            <i class="fas fa-circle fs-8 me-1.5 align-middle"></i><?= $member['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-2 justify-content-end align-items-center">
                                            <button type="button" class="btn btn-sm btn-light border text-dark px-2.5 py-1.5 edit-management-btn shadow-xs fw-semibold"
                                                    data-id="<?= $member['id'] ?>"
                                                    data-name="<?= esc($member['name']) ?>"
                                                    data-position="<?= esc($member['position']) ?>"
                                                    data-email="<?= esc($member['email']) ?>"
                                                    data-phone="<?= esc($member['phone']) ?>"
                                                    data-bio="<?= esc($member['bio']) ?>"
                                                    data-sort="<?= esc($member['sort_order']) ?>"
                                                    data-active="<?= $member['is_active'] ?>">
                                                <i class="fas fa-edit text-secondary me-1"></i> Edit
                                            </button>
                                            <form method="POST" action="<?= base_url('admin/management/' . $member['id'] . '/delete') ?>" class="m-0 dynamic-delete-form">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 btn-delete-submit shadow-xs" title="Remove Profile">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createOfficialModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-bottom px-4 py-3 bg-dark text-white" style="background-color: #0f172a;">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center"><i class="fas fa-user-plus text-info me-2.5"></i>Create Official Record</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="dynamic-action-form" action="<?= base_url('admin/officials/create') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Full Name</label>
                            <input type="text" name="name" class="form-control border-secondary-subtle" placeholder="e.g. Honorable John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Official Position Title</label>
                            <input type="text" name="position" class="form-control border-secondary-subtle" placeholder="e.g. Council Chairperson" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Assigned Department</label>
                            <input type="text" name="department" class="form-control border-secondary-subtle" placeholder="e.g. Department of Finance">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Profile Directory Photo</label>
                            <input type="file" name="photo" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Email Address</label>
                            <input type="email" name="email" class="form-control border-secondary-subtle" placeholder="username@domain.gov">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Phone Number</label>
                            <input type="text" name="phone" class="form-control border-secondary-subtle" placeholder="+1 (555) 000-0000">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Biography Summary</label>
                            <textarea name="bio" class="form-control border-secondary-subtle" rows="3" placeholder="Provide background profile details..."></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border border-light-subtle d-flex flex-row align-items-center justify-content-between ps-5 rounded-3 shadow-xs">
                                <label class="form-check-label fw-bold text-dark cursor-pointer" for="pubOfficialNow">Publish immediately to active public directory</label>
                                <input class="form-check-input mt-0 h5 mb-0 float-none cursor-pointer" type="checkbox" name="is_active" id="pubOfficialNow" value="1" checked style="background-color: #1e3a8a; border-color: #1e3a8a;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4 fw-bold d-flex align-items-center" style="background-color: #1e3a8a; border-color: #1e3a8a;">
                        <span>Save Record</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editOfficialModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-bottom px-4 py-3 bg-dark text-white" style="background-color: #0f172a;">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center"><i class="fas fa-user-edit text-info me-2.5"></i>Modify Official Record</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editOfficialForm" class="dynamic-action-form" method="POST" action="" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Full Name</label>
                            <input type="text" name="name" id="editOfficialName" class="form-control border-secondary-subtle" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Official Position Title</label>
                            <input type="text" name="position" id="editOfficialPosition" class="form-control border-secondary-subtle" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Assigned Department</label>
                            <input type="text" name="department" id="editOfficialDepartment" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Display Sort Sequence Index</label>
                            <input type="number" name="sort_order" id="editOfficialSortOrder" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Email Address</label>
                            <input type="email" name="email" id="editOfficialEmail" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Phone Number</label>
                            <input type="text" name="phone" id="editOfficialPhone" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Replace Image Asset</label>
                            <input type="file" name="photo" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Biography Summary</label>
                            <textarea name="bio" id="editOfficialBio" class="form-control border-secondary-subtle" rows="3"></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border border-light-subtle d-flex flex-row align-items-center justify-content-between ps-5 rounded-3 shadow-xs">
                                <label class="form-check-label fw-bold text-dark cursor-pointer" for="editOfficialIsActive">Keep visible on system directory lists</label>
                                <input class="form-check-input mt-0 h5 mb-0 float-none cursor-pointer" type="checkbox" name="is_active" id="editOfficialIsActive" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4 fw-bold" style="background-color: #1e3a8a; border-color: #1e3a8a;">
                        <span>Save Adjustments</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createManagementModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-bottom px-4 py-3 bg-dark text-white" style="background-color: #0f172a;">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center"><i class="fas fa-user-plus text-info me-2.5"></i>Create Management Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="dynamic-action-form" action="<?= base_url('admin/management/create') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Full Name</label>
                            <input type="text" name="name" class="form-control border-secondary-subtle" placeholder="e.g. Jane Smith" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Management Position Title</label>
                            <input type="text" name="position" class="form-control border-secondary-subtle" placeholder="e.g. Chief Executive Officer" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Email Address</label>
                            <input type="email" name="email" class="form-control border-secondary-subtle" placeholder="jsmith@domain.org">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Phone Number</label>
                            <input type="text" name="phone" class="form-control border-secondary-subtle" placeholder="+1 (555) 000-0000">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Profile Directory Photo</label>
                            <input type="file" name="photo" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Biography Context</label>
                            <textarea name="bio" class="form-control border-secondary-subtle" rows="3" placeholder="Provide background profile summary..."></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border border-light-subtle d-flex flex-row align-items-center justify-content-between ps-5 rounded-3 shadow-xs">
                                <label class="form-check-label fw-bold text-dark cursor-pointer" for="pubMgmtNow">Publish immediately to active public directory</label>
                                <input class="form-check-input mt-0 h5 mb-0 float-none cursor-pointer" type="checkbox" name="is_active" id="pubMgmtNow" value="1" checked style="background-color: #1e3a8a; border-color: #1e3a8a;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4 fw-bold" style="background-color: #1e3a8a; border-color: #1e3a8a;">
                        <span>Save Record</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editManagementModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-bottom px-4 py-3 bg-dark text-white" style="background-color: #0f172a;">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center"><i class="fas fa-user-edit text-info me-2.5"></i>Modify Management Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editManagementForm" class="dynamic-action-form" method="POST" action="" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Full Name</label>
                            <input type="text" name="name" id="editMgmtName" class="form-control border-secondary-subtle" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Management Position Title</label>
                            <input type="text" name="position" id="editMgmtPosition" class="form-control border-secondary-subtle" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Email Address</label>
                            <input type="email" name="email" id="editMgmtEmail" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Phone Number</label>
                            <input type="text" name="phone" id="editMgmtPhone" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Display Sort Sequence Index</label>
                            <input type="number" name="sort_order" id="editMgmtSortOrder" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Replace Image Asset</label>
                            <input type="file" name="photo" class="form-control border-secondary-subtle">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Biography Context</label>
                            <textarea name="bio" id="editMgmtBio" class="form-control border-secondary-subtle" rows="3"></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border border-light-subtle d-flex flex-row align-items-center justify-content-between ps-5 rounded-3 shadow-xs">
                                <label class="form-check-label fw-bold text-dark cursor-pointer" for="editMgmtIsActive">Keep visible on system directory lists</label>
                                <input class="form-check-input mt-0 h5 mb-0 float-none cursor-pointer" type="checkbox" name="is_active" id="editMgmtIsActive" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4 fw-bold" style="background-color: #1e3a8a; border-color: #1e3a8a;">
                        <span>Save Adjustments</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================== LOGIC AND INTERACTIVE SCRIPTING ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Tab Context Button Toggle Management
    const officialsTab = document.getElementById('officials-tab');
    const managementTab = document.getElementById('management-tab');
    const addOfficialBtn = document.getElementById('addOfficialBtn');
    const addManagementBtn = document.getElementById('addManagementBtn');

    officialsTab.addEventListener('shown.bs.tab', function () {
        addOfficialBtn.classList.remove('d-none');
        addManagementBtn.classList.add('d-none');
        officialsTab.classList.remove('text-secondary');
        managementTab.classList.add('text-secondary');
    });

    managementTab.addEventListener('shown.bs.tab', function () {
        addOfficialBtn.classList.add('d-none');
        addManagementBtn.classList.remove('d-none');
        managementTab.classList.remove('text-secondary');
        officialsTab.classList.add('text-secondary');
    });

    // 2. Elected Officials Modal Processing Hook
    const editOfficialModal = new bootstrap.Modal(document.getElementById('editOfficialModal'));
    const editOfficialForm = document.getElementById('editOfficialForm');
    
    document.querySelectorAll('.edit-official-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            editOfficialForm.setAttribute('action', `<?= base_url('admin/officials') ?>/${id}/edit`);

            document.getElementById('editOfficialName').value = this.getAttribute('data-name');
            document.getElementById('editOfficialPosition').value = this.getAttribute('data-position');
            document.getElementById('editOfficialDepartment').value = this.getAttribute('data-department');
            document.getElementById('editOfficialEmail').value = this.getAttribute('data-email');
            document.getElementById('editOfficialPhone').value = this.getAttribute('data-phone');
            document.getElementById('editOfficialBio').value = this.getAttribute('data-bio');
            document.getElementById('editOfficialSortOrder').value = this.getAttribute('data-sort');
            document.getElementById('editOfficialIsActive').checked = parseInt(this.getAttribute('data-active')) === 1;

            editOfficialModal.show();
        });
    });

    // 3. Management Team Modal Processing Hook
    const editManagementModal = new bootstrap.Modal(document.getElementById('editManagementModal'));
    const editManagementForm = document.getElementById('editManagementForm');

    document.querySelectorAll('.edit-management-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            editManagementForm.setAttribute('action', `<?= base_url('admin/management') ?>/${id}/edit`);

            document.getElementById('editMgmtName').value = this.getAttribute('data-name');
            document.getElementById('editMgmtPosition').value = this.getAttribute('data-position');
            document.getElementById('editMgmtEmail').value = this.getAttribute('data-email');
            document.getElementById('editMgmtPhone').value = this.getAttribute('data-phone');
            document.getElementById('editMgmtBio').value = this.getAttribute('data-bio');
            document.getElementById('editMgmtSortOrder').value = this.getAttribute('data-sort');
            document.getElementById('editMgmtIsActive').checked = parseInt(this.getAttribute('data-active')) === 1;

            editManagementModal.show();
        });
    });

    // 4. Global Inline UI Loader Processing Architecture
    const formInstances = document.querySelectorAll('.dynamic-action-form');
    formInstances.forEach(form => {
        form.addEventListener('submit', function() {
            const activeSubmitBtn = form.querySelector('.btn-submit-action');
            if(activeSubmitBtn) {
                activeSubmitBtn.disabled = true;
                activeSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...`;
            }
        });
    });

    const deleteForms = document.querySelectorAll('.dynamic-delete-form');
    deleteForms.forEach(delForm => {
        delForm.addEventListener('submit', function(e) {
            if (confirm('Permanently remove this configuration item?')) {
                const targetBtn = delForm.querySelector('.btn-delete-submit');
                if (targetBtn) {
                    targetBtn.disabled = true;
                    targetBtn.innerHTML = `<span class="spinner-border spinner-border-sm text-danger" role="status" aria-hidden="true"></span>`;
                }
            } else {
                e.preventDefault();
            }
        });
    });

    // Retain view state across dynamic controller roundtrips if targeted error contexts reload
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.get('tab') === 'management') {
        const tabTrigger = new bootstrap.Tab(managementTab);
        tabTrigger.show();
    }
});
</script>