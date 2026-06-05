<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero (Synced with Core Portal Guidelines) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Deceased Estates Application</h1>
    </div>
</section>

<!-- Main Informational Framework Section (Soft Bluish-Slate Civic Layer) -->
<section class="w-100 py-3" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Pure White Informational Content Box -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3">
                    
                    <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Required Documentation</h4>
                    
                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        The Council provides comprehensive estate administration services to ensure fair, transparent, and legally sound asset resolution. 
                        While there are currently <strong class="text-dark">no service fees</strong> assessed for this structural administrative support, citizens are strictly required to furnish the following mandatory verification documentation to begin processing:
                    </p>

                    <!-- Document Requirements Matrix Grid -->
                    <div class="row g-4 mt-2">
                        
                        <!-- Document 1: Death Report -->
                        <div class="col-md-4">
                            <div class="p-4 rounded-3 h-100 border border-light-dark transition-hover" style="background-color: #f8fafc;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 48px; height: 48px; background-color: #e2e8f0;">
                                    <i class="fas fa-file-medical text-secondary fs-5"></i>
                                </div>
                                <h6 class="text-dark fw-bold mb-2">Death Report</h6>
                                <p class="small text-muted mb-0" style="line-height: 1.5;">Official medical or institutional report verifying the passing of the individual.</p>
                            </div>
                        </div>
                        
                        <!-- Document 2: National ID -->
                        <div class="col-md-4">
                            <div class="p-4 rounded-3 h-100 border border-light-dark transition-hover" style="background-color: #f8fafc;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 48px; height: 48px; background-color: #e2e8f0;">
                                    <i class="fas fa-id-card text-secondary fs-5"></i>
                                </div>
                                <h6 class="text-dark fw-bold mb-2">National ID</h6>
                                <p class="small text-muted mb-0" style="line-height: 1.5;">Your valid original National Identification Card (or eligible replacement slip) for identity validation.</p>
                            </div>
                        </div>
                        
                        <!-- Document 3: Chief's Letter -->
                        <div class="col-md-4">
                            <div class="p-4 rounded-3 h-100 border border-light-dark transition-hover" style="background-color: #f8fafc;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 48px; height: 48px; background-color: #e2e8f0;">
                                    <i class="fas fa-landmark text-secondary fs-5"></i>
                                </div>
                                <h6 class="text-dark fw-bold mb-2">Chief's Letter</h6>
                                <p class="small text-muted mb-0" style="line-height: 1.5;">An authenticated introductory confirmation letter directly issued by the recognized Traditional Chief of the locality.</p>
                            </div>
                        </div>

                    </div>

                    <!-- Fee Status Footer Callout Banner -->
                    <div class="mt-5 p-3 rounded-3 d-flex align-items-center border border-info border-opacity-10" style="background-color: #e0f2fe; color: #0369a1;">
                        <i class="fas fa-info-circle me-3 fs-5"></i>
                        <span class="small fw-semibold">Note: Administrative processing remains subsidized at zero cost to the citizen at all regional Council filing centers.</span>
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

/* Subtle elevation movement for clean card interactions */
.transition-hover {
    transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.2s ease;
}
.transition-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    border-color: #cbd5e1 !important;
}
</style>

<?= $this->endSection()?>