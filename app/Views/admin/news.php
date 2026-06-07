<style>
    .filter-toolbar {
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .search-input-group {
        position: relative;
    }
    .search-input-group i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    .search-input-group input {
        padding-left: 35px;
        border-radius: 0.5rem;
        border-color: #e2e8f0;
    }
    .search-input-group input:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    .status-select {
        border-radius: 0.5rem;
        border-color: #e2e8f0;
        color: #475569;
    }
    .status-select:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    .table-avatar { 
        width: 44px; 
        height: 44px; 
        object-fit: cover; 
        border-radius: 0.5rem; 
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    
    /* Toggle states for unified view/edit layout modal */
    .modal-view-mode .form-control-plaintext { font-weight: 500; color: #1e293b; }
    .modal-view-mode .editable-field { display: none !important; }
    .modal-view-mode .modal-footer-edit { display: none !important; }

    .modal-edit-mode .static-text-field { display: none !important; }
    .modal-edit-mode .editable-field { display: block !important; }
    .modal-edit-mode .modal-footer-view { display: none !important; }
    
    .auto-dismiss-alert {
        transition: all 0.4s ease-in-out;
        opacity: 1;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1">Press Releases & Notices</h2>
        <p class="text-muted small mb-0">Manage community updates, media publications, and official public announcements.</p>
    </div>
    <div>
        <button type="button" class="btn btn-primary px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#createNewsModal">
            <i class="fas fa-plus me-2"></i>Draft Press Release
        </button>
    </div>
</div>

<div id="alertWrapper">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 alert-dismissible fade show auto-dismiss-alert" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4 alert-dismissible fade show auto-dismiss-alert" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<div class="filter-toolbar p-3 mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-6 col-lg-4">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search by title, excerpt, or status...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select">
                <option value="all">All Content Cycles</option>
                <option value="draft">Draft Articles</option>
                <option value="published">Published Live</option>
                <option value="archived">Archived Notices</option>
            </select>
        </div>
        <div class="col text-md-end text-muted small" id="filterCount"></div>
    </div>
</div>

<div class="card dashboard-card mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="newsTable">
                <thead>
                    <tr>
                        <th style="width: 80px; padding-left: 1.5rem;">Cover</th>
                        <th>Article Details</th>
                        <th>Short Teaser Excerpt</th>
                        <th>Release Schedule Date</th>
                        <th>Workflow Status</th>
                        <th class="text-end" style="padding-right: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($news)): ?>
                        <tr id="noDataRow">
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-newspaper d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No press releases or board announcements published yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($news as $item): ?>
                            <tr class="news-row" 
                                id="news-row-<?= $item['id'] ?>"
                                data-search="<?= strtolower(esc($item['title'] . ' ' . ($item['excerpt'] ?? '') . ' ' . $item['status'])) ?>"
                                data-lifecycle="<?= esc($item['status']) ?>"
                                data-id="<?= $item['id'] ?>"
                                data-title="<?= esc($item['title']) ?>"
                                data-slug="<?= esc($item['slug']) ?>"
                                data-status="<?= esc($item['status']) ?>"
                                data-published="<?= esc($item['published_at'] ?? '') ?>"
                                data-image="<?= esc($item['featured_image'] ?? '') ?>"
                                data-excerpt="<?= esc($item['excerpt'] ?? '') ?>"
                                data-content="<?= esc($item['content'] ?? '') ?>">
                                <td style="padding-left: 1.5rem;">
                                    <img src="<?= base_url($item['featured_image'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="News Media" class="table-avatar">
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block"><?= esc($item['title']) ?></span>
                                    <span class="text-muted small font-monospace">/<?= esc($item['slug']) ?></span>
                                </td>
                                <td>
                                    <span class="text-secondary small d-inline-block text-truncate" style="max-width: 280px;">
                                        <?= esc($item['excerpt'] ?: 'No descriptive text summary provided.') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-slate-700 small">
                                        <i class="far fa-calendar-alt me-1 text-muted"></i> 
                                        <?= $item['published_at'] ? date('M d, Y', strtotime($item['published_at'])) : 'Unscheduled' ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($item['status'] === 'draft'): ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning text-capitalize">Draft</span>
                                    <?php elseif ($item['status'] === 'published'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success text-capitalize">Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary text-capitalize">Archived</span>
                                    <?php endif; ?>
                                </td>
                                <td style="padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary px-3 btn-view-news">
                                            <i class="fas fa-eye me-1"></i> View & Manage
                                        </button>
                                        <form method="POST" action="<?= base_url('admin/news/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Permanently drop news entry: <?= esc($item['title'], 'js') ?>?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fas fa-search d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                            No articles match your layout directory filter options.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createNewsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-bottom">
                <h5 class="modal-title fw-bold text-slate-800">Draft News Publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('admin/news/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">Article Headline Title</label>
                            <input type="text" name="title" id="create_title" class="form-control" required placeholder="e.g., Annual Regional Development Summit 2026">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted">URL Slug Identifier</label>
                            <input type="text" name="slug" id="create_slug" class="form-control" required placeholder="annual-regional-development-summit-2026">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium small text-muted">Workflow Lifecycle Status</label>
                            <select name="status" class="form-select status-select" required>
                                <option value="draft" selected>Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium small text-muted">Publish Release Date Time</label>
                            <input type="datetime-local" name="published_at" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium small text-muted">Featured Image URL Asset</label>
                            <input type="text" name="featured_image" class="form-control" placeholder="image/news/summit.jpg">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Short Excerpt / Ledger Summary Teaser</label>
                            <input type="text" name="excerpt" class="form-control" placeholder="A brief hook sentence displayed on post indexes...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted">Full Communication Copy / Body Markdown Content</label>
                            <textarea name="content" class="form-control" rows="8" required placeholder="Type the complete comprehensive public news article details here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save News Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-view-mode" id="unifiedNewsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form method="POST" id="unifiedNewsForm" action="">
                <?= csrf_field() ?>
                
                <div class="modal-header bg-light border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fw-bold text-slate-800 me-3" id="modalTitleText">News Publication Entry</h5>
                        <div class="form-check form-switch m-0 pt-1">
                            <input class="form-check-input btn-check-toggle-edit" type="checkbox" id="enableEditToggle">
                            <label class="form-check-label small fw-semibold text-primary" for="enableEditToggle" style="cursor: pointer;">
                                <i class="fas fa-edit me-1"></i>Edit Mode
                            </label>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">Article Headline Title</label>
                            <div class="static-text-field form-control-plaintext fs-5 fw-bold text-dark" id="view_title"></div>
                            <div class="editable-field">
                                <input type="text" name="title" id="edit_title" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium small text-muted mb-1">URL Slug Reference</label>
                            <div class="static-text-field form-control-plaintext text-muted font-monospace" id="view_slug"></div>
                            <div class="editable-field">
                                <input type="text" name="slug" id="edit_slug" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium small text-muted mb-1">Lifecycle Status</label>
                            <div class="static-text-field form-control-plaintext text-capitalize fw-bold" id="view_status"></div>
                            <div class="editable-field">
                                <select name="status" id="edit_status" class="form-select status-select" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium small text-muted mb-1">Publication Timestamp</label>
                            <div class="static-text-field form-control-plaintext" id="view_published_at"></div>
                            <div class="editable-field">
                                <input type="datetime-local" name="published_at" id="edit_published_at" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium small text-muted mb-1">Featured Asset Path</label>
                            <div class="static-text-field form-control-plaintext text-truncate" id="view_featured_image"></div>
                            <div class="editable-field">
                                <input type="text" name="featured_image" id="edit_featured_image" class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium small text-muted mb-1">Short Excerpt Summary Teaser</label>
                            <div class="static-text-field form-control-plaintext text-secondary italic" style="font-style: italic;" id="view_excerpt"></div>
                            <div class="editable-field">
                                <input type="text" name="excerpt" id="edit_excerpt" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label fw-medium small text-muted mb-1">Full Article Copy Body</label>
                            <div class="static-text-field p-3 bg-light rounded border small text-dark" style="white-space: pre-wrap; min-height: 120px;" id="view_content"></div>
                            <div class="editable-field">
                                <textarea name="content" id="edit_content" class="form-control" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-view">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close Ledger View</button>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-edit">
                    <button type="button" class="btn btn-outline-secondary" id="btnCancelEdit">Cancel Changes</button>
                    <button type="submit" class="btn btn-success px-4 shadow-sm"><i class="fas fa-save me-2"></i>Update Entry Spec</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        function initNewsDashboard() {
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.news-row');
            const noResultsRow = document.getElementById('noResultsRow');
            const filterCountOutput = document.getElementById('filterCount');

            // Automatically turn text string strings into cleaner URL hyphens
            const createTitle = document.getElementById('create_title');
            const createSlug = document.getElementById('create_slug');
            if (createTitle && createSlug) {
                createTitle.addEventListener('input', function() {
                    createSlug.value = this.value
                        .toLowerCase()
                        .replace(/[^a-z0-9 -]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                });
            }

            // --- 1. Notification Alert Box Dismiss Trigger Engine ---
            const targetAlerts = document.querySelectorAll('.auto-dismiss-alert');
            targetAlerts.forEach(function(alertInstance) {
                setTimeout(function() {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alertInstance);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 3000);
            });

            // --- 2. Live Client Search Filter Router ---
            function filterTable() {
                if (!searchInput || !statusFilter) return;
                const queryValue = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const searchableText = row.getAttribute('data-search');
                    const lifecycleStatus = row.getAttribute('data-lifecycle');
                    
                    const matchesSearch = searchableText.includes(queryValue);
                    const matchesStatus = (statusValue === 'all' || lifecycleStatus === statusValue);

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (filterCountOutput) {
                    filterCountOutput.textContent = `Showing ${visibleCount} of ${tableRows.length} news indices`;
                }
                
                if (noResultsRow) {
                    noResultsRow.style.display = (visibleCount === 0 && tableRows.length > 0) ? '' : 'none';
                }
            }
            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);

            // --- 3. Single-Modal View/Edit Engine Routing ---
            const unifiedModalElement = document.getElementById('unifiedNewsModal');
            const unifiedModal = new bootstrap.Modal(unifiedModalElement);
            const editToggleSwitch = document.getElementById('enableEditToggle');
            const unifiedForm = document.getElementById('unifiedNewsForm');
            const cancelEditBtn = document.getElementById('btnCancelEdit');

            function setModalMode(isEditMode) {
                if (isEditMode) {
                    unifiedModalElement.classList.remove('modal-view-mode');
                    unifiedModalElement.classList.add('modal-edit-mode');
                    document.getElementById('modalTitleText').innerHTML = '<i class="fas fa-sliders-h text-warning me-2"></i>Modify Copy Article Specifications';
                } else {
                    unifiedModalElement.classList.remove('modal-edit-mode');
                    unifiedModalElement.classList.add('modal-view-mode');
                    document.getElementById('modalTitleText').innerHTML = 'News Publication Entry';
                    editToggleSwitch.checked = false;
                }
            }

            document.querySelectorAll('.btn-view-news').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('.news-row');
                    const newsId = row.getAttribute('data-id');

                    // Map specific routing endpoint for operational storage update
                    unifiedForm.action = `<?= base_url('admin/news') ?>/${newsId}/edit`;

                    // Bind Display Data Nodes
                    document.getElementById('view_title').textContent = row.getAttribute('data-title');
                    document.getElementById('view_slug').textContent = `/${row.getAttribute('data-slug')}`;
                    document.getElementById('view_status').textContent = row.getAttribute('data-status');
                    document.getElementById('view_published_at').textContent = row.getAttribute('data-published') || 'Not Scheduled (Draft Status)';
                    document.getElementById('view_featured_image').textContent = row.getAttribute('data-image') || 'None Selected';
                    document.getElementById('view_excerpt').textContent = row.getAttribute('data-excerpt') || 'No custom quick description provided.';
                    document.getElementById('view_content').textContent = row.getAttribute('data-content');

                    // Sync Form Inputs
                    document.getElementById('edit_title').value = row.getAttribute('data-title');
                    document.getElementById('edit_slug').value = row.getAttribute('data-slug');
                    document.getElementById('edit_status').value = row.getAttribute('data-status');
                    document.getElementById('edit_published_at').value = row.getAttribute('data-published');
                    document.getElementById('edit_featured_image').value = row.getAttribute('data-image');
                    document.getElementById('edit_excerpt').value = row.getAttribute('data-excerpt');
                    document.getElementById('edit_content').value = row.getAttribute('data-content');

                    // Revert to pristine reading environment view layout state
                    setModalMode(false);
                    unifiedModal.show();
                });
            });

            if (editToggleSwitch) {
                editToggleSwitch.addEventListener('change', function() {
                    setModalMode(this.checked);
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function() {
                    setModalMode(false);
                });
            }
            
            filterTable();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initNewsDashboard);
        } else {
            initNewsDashboard();
        }
    })();
</script>