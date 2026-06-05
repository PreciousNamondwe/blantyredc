<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>

<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Will Deposit Services">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Legal</span>
            <span class="separator">//</span>
            <span>Will Deposit</span>
        </div>
        <h1 class="internal-hero-title">Will Deposit</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="glass-card-modern">
                    <h4 class="text-white mb-4 fw-bold">Secure Testamentary Storage</h4>
                    <p class="text-white-50 mb-4">
                        The Council provides a secure environment for the deposit of last wills and testaments, ensuring your final wishes are protected and legally recognized.
                    </p>

                    <div class="row g-4 mt-2">
                         <div class="col-md-6 border-end border-secondary border-opacity-25 pe-md-4">
                              <h6 class="text-white fw-bold mb-3"><i class="fas fa-file-signature text-danger me-2"></i> Requirements</h6>
                              <ul class="text-white-50 small list-unstyled">
                                   <li class="mb-2">• Valid National Identification Card</li>
                                   <li class="mb-2">• Duly Signed & Sealed Will</li>
                                   <li class="mb-2">• Official Will Deposit Form</li>
                              </ul>
                              <a href="#" class="btn btn-outline-danger btn-sm mt-3 border-secondary text-white-50"><i class="fas fa-download me-2"></i> Download Form</a>
                         </div>
                         <div class="col-md-6 ps-md-4 text-center d-flex flex-column justify-content-center">
                              <h3 class="text-white fw-bold mb-0">MK 22,000</h3>
                              <p class="text-white-50 small text-uppercase ls-1">Safe-keeping Fee</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>
