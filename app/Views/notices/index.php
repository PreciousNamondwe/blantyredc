<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Public Annoucement</h1>
    </div>
</section>

<!-- 2. Main Content Wrapper (Uses your premium soft bluish-slate #f0f4f8 styling layout) -->
<section class="w-100 position-relative" style="background-color: #f0f4f8; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                
                <?php if (!empty($notices)): ?>
                    <?php foreach ($notices as $notice): ?>
                        <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3 mb-4">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4 pb-2 border-bottom border-light">
                                <div class="d-flex align-items-center">
                                    <?php if (in_array($notice['urgency_level'], ['urgent','high'])): ?>
                                        <span class="badge bg-danger text-white text-uppercase px-3 py-1 rounded-pill small fw-bold me-3"><?= esc(ucfirst($notice['urgency_level'])) ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary text-white text-uppercase px-3 py-1 rounded-pill small fw-bold me-3"><?= esc(ucfirst($notice['urgency_level'])) ?></span>
                                    <?php endif; ?>

                                    <span class="text-secondary small d-flex align-items-center">
                                        <i class="far fa-calendar-alt me-1.5"></i>
                                        <?= $notice['published_at'] ? date('M d, Y', strtotime($notice['published_at'])) : 'Not published' ?>
                                    </span>
                                </div>

                                <div class="text-secondary small">
                                    <span class="badge bg-light text-secondary rounded-pill px-2.5 py-1"><?= esc($notice['category'] ?? 'General') ?></span>
                                </div>
                            </div>

                            <h2 class="h3 text-dark fw-bold mb-4"><a href="<?= base_url('tenders/' . ($notice['slug'] ?? $notice['id'])) ?>" class="text-decoration-none text-dark"><?= esc($notice['title']) ?></a></h2>

                            <p class="text-secondary fs-5 mb-4" style="line-height: 1.7;">
                                <?= esc(strlen(strip_tags($notice['content'])) > 300 ? substr(strip_tags($notice['content']), 0, 300) . '...' : strip_tags($notice['content'])) ?>
                            </p>

                            <?php if (!empty($notice['urgency_level']) && in_array($notice['urgency_level'], ['urgent','high'])): ?>
                                <div class="p-4 rounded-3 border <?= $notice['urgency_level'] === 'urgent' ? 'border-danger' : 'border-warning' ?> bg-opacity-10" style="background-color: rgba(253, 81, 81, 0.06);">
                                    <h6 class="text-danger fw-bold mb-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Attention
                                    </h6>
                                    <p class="small text-secondary mb-0" style="line-height: 1.6;">
                                        <?= esc(substr(strip_tags($notice['content']), 0, 300)) ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4 pt-2 d-flex gap-3 flex-wrap">
                                <a href="<?= base_url('tenders/' . ($notice['slug'] ?? $notice['id'])) ?>" class="btn btn-sm btn-dark rounded-pill px-4 py-2 fw-semibold">
                                    <i class="fas fa-info-circle me-1.5"></i> Read More
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Pagination if available -->
                    <?php if (!empty($pager)): ?>
                        <div class="d-flex justify-content-center mt-4">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center mt-5 py-4 opacity-50">
                        <div class="mb-2">
                            <i class="fas fa-bullhorn text-secondary fs-3"></i>
                        </div>
                        <p class="text-secondary small mb-0 fw-medium">No active tenders at the moment</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>
