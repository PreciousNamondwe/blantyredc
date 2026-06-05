<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>

<!-- Internal Hero -->
<section class="internal-hero">
    <img src="<?= base_url('image/new_hero.jpg'); ?>" class="internal-hero-bg" alt="Affidavits & Declarations">
    <div class="internal-hero-content">
        <div class="modern-breadcrumb mb-3">
            <a href="<?= base_url('/'); ?>">Overview</a>
            <span class="separator">//</span>
            <span>Legal</span>
            <span class="separator">//</span>
            <span>Affidavits</span>
        </div>
        <h1 class="internal-hero-title">Affidavits</h1>
    </div>
</section>

<!-- Main Content Section -->
<section class="bg-slate-dark overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Affidavit Types -->
                <div class="row g-4">
                    
                    <!-- Marriage -->
                    <div class="col-12">
                         <div class="glass-card-modern" style="margin-top: 0">
                              <div class="row align-items-center">
                                   <div class="col-md-8">
                                        <h4 class="text-white fw-bold mb-3"><i class="fas fa-ring text-danger me-2"></i> Single Status Affidavit</h4>
                                        <p class="text-white-50 small">Necessary for Malawian citizens marrying in a foreign country to confirm they have no existing marriage records in Malawi.</p>
                                        <div class="mt-4">
                                             <span class="badge bg-danger bg-opacity-10 text-danger p-2 x-small ls-1 me-2">Chief's Letter Required</span>
                                             <span class="badge bg-danger bg-opacity-10 text-danger p-2 x-small ls-1">National ID Required</span>
                                        </div>
                                   </div>
                                   <div class="col-md-4 border-start border-secondary border-opacity-25 ps-md-4 text-center">
                                        <h3 class="text-white fw-bold mb-0">MK 22,000</h3>
                                        <p class="text-white-50 x-small text-uppercase ls-1">Processing Fee</p>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- Death Abroad -->
                    <div class="col-12">
                         <div class="glass-card-modern" style="margin-top: 0; background: rgba(255,255,255,0.02);">
                              <div class="row align-items-center">
                                   <div class="col-md-8">
                                        <h4 class="text-white fw-bold mb-3"><i class="fas fa-globe-africa text-danger me-2"></i> Death Abroad Declaration</h4>
                                        <p class="text-white-50 small">Official declaration required when a citizen passes away outside the country.</p>
                                        <ul class="text-white-50 x-small mt-3">
                                             <li>• Death Report & Passport Required</li>
                                             <li>• Chief's Letter & National ID Required</li>
                                        </ul>
                                   </div>
                                   <div class="col-md-4 border-start border-secondary border-opacity-25 ps-md-4 text-center">
                                        <h3 class="text-white fw-bold mb-0">MK 22,000</h3>
                                        <p class="text-white-50 x-small text-uppercase ls-1">Processing Fee</p>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- Name -->
                    <div class="col-12">
                         <div class="glass-card-modern" style="margin-top: 0; background: rgba(255,255,255,0.02);">
                              <div class="row align-items-center">
                                   <div class="col-md-8">
                                        <h4 class="text-white fw-bold mb-3"><i class="fas fa-signature text-danger me-2"></i> Affidavit of Name</h4>
                                        <p class="text-white-50 small">Necessary for legal name corrections or alignment with official documentation.</p>
                                   </div>
                                   <div class="col-md-4 border-start border-secondary border-opacity-25 ps-md-4 text-center">
                                        <h3 class="text-white fw-bold mb-0">MK 10,000</h3>
                                        <p class="text-white-50 x-small text-uppercase ls-1">Processing Fee</p>
                                   </div>
                              </div>
                         </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>
