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
</style>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <div>
        <h2 class="fw-bold text-slate-800 mb-1">Management Members</h2>
        <p class="text-muted small mb-0">Manage executive leadership profiles shown on the public management page.</p>
    </div>
    <div>
        <a href="<?= base_url('admin/management/create') ?>" class="btn btn-primary px-3 shadow-sm">
            <i class="fas fa-plus me-2"></i>Add Member
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm mb-4"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger border-0 shadow-sm mb-4"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>

<div class="filter-toolbar p-3 mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-6 col-lg-4">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" class="form-control" placeholder="Search by name, position or email...">
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <select id="statusFilter" class="form-select status-select">
                <option value="all">All Statuses</option>
                <option value="yes">Active Members</option>
                <option value="no">Inactive Members</option>
            </select>
        </div>
        <div class="col text-md-end text-muted small" id="filterCount">
            </div>
    </div>
</div>

<div class="card dashboard-card mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="managementTable">
                <thead>
                    <tr>
                        <th style="width: 80px; padding-left: 1.5rem;">Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Active</th>
                        <th class="text-end" style="padding-right: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($members)): ?>
                        <tr id="noDataRow">
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-users d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No management members found yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($members as $member): ?>
                            <tr class="member-row" 
                                data-search="<?= strtolower(esc($member['name'] . ' ' . $member['position'] . ' ' . $member['email'])) ?>"
                                data-active="<?= $member['is_active'] ? 'yes' : 'no' ?>">
                                <td style="padding-left: 1.5rem;">
                                    <img src="<?= base_url($member['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="<?= esc($member['name']) ?>" class="table-avatar">
                                </td>
                                <td><span class="fw-semibold text-dark"><?= esc($member['name']) ?></span></td>
                                <td><span class="text-secondary"><?= esc($member['position']) ?></span></td>
                                <td><a href="mailto:<?= esc($member['email']) ?>"><?= esc($member['email']) ?></a></td>
                                <td><span class="text-slate-600"><?= esc($member['phone']) ?></span></td>
                                <td>
                                    <?= $member['is_active'] ? '<span class="badge bg-success bg-opacity-10 text-success">Yes</span>' : '<span class="badge bg-secondary bg-opacity-10 text-secondary">No</span>' ?>
                                </td>
                                <td style="padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="<?= base_url('admin/management/' . $member['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary px-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form method="POST" action="<?= base_url('admin/management/' . $member['id'] . '/delete') ?>" onsubmit="return confirm('Delete <?= esc($member['name'], 'js') ?>? This will remove the member from the public management page.');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-2">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <tr id="noResultsRow" style="display: none;">
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-search d-block mb-2 fa-2x text-black-50 opacity-25"></i>
                                No matching records found matching your selection criteria.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Self-invoking function block or isolated wrapper to make sure it functions properly within layout frames
    (function() {
        function initTableFilters() {
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const tableRows = document.querySelectorAll('.member-row');
            const noResultsRow = document.getElementById('noResultsRow');
            const filterCountOutput = document.getElementById('filterCount');

            if (!searchInput || !statusFilter) return;

            function filterTable() {
                const queryValue = searchInput.value.toLowerCase().trim();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const searchableText = row.getAttribute('data-search');
                    const activeStatus = row.getAttribute('data-active');

                    const matchesSearch = searchableText.includes(queryValue);
                    const matchesStatus = (statusValue === 'all') || (activeStatus === statusValue);

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (tableRows.length > 0) {
                    filterCountOutput.textContent = `Showing ${visibleCount} of ${tableRows.length} members`;
                    
                    if (visibleCount === 0) {
                        noResultsRow.style.display = '';
                    } else {
                        noResultsRow.style.display = 'none';
                    }
                }
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            
            // Execute default counts instantly upon inclusion
            filterTable();
        }

        // Run checking parameters whether DOM content loaded cycle context active
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTableFilters);
        } else {
            initTableFilters();
        }
    })();
</script>