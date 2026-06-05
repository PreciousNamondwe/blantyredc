<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Birth Certificate">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Services</span>
            <span class="separator">//</span>
            <span>Death Certificate</span>
        </div>
        <h1 class="internal-hero-title">Death Certificate</h1>
    </div>
</section>

<!-- Notice Board Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="glass-card-modern text-center" style="padding: 60px 30px;">
                    
                    <i class="fas fa-info-circle" style="font-size: 60px; color: #38bdf8; margin-bottom: 20px;"></i>

                    <h2 class="text-white mb-3">Service Notice</h2>

                    <p class="text-white-50 mb-4" style="font-size: 18px;">
                        Death Certificate registration services are currently handled by the 
                        <strong>National Registration Bureau (NRB)</strong>.
                    </p>

                    <p class="text-white-50 mb-4">
                        To apply for a death certificate, please visit your nearest NRB office or contact them directly for assistance.
                    </p>

                    <div class="glass-card-modern mt-4" style="background: rgba(56, 189, 248, 0.05); border-color: #38bdf8;">
                        <h5 class="text-white mb-2">Important Information</h5>
                        <p class="text-white-50 small mb-0">
                            This platform no longer processes death certificate applications.
                        </p>
                    </div>

                    <a href="<?= base_url('/'); ?>" class="btn-form-primary mt-4">
                        <i class="fas fa-home"></i> Return Home
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>