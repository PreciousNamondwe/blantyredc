<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"><!-- Internal Hero (Synced with Core Portal Guidelines) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Firearm Licence Application</h1>
    </div>
</section>

<!-- Main Informational Framework Section (Soft Bluish-Slate Civic Layer) -->
<section class="w-100 py-3" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <!-- Pure White Informational Content Box -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3">
                    
                    <!-- Decorative Structural Identity Block -->
                    <div class="text-center mb-5 mt-2">
                         <img src="<?= base_url('image/guns.png'); ?>" style="height: 90px; width: auto; filter: grayscale(1) opacity(0.35);" alt="Licensing Authority Icon">
                    </div>

                    <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Application & Registration Process</h4>
                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        Citizens seeking to acquire or transfer a firearm must strictly adhere to the Council's security protocols, civic background vetting, and standard verification guidelines.
                    </p>

                    <!-- Mandatory Legal Advisory Callout Module -->
                    <div class="p-4 rounded-3 border-start border-4 mb-5" style="background-color: #f8fafc; border-color: #dc3545 !important;">
                        <h6 class="text-dark fw-bold d-flex align-items-center mb-2">
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i> Mandatory Verification Track
                        </h6>
                        <p class="small text-muted mb-0" style="line-height: 1.6;">
                            Applicants are legally required to furnish a physically signed documentation dossier certified sequentially by the **Malawi Police Service**, a localized **Traditional Chief**, a registered **Church Minister**, and a presiding **Magistrate or Judge**. The **District Commissioner** maintains singular structural authorization and implements the release of the final valid registration sequence number.
                        </p>
                    </div>

                    <!-- Fee Matrix Evaluation Grid Row -->
                    <div class="row g-4 align-items-center bg-light m-0 p-4 rounded-3 border border-light-dark">
                         <div class="col-md-5 text-center text-md-start border-end-md">
                              <h3 class="text-dark fw-extrabold m-0" style="font-size: 2rem; letter-spacing: -0.5px;">MWK 80,000</h3>
                              <p class="text-uppercase tracking-wider fw-bold text-muted small m-0 mt-1" style="font-size: 0.72rem;">Standard Licensing Assessment Fee</p>
                         </div>
                         <div class="col-md-7 ps-md-4 text-center text-md-start">
                              <p class="small text-muted m-0" style="line-height: 1.6;">
                                  All assessed regulatory standard licensing fees must be settled exclusively through direct processing channels at the core Council Finance Department building upon systematic verification of the complete credential portfolio.
                              </p>
                         </div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</section>

<style>
/* Local Structural Optimization Rules */
.border-light-dark { border-color: #e2e8f0 !important; }
.fs-7 { font-size: 0.85rem !important; }

@media (min-width: 768px) {
    .border-end-md {
        border-end: none;
        border-right: 1px solid #cbd5e1 !important;
    }
}
</style>

<?= $this->endSection()?>