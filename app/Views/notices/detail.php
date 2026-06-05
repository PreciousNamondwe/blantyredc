<?= $this->extend('templates/layout.php') ?>

<?= $this->section('content') ?>

<section class="bg-whitish-blue-canvas">
    <div class="container py-5">
        <h1 class="text-center section-title-dark mb-0">Tender Details</h1>
    </div>
</section>

<section class="w-100 position-relative" style="background-color: #f0f4f8; min-height: 60vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <article class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4 pb-2 border-bottom border-light">
                        <div class="d-flex align-items-center">
                            <?php if (in_array($notice['urgency_level'], ['urgent', 'high'])): ?>
                                <span class="badge bg-danger text-white text-uppercase px-3 py-1 rounded-pill small fw-bold me-3"><?= esc(ucfirst($notice['urgency_level'])) ?></span>
                            <?php else: ?>
                                <span class="badge bg-secondary text-white text-uppercase px-3 py-1 rounded-pill small fw-bold me-3"><?= esc(ucfirst($notice['urgency_level'])) ?></span>
                            <?php endif; ?>

                            <span class="text-secondary small d-flex align-items-center">
                                <i class="far fa-calendar-alt me-1.5"></i>
                                <?= $notice['published_at'] ? date('M d, Y', strtotime($notice['published_at'])) : 'Not published' ?>
                            </span>
                        </div>

                        <span class="badge bg-light text-secondary rounded-pill px-2.5 py-1"><?= esc($notice['category'] ?? 'General') ?></span>
                    </div>

                    <h2 class="h3 text-dark fw-bold mb-4"><?= esc($notice['title']) ?></h2>

                    <?php if (!empty($notice['reference'])): ?>
                        <p class="text-secondary fw-semibold mb-4">
                            Reference: <?= esc($notice['reference']) ?>
                        </p>
                    <?php endif; ?>

                    <div class="text-secondary fs-5 mb-4" style="line-height: 1.7;">
                        <?= $notice['content'] ?>
                    </div>

                    <a href="<?= base_url('tenders') ?>" class="btn btn-sm btn-dark rounded-pill px-4 py-2 fw-semibold">
                        <i class="fas fa-arrow-left me-1.5"></i> Back to Tenders
                    </a>
                </article>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
