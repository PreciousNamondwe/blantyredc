<style>
    :root {
        /* Blantyre District Council Registry Tokens */
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

    /* Primary Container Cleanups */
    .filter-toolbar {
        background: var(--gov-navy-hover) !important;
        border: 1px solid var(--excel-border) !important;
        border-radius: 4px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important;
        color:var(--excel-header-bg);
    }

    /* Modern Styled Search Bars */
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
        padding-left: 35px !important;
        border-radius: 3px !important;
        border: 1px solid var(--excel-border) !important;
        font-size: 0.85rem !important;
    }
    .search-input-group input:focus {
        border-color: #0066cc !important;
        box-shadow: inset 0 0 0 1px #0066cc !important;
        outline: none !important;
    }

    /* Core Selection Engine Elements */
    .status-select {
        border-radius: 3px !important;
        border: 1px solid var(--excel-border) !important;
        color: var(--gov-text) !important;
        font-size: 0.85rem !important;
    }
    .status-select:focus {
        border-color: #0066cc !important;
        box-shadow: inset 0 0 0 1px #0066cc !important;
        outline: none !important;
    }

    /* Clean Image Thumbnails */
    .table-avatar { 
        width: 44px; 
        height: 44px; 
        object-fit: cover; 
        border-radius: 4px !important; 
        border: 1px solid var(--excel-border) !important;
    }

    /* Premium Structure Tables */
    .dashboard-card {
        border: 1px solid var(--excel-border) !important;
        background-color: #ffffff !important;
        border-radius: 4px !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03) !important;
    }
    .table {
        border-collapse: collapse !important;
        margin-bottom: 0 !important;
    }
    .table thead th {
        background-color: var(--excel-header-bg) !important;
        color: #24292f !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.3px !important;
        border: 1px solid var(--excel-border) !important;
        padding: 10px 12px !important;
    }
    .table td {
        border: 1px solid var(--excel-border) !important;
        padding: 8px 12px !important;
        font-size: 0.85rem !important;
        color: var(--gov-text) !important;
        background-color: #ffffff !important;
    }
    .table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    /* Global Modal Enhancements */
    .modal-content {
        border-radius: 6px !important;
        overflow: hidden !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }
    .modal-header {
        background: linear-gradient(135deg, var(--gov-navy-primary) 0%, #2c4d75 100%) !important;
        border-bottom: 3px solid var(--gov-gold) !important;
        padding: 1rem 1.5rem !important;
    }
    .modal-header .modal-title {
        color: #ffffff !important;
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(1) brightness(2) !important;
    }
    
    /* Toggle states for unified view/edit layout modal */
    .modal-view-mode .form-control-plaintext { font-weight: 600; color: #1e293b; }
    .modal-view-mode .editable-field { display: none !important; }
    .modal-view-mode .modal-footer-edit { display: none !important; }

    .modal-edit-mode .static-text-field { display: none !important; }
    .modal-edit-mode .editable-field { display: block !important; }
    .modal-edit-mode .modal-footer-view { display: none !important; }
    
    /* System Flash Alerts Overrides */
    .alert-success { 
        border-left: 4px solid #2f855a !important; 
        background-color: #f0fff4 !important; 
        color: #22543d !important; 
    }
    .alert-danger { 
        border-left: 4px solid #c53030 !important; 
        background-color: #fff5f5 !important; 
        color: #742a2a !important; 
    }
    .auto-dismiss-alert {
        transition: all 0.4s ease-in-out;
        opacity: 1;
    }
</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 pb-3 border-bottom gap-3" style="background-color: var(--gov-navy-primary) !important; border-color: var(--gov-navy-primary) !important; padding: 1.5rem !important; border-radius: 4px !important;">
    <div style="border-left: 4px solid var(--gov-gold); padding-left: 1rem;">
        <h2 class="fw-bold mb-1" style="color: var(--excel-header-bg) !important; tracking-tight">Press Releases & Notices</h2>
        <p class="text-muted small mb-0">Manage community updates, media publications, and official public announcements.</p>
    </div>
    <div>
        <button type="button" class="btn px-4 py-2 fw-bold text-white shadow-sm d-flex align-items-center" style="background-color: var(--gov-navy-hover); border-color: var(--gov-navy-hover); border-radius: 4px !important;" data-bs-toggle="modal" data-bs-target="#createNewsModal">
            <i class="fas fa-plus me-2" style="color: var(--gov-gold);"></i>Draft Press Release
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
        <div class="col text-md-end text-muted small fw-semibold" id="filterCount"></div>
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
                        <th class="text-end" style="padding-right: 1.5rem; width: 180px;">Actions</th>
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
                                    <span class="fw-bold text-dark d-block" style="font-size: 0.9rem;"><?= esc($item['title']) ?></span>
                                    <span class="text-muted small font-monospace">/<?= esc($item['slug']) ?></span>
                                </td>
                                <td>
                                    <span class="text-secondary small d-inline-block text-truncate" style="max-width: 280px;">
                                        <?= esc($item['excerpt'] ?: 'No descriptive text summary provided.') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark small fw-medium">
                                        <i class="far fa-calendar-alt me-1.5 opacity-75"></i> 
                                        <?= $item['published_at'] ? date('M d, Y', strtotime($item['published_at'])) : 'Unscheduled' ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($item['status'] === 'draft'): ?>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-bold bg-warning text-warning bg-opacity-10 border border-warning border-opacity-25 text-capitalize">Draft</span>
                                    <?php elseif ($item['status'] === 'published'): ?>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-bold bg-success text-success bg-opacity-10 border border-success border-opacity-25 text-capitalize">Published</span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill px-2.5 py-1.5 fw-bold bg-secondary text-secondary bg-opacity-10 border border-secondary border-opacity-25 text-capitalize">Archived</span>
                                    <?php endif; ?>
                                </td>
                                <td style="padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light border text-dark px-2.5 py-1.5 shadow-xs fw-semibold btn-view-news" style="font-size: 0.8rem;">
                                            <i class="fas fa-eye text-secondary me-1"></i> View & Manage
                                        </button>
                                        <form method="POST" action="<?= base_url('admin/news/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Permanently drop news entry: <?= esc($item['title'], 'js') ?>?');" class="m-0">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 shadow-xs">
                                                <i class="fas fa-trash-alt"></i>
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
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-white"><i class="fas fa-file-invoice text-info me-2"></i>Draft News Publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('admin/news/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Article Headline Title</label>
                            <input type="text" name="title" id="create_title" class="form-control" required placeholder="e.g., Annual Regional Development Summit 2026">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">URL Slug Identifier</label>
                            <input type="text" name="slug" id="create_slug" class="form-control" required placeholder="annual-regional-development-summit-2026">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Workflow Lifecycle Status</label>
                            <select name="status" class="form-select status-select" required>
                                <option value="draft" selected>Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Publish Release Date Time</label>
                            <input type="datetime-local" name="published_at" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Featured Image URL Asset</label>
                            <input type="text" name="featured_image" class="form-control" placeholder="image/news/summit.jpg">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Short Excerpt / Ledger Summary Teaser</label>
                            <input type="text" name="excerpt" class="form-control" placeholder="A brief hook sentence displayed on post indexes...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Full Communication Copy / Body Markdown Content</label>
                            <textarea name="content" class="form-control" rows="8" required placeholder="Type the complete comprehensive public news article details here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4 fw-bold shadow-sm" style="background-color: var(--gov-navy-primary); border-color: var(--gov-navy-primary);">Save News Asset</button>
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
                
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title fw-bold text-white me-4" id="modalTitleText">News Publication Entry</h5>
                        <div class="form-check form-switch m-0 pt-1">
                            <input class="form-check-input btn-check-toggle-edit cursor-pointer" type="checkbox" id="enableEditToggle" style="background-color: var(--gov-gold); border-color: var(--gov-gold);">
                            <label class="form-check-label small fw-bold text-white cursor-pointer opacity-90" for="enableEditToggle">
                                <i class="fas fa-edit me-1"></i>Edit Mode
                            </label>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Article Headline Title</label>
                            <div class="static-text-field form-control-plaintext fs-5 fw-bold text-dark" id="view_title"></div>
                            <div class="editable-field">
                                <input type="text" name="title" id="edit_title" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">URL Slug Reference</label>
                            <div class="static-text-field form-control-plaintext text-muted font-monospace fw-semibold" id="view_slug"></div>
                            <div class="editable-field">
                                <input type="text" name="slug" id="edit_slug" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Lifecycle Status</label>
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
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Publication Timestamp</label>
                            <div class="static-text-field form-control-plaintext text-dark fw-medium" id="view_published_at"></div>
                            <div class="editable-field">
                                <input type="datetime-local" name="published_at" id="edit_published_at" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Featured Asset Path</label>
                            <div class="static-text-field form-control-plaintext text-truncate text-muted small" id="view_featured_image"></div>
                            <div class="editable-field">
                                <input type="text" name="featured_image" id="edit_featured_image" class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Short Excerpt Summary Teaser</label>
                            <div class="static-text-field form-control-plaintext text-secondary italic" style="font-style: italic;" id="view_excerpt"></div>
                            <div class="editable-field">
                                <input type="text" name="excerpt" id="edit_excerpt" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label fw-bold small text-secondary text-uppercase mb-1 tracking-wider">Full Article Copy Body</label>
                            <div class="static-text-field p-3 bg-white rounded border small text-dark" style="white-space: pre-wrap; min-height: 120px; border-color: var(--excel-border) !important;" id="view_content"></div>
                            <div class="editable-field">
                                <textarea name="content" id="edit_content" class="form-control" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-view py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" data-bs-dismiss="modal">Close Ledger View</button>
                </div>

                <div class="modal-footer bg-light border-top modal-footer-edit py-3 px-4">
                    <button type="button" class="btn btn-light border px-4 fw-bold text-secondary" id="btnCancelEdit">Cancel Changes</button>
                    <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm"><i class="fas fa-save me-2"></i>Update Entry Spec</button>
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