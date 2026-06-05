<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Certification of Documents">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Legal</span>
            <span class="separator">//</span>
            <span>Certification</span>
        </div>
        <h1 class="internal-hero-title">Certifications</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="glass-card-modern text-center">
                    <div class="mb-5">
                         <i class="fas fa-stamp text-danger" style="font-size: 5rem; opacity: 0.3;"></i>
                    </div>
                    <h2 class="text-white fw-bold mb-4">Official Document Certification</h2>
                    <p class="text-white-50 mb-5 fs-5">
                        Ensure your legal documents and academic certificates are officially verified by the Council Secretariat. 
                        <strong>Please bring your original documents for physical verification.</strong>
                    </p>

                    <div class="row justify-content-center">
                         <div class="col-md-6 border-end border-secondary">
                              <h3 class="text-white fw-bold mb-0">MK 10,800</h3>
                              <p class="text-white-50 small text-uppercase ls-1">Fee Per Certificate</p>
                         </div>
                         <div class="col-md-6 ps-md-4">
                              <p class="small text-white-50 mb-0">Fees are payable at the Council Finance Department before processing.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>
