<!-- Main Page Header -->
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 pb-3 border-bottom gap-3">
    <div>
        <h2 class="fw-bold text-dark mb-1 tracking-tight">Leadership & Administration</h2>
        <p class="text-muted small mb-0">Manage council member profiles, operational management team details, and directory rosters.</p>
    </div>
    
    <div class="d-flex gap-2 adaptive-action-container">
        <button type="button" id="addOfficialBtn" class="btn btn-primary px-3 py-2 fw-semibold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createOfficialModal">
            <i class="fas fa-plus me-2"></i>Add Official
        </button>
        <button type="button" id="addManagementBtn" class="btn btn-dark px-3 py-2 fw-semibold shadow-sm d-none align-items-center" data-bs-toggle="modal" data-bs-target="#createManagementModal">
            <i class="fas fa-plus me-2"></i>Add Management Member
        </button>
    </div>
</div>

<!-- Global Notification Flash Alert Templates -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2 fs-5 text-success"></i>
        <div><?= session()->getFlashdata('success') ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-circle me-2 fs-5 text-danger"></i>
        <div><?= session()->getFlashdata('error') ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show d-flex align-items-start" role="alert">
        <i class="fas fa-exclamation-circle me-2 mt-1 fs-5 text-danger"></i>
        <div class="w-100">
            <h6 class="fw-bold alert-heading mb-1">Please correct the following:</h6>
            <ul class="mb-0 ps-3">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Directory Navigation Controls -->
<ul class="nav nav-pills mb-4 p-1 bg-light border rounded-3" id="directoryTab" role="tablist" style="width: fit-content;">
    <li class="nav-item" role="presentation">
        <button class="nav-link active fw-semibold px-4 py-2" id="officials-tab" data-bs-toggle="pill" data-bs-target="#pills-officials" type="button" role="tab" aria-controls="pills-officials" aria-selected="true">
            <i class="fas fa-gavel me-2"></i>Elected Officials
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-semibold px-4 py-2 text-secondary" id="management-tab" data-bs-toggle="pill" data-bs-target="#pills-management" type="button" role="tab" aria-controls="pills-management" aria-selected="false">
            <i class="fas fa-briefcase me-2"></i>Management Team
        </button>
    </li>
</ul>

