<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Legal Change of Name">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Legal</span>
            <span class="separator">//</span>
            <span>Name Change</span>
        </div>
        <h1 class="internal-hero-title">Change of Name</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="glass-card-modern">
                    <h4 class="text-white mb-4 fw-bold">Statutory Requirements</h4>
                    <p class="text-white-50 mb-4">
                        To formally change your name across government records, the following statutory steps must be completed through the District Commissioner's office:
                    </p>

                    <div class="row g-4 mt-2">
                         <div class="col-md-6">
                              <div class="p-4 rounded-4 border border-secondary bg-dark h-100">
                                   <i class="fas fa-newspaper text-danger fs-3 mb-3"></i>
                                   <h6 class="text-white">Newspaper Notice</h6>
                                   <p class="small text-white-50 mb-0">Provide evidence of a published newspaper notice citing your legal intention to change your name.</p>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="p-4 rounded-4 border border-secondary bg-dark h-100">
                                   <i class="fas fa-id-card text-danger fs-3 mb-3"></i>
                                   <h6 class="text-white">Identity Verification</h6>
                                   <p class="small text-white-50 mb-0">Present yourself at our offices with a valid copy of your National Identification Card.</p>
                              </div>
                         </div>
                    </div>

                    <div class="mt-5 pt-4 border-top border-secondary border-opacity-25 text-center">
                         <h3 class="text-white fw-bold mb-0">MK 22,000</h3>
                         <p class="text-white-50 small text-uppercase ls-1">Standard Processing Fee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>
