<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Notice Board Section -->
<section class="bg-light py-5 overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Main Professional Card -->
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white rounded-lg">
                    
                    <!-- Official Notice Badge / Header -->
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom text-dark">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="fas fa-university fa-lg"></i>
                        </div>
                        <div>
                            <span class="text-uppercase tracking-wider small text-muted font-weight-bold d-block">Official Notice</span>
                            <h2 class="h4 mb-0 font-weight-bold">Service Delegation Update</h2>
                        </div>
                    </div>

                    <!-- Informational Notice Box -->
                    <div class="alert alert-info border-0 p-4 mb-4" style="background-color: #f0f7ff; border-left: 4px solid #0284c7 !important;">
                        <div class="d-flex">
                            <i class="fas fa-info-circle text-info mt-1 me-3" style="font-size: 20px;"></i>
                            <div>
                                <h5 class="alert-heading text-dark font-weight-bold mb-2">Service Relocation</h5>
                                <p class="text-secondary mb-0" style="font-size: 16px; line-height: 1.6;">
                                    Please be advised that Birth and Death Certificate registration and processing services are now officially handled by the <strong>National Registration Bureau (NRB)</strong>. 
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Instructive Content -->
                    <div class="my-4 text-secondary">
                        <p class="mb-3">
                            To apply for a new birth certificate, request replacements, or check the status of an ongoing application, please contact or visit your nearest NRB branch directly.
                        </p>
                        <p class="text-muted small">
                            <i class="fas fa-exclamation-triangle me-1 text-warning"></i> 
                            <strong>Important Note:</strong> This local council platform no longer accepts or processes applications for birth and death registry services. 
                            All related inquiries and applications must be directed to the NRB for efficient service and processing.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center pt-3 border-top mt-4 gap-3">
                        <a href="<?= base_url('/'); ?>" class="btn btn-outline-secondary order-2 order-sm-1">
                            <i class="fas fa-arrow-left me-2"></i> Return to Homepage
                        </a>
                        
                        <!-- Optional External Link to the NRB (Highly recommended for UX if they have a site) -->
                        <a href="https://www.nrb.gov.mw" target="_blank" class="btn btn-primary order-1 order-sm-2 shadow-sm px-4 py-2">
                            Visit NRB Portal <i class="fas fa-external-link-alt ms-2" style="font-size: 12px;"></i>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection()?>