<!-- Tab Panel Views -->
<div class="tab-content" id="directoryTabContent">
    
    <!-- Tab Pane: Officials -->
    <div class="tab-pane fade show active" id="pills-officials" role="tabpanel" aria-labelledby="officials-tab">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7 text-muted border-bottom">
                            <tr>
                                <th style="width: 90px;" class="ps-4 py-3">Photo</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">Position</th>
                                <th class="py-3">Department</th>
                                <th class="py-3">Email Address</th>
                                <th class="py-3">Phone</th>
                                <th class="py-3">Status</th>
                                <th class="text-end pe-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($officials)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <div class="py-4">
                                        <i class="fas fa-folder-open fs-1 text-black-50 mb-3"></i>
                                        <p class="mb-0 fw-medium">No elected officials found yet.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($officials as $official): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-inline-block p-1 bg-white border rounded-circle shadow-sm">
                                            <img src="<?= base_url($official['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark fs-6"><?= esc($official['name']) ?></div>
                                        <small class="text-muted d-block d-md-none"><?= esc($official['position']) ?></small>
                                    </td>
                                    <td><span class="text-dark fw-medium"><?= esc($official['position']) ?></span></td>
                                    <td><span class="badge bg-light text-dark border px-2.5 py-1.5 fw-medium"><?= esc($official['department']) ?: 'N/A' ?></span></td>
                                    <td><a href="mailto:<?= esc($official['email']) ?>" class="text-decoration-none text-primary fw-medium"><i class="far fa-envelope me-1.5 opacity-75"></i><?= esc($official['email']) ?></a></td>
                                    <td><span class="text-secondary font-monospace small"><?= esc($official['phone']) ?: '—' ?></span></td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-semibold <?= $official['is_active'] ? 'bg-success text-success bg-opacity-10 border border-success border-opacity-20' : 'bg-secondary text-secondary bg-opacity-10 border border-secondary border-opacity-20' ?>">
                                            <i class="fas fa-circle fs-8 me-1.5 align-middle"></i><?= $official['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-2 justify-content-end align-items-center">
                                            <button type="button" class="btn btn-sm btn-white border shadow-sm text-dark px-2.5 edit-official-btn"
                                                    data-id="<?= $official['id'] ?>"
                                                    data-name="<?= esc($official['name']) ?>"
                                                    data-position="<?= esc($official['position']) ?>"
                                                    data-department="<?= esc($official['department']) ?>"
                                                    data-email="<?= esc($official['email']) ?>"
                                                    data-phone="<?= esc($official['phone']) ?>"
                                                    data-bio="<?= esc($official['bio']) ?>"
                                                    data-sort="<?= esc($official['sort_order']) ?>"
                                                    data-active="<?= $official['is_active'] ?>">
                                                <i class="fas fa-pen text-primary me-1"></i> Edit
                                            </button>
                                            <form method="POST" action="<?= base_url('admin/officials/' . $official['id'] . '/delete') ?>" class="m-0 dynamic-delete-form">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-white border text-danger shadow-sm px-2.5 btn-delete-submit" title="Remove Profile">
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

    <!-- Tab Pane: Management -->
    <div class="tab-pane fade" id="pills-management" role="tabpanel" aria-labelledby="management-tab">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7 text-muted border-bottom">
                            <tr>
                                <th style="width: 90px;" class="ps-4 py-3">Photo</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">Position</th>
                                <th class="py-3">Email Address</th>
                                <th class="py-3">Phone</th>
                                <th class="py-3">Status</th>
                                <th class="text-end pe-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($members)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <div class="py-4">
                                        <i class="fas fa-folder-open fs-1 text-black-50 mb-3"></i>
                                        <p class="mb-0 fw-medium">No management team members found.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($members as $member): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-inline-block p-1 bg-white border rounded-circle shadow-sm">
                                            <img src="<?= base_url($member['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td><div class="fw-bold text-dark fs-6"><?= esc($member['name']) ?></div></td>
                                    <td><span class="text-dark fw-medium"><?= esc($member['position']) ?></span></td>
                                    <td><a href="mailto:<?= esc($member['email']) ?>" class="text-decoration-none text-primary fw-medium"><i class="far fa-envelope me-1.5 opacity-75"></i><?= esc($member['email']) ?></a></td>
                                    <td><span class="text-secondary font-monospace small"><?= esc($member['phone']) ?: '—' ?></span></td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-semibold <?= $member['is_active'] ? 'bg-success text-success bg-opacity-10 border border-success border-opacity-20' : 'bg-secondary text-secondary bg-opacity-10 border border-secondary border-opacity-20' ?>">
                                            <i class="fas fa-circle fs-8 me-1.5 align-middle"></i><?= $member['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex gap-2 justify-content-end align-items-center">
                                            <button type="button" class="btn btn-sm btn-white border shadow-sm text-dark px-2.5 edit-management-btn"
                                                    data-id="<?= $member['id'] ?>"
                                                    data-name="<?= esc($member['name']) ?>"
                                                    data-position="<?= esc($member['position']) ?>"
                                                    data-email="<?= esc($member['email']) ?>"
                                                    data-phone="<?= esc($member['phone']) ?>"
                                                    data-bio="<?= esc($member['bio']) ?>"
                                                    data-sort="<?= esc($member['sort_order']) ?>"
                                                    data-active="<?= $member['is_active'] ?>">
                                                <i class="fas fa-pen text-primary me-1"></i> Edit
                                            </button>
                                            <form method="POST" action="<?= base_url('admin/management/' . $member['id'] . '/delete') ?>" class="m-0 dynamic-delete-form">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-white border text-danger shadow-sm px-2.5 btn-delete-submit" title="Remove Profile">
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

<!-- ==================== MODAL LAYOUT CONTAINERS ==================== -->

<!-- Modal: Add Official -->
<div class="modal fade" id="createOfficialModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-light border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center"><i class="fas fa-user-plus text-primary me-2.5"></i>Add Elected Official</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="dynamic-action-form" action="<?= base_url('admin/officials/create') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Official Position Title</label>
                            <input type="text" name="position" class="form-control" placeholder="e.g. Council Chairperson" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Assigned Department</label>
                            <input type="text" name="department" class="form-control" placeholder="e.g. Finance & Treasury">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Profile Directory Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@council.gov">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Biography</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Brief biographical overview..."></textarea>
                        </div>
                        <div class="col-md-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border-0 d-flex flex-row align-items-center justify-content-between ps-5">
                                <label class="form-check-label fw-medium text-dark cursor-pointer" for="pubOfficialNow">Publish immediately to website directory</label>
                                <input class="form-check-input mt-0 float-none" type="checkbox" name="is_active" id="pubOfficialNow" value="1" checked>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-medium" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-medium d-flex align-items-center btn-submit-action">
                        <span>Save Profile</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Official -->
<div class="modal fade" id="editOfficialModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-light border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center"><i class="fas fa-user-edit text-primary me-2.5"></i>Edit Official Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editOfficialForm" class="dynamic-action-form" method="POST" action="" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Full Name</label>
                            <input type="text" name="name" id="editOfficialName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Official Position Title</label>
                            <input type="text" name="position" id="editOfficialPosition" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Assigned Department</label>
                            <input type="text" name="department" id="editOfficialDepartment" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Display Sort Order</label>
                            <input type="number" name="sort_order" id="editOfficialSortOrder" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Email Address</label>
                            <input type="email" name="email" id="editOfficialEmail" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Phone Number</label>
                            <input type="text" name="phone" id="editOfficialPhone" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Replace Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Biography Context</label>
                            <textarea name="bio" id="editOfficialBio" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border-0 d-flex flex-row align-items-center justify-content-between ps-5">
                                <label class="form-check-label fw-medium text-dark cursor-pointer" for="editOfficialIsActive">Keep active on website directory</label>
                                <input class="form-check-input mt-0 float-none" type="checkbox" name="is_active" id="editOfficialIsActive" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-medium" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-medium d-flex align-items-center btn-submit-action">
                        <span>Update Profile</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Management -->
<div class="modal fade" id="createManagementModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-light border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center"><i class="fas fa-user-plus text-success me-2.5"></i>Add Management Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" class="dynamic-action-form" action="<?= base_url('admin/management/create') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Jane Smith" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Management Position Title</label>
                            <input type="text" name="position" class="form-control" placeholder="e.g. Chief Executive Officer" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="jsmith@council.org">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Profile Directory Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Biography</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Brief professional overview..."></textarea>
                        </div>
                        <div class="col-md-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border-0 d-flex flex-row align-items-center justify-content-between ps-5">
                                <label class="form-check-label fw-medium text-dark cursor-pointer" for="pubMgmtNow">Publish immediately to website directory</label>
                                <input class="form-check-input mt-0 float-none" type="checkbox" name="is_active" id="pubMgmtNow" value="1" checked>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-medium" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark px-4 fw-medium d-flex align-items-center btn-submit-action">
                        <span>Save Member</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Management -->
<div class="modal fade" id="editManagementModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-light border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center"><i class="fas fa-user-edit text-success me-2.5"></i>Edit Management Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editManagementForm" class="dynamic-action-form" method="POST" action="" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Full Name</label>
                            <input type="text" name="name" id="editMgmtName" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Management Position Title</label>
                            <input type="text" name="position" id="editMgmtPosition" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Email Address</label>
                            <input type="email" name="email" id="editMgmtEmail" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Phone Number</label>
                            <input type="text" name="phone" id="editMgmtPhone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Display Sort Order</label>
                            <input type="number" name="sort_order" id="editMgmtSortOrder" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Replace Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-muted text-uppercase mb-1">Biography Context</label>
                            <textarea name="bio" id="editMgmtBio" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 pt-2">
                            <div class="form-check form-switch card p-3 bg-light border-0 d-flex flex-row align-items-center justify-content-between ps-5">
                                <label class="form-check-label fw-medium text-dark cursor-pointer" for="editMgmtIsActive">Keep active on website directory</label>
                                <input class="form-check-input mt-0 float-none" type="checkbox" name="is_active" id="editMgmtIsActive" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-medium" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark px-4 fw-medium d-flex align-items-center btn-submit-action">
                        <span>Update Member</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Extra Design Rules Utility CSS Custom Styles -->
<style>
    .fs-7 { font-size: 0.8rem !important; }
    .fs-8 { font-size: 0.6rem !important; }
    .px-2.5 { padding-left: 0.65rem !important; padding-right: 0.65rem !important; }
    .py-1.5 { padding-top: 0.35rem !important; padding-bottom: 0.35rem !important; }
    .btn-white { background-color: #fff; border-color: #dee2e6; color: #212529; }
    .btn-white:hover { background-color: #f8f9fa; color: #212529; border-color: #c6c7c8; }
    .tracking-tight { letter-spacing: -0.025em; }
    .cursor-pointer { cursor: pointer; }
</style>

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