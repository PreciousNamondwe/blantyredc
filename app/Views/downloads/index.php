<?php
/**
 * Downloads Page
 */

$documents = require APPPATH . 'Config/downloads.php';

$totalDocuments = count($documents);
$categories = array_unique(array_column($documents, 'category_display'));
$categoryCount = count($categories);

echo $this->extend('templates/layout.php');
echo $this->section('content');
?>

<section class="downloads-page py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h1 class="fw-bold">Resource Center</h1>
            <p class="text-muted">
                Browse, preview and download council documents and publications.
            </p>
        </div>

        <!-- Stats -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body">
                        <h3 class="fw-bold text-primary mb-1">
                            <?= $totalDocuments ?>
                        </h3>
                        <small class="text-muted">Documents</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body">
                        <h3 class="fw-bold text-primary mb-1">
                            <?= $categoryCount ?>
                        </h3>
                        <small class="text-muted">Categories</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="downloads-toolbar mb-4">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fas fa-search"></i>
                </span>
                <input
                    type="text"
                    id="downloadsSearch"
                    class="form-control"
                    placeholder="Search by title, category or format...">
            </div>
        </div>

        <!-- Documents -->
        <div id="downloadsList" class="card border-0 shadow-sm">
            <div class="list-group list-group-flush">

                <?php foreach ($documents as $doc): ?>
                    <div
                        class="list-group-item d-flex flex-column flex-md-row align-items-md-center gap-3 p-3 document-item"
                        data-category="<?= esc($doc['category']) ?>">

                        <div class="text-primary fs-3">
                            <i class="fas <?= esc($doc['icon']) ?>"></i>
                        </div>

                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold document-title">
                                <?= esc($doc['title']) ?>
                            </h6>

                            <?php if (!empty($doc['description'])): ?>
                                <p class="mb-1 text-muted small document-description">
                                    <?= esc($doc['description']) ?>
                                </p>
                            <?php endif; ?>

                            <small class="text-muted document-meta">
                                <?= esc($doc['category_display']) ?>
                                • <?= esc($doc['format']) ?>

                                <?php if (!empty($doc['year'])): ?>
                                    • <?= esc($doc['year']) ?>
                                <?php endif; ?>

                                <?php if (!empty($doc['size'])): ?>
                                    • <?= esc($doc['size']) ?>
                                <?php endif; ?>
                            </small>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">

                            <button
                                type="button"
                                class="btn btn-outline-primary btn-sm"
                                onclick="previewDocument(
                                    '<?= esc($doc['url']) ?>',
                                    '<?= esc($doc['title']) ?>'
                                )">
                                <i class="fas fa-eye"></i>
                                Preview
                            </button>

                            <a
                                href="<?= esc($doc['url']) ?>"
                                class="btn btn-primary btn-sm"
                                download>
                                <i class="fas fa-download"></i>
                                Download
                            </a>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- No Results -->
        <div id="noResults" class="text-center py-5" style="display:none;">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4>No documents found</h4>
            <p class="text-muted">
                Try adjusting your search terms.
            </p>
        </div>

    </div>
</section>

<!-- Preview Modal -->
<div
    class="modal fade"
    id="documentPreviewModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle">
                    Document Preview
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>

            <div class="modal-body p-0">
                <iframe
                    id="previewFrame"
                    src=""
                    style="width:100%; height:75vh; border:none;">
                </iframe>
            </div>

            <div class="modal-footer">
                <a
                    id="previewDownloadLink"
                    href="#"
                    target="_blank"
                    class="btn btn-primary">

                    <i class="fas fa-download"></i>
                    Download Document
                </a>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const searchInput = document.getElementById('downloadsSearch');
    const items = document.querySelectorAll('.document-item');
    const downloadsList = document.getElementById('downloadsList');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {

        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(item => {

            const title = item.querySelector('.document-title')
                ?.textContent.toLowerCase() || '';

            const description = item.querySelector('.document-description')
                ?.textContent.toLowerCase() || '';

            const meta = item.querySelector('.document-meta')
                ?.textContent.toLowerCase() || '';

            const matches =
                title.includes(searchTerm) ||
                description.includes(searchTerm) ||
                meta.includes(searchTerm);

            if (matches) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            downloadsList.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            downloadsList.style.display = 'block';
            noResults.style.display = 'none';
        }
    });

});

/**
 * Preview document in modal
 */
function previewDocument(url, title) {

    document.getElementById('previewTitle').textContent = title;
    document.getElementById('previewFrame').src = url;
    document.getElementById('previewDownloadLink').href = url;

    const modal = new bootstrap.Modal(
        document.getElementById('documentPreviewModal')
    );

    modal.show();
}

/**
 * Clear iframe when modal closes
 */
document.getElementById('documentPreviewModal')
    .addEventListener('hidden.bs.modal', function() {
        document.getElementById('previewFrame').src = '';
    });
</script>

<?= $this->endSection() ?>