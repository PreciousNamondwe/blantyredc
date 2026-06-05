<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Commissioner of Oaths">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Legal</span>
            <span class="separator">//</span>
            <span>Commissioner</span>
        </div>
        <h1 class="internal-hero-title">Commissioner of Oaths</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-card-modern text-center">
                    <div class="mb-5">
                         <i class="fas fa-balance-scale text-danger" style="font-size: 5rem; opacity: 0.3;"></i>
                    </div>
                    <h2 class="text-white fw-bold mb-4">Oath Administration</h2>
                    <p class="text-white-50 mb-5 fs-5">
                        Access official oath-taking services for legal affidavits, declarations, and witness verifications authorized by the District Secretariat.
                    </p>

                    <div class="row justify-content-center">
                         <div class="col-12">
                              <h3 class="text-white fw-bold mb-0">MK 7,260</h3>
                              <p class="text-white-50 small text-uppercase ls-1">Standard Service Fee</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>
