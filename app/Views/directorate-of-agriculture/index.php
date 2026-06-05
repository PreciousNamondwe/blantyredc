<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero (Synced with Portal Structural Core) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Agriculture & Natural Resources</h1>
    </div>
</section>

<!-- Main Civic Content Frame -->
<section class="w-100" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                
                <!-- Card 1: Strategic Foundations -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3 mb-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Economic Foundation</h4>
                            <p class="text-muted mb-4" style="line-height: 1.6;">
                                Blantyre District relies fundamentally on agriculture for its localized economic development and long-term food security frameworks. With over 90% of the rural population deriving their direct livelihood assets from arable land management, the Directorate actively oversees integrated strategic interventions spanning Agriculture, Forestry, and Environmental conservation.
                            </p>
                            
                            <!-- Tactical Info Blocks -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-4 rounded-3 h-100 border-start border-4" style="background-color: #f8fafc; border-color: #64748b !important;">
                                        <h6 class="text-dark fw-bold text-uppercase tracking-wider small mb-2">Extension Planning Areas (EPAs)</h6>
                                        <p class="text-muted small mb-0" style="line-height: 1.5;">Chipande, Kunthembwe, Lirangwe, Lunzu, and Ntonda.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 rounded-3 h-100 border-start border-4" style="background-color: #f8fafc; border-color: #0ea5e9 !important;">
                                        <h6 class="text-dark fw-bold text-uppercase tracking-wider small mb-2">Core Strategy</h6>
                                        <p class="text-muted small mb-0" style="line-height: 1.5;">Accelerating mechanization arrays, systematic soil conservation protocols, and aggressive post-harvest loss reduction.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Visual Context Accent -->
                        <div class="col-lg-4 text-center d-none d-lg-block">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 180px; height: 180px; background-color: #f0f4f8;">
                                <i class="fas fa-seedling text-muted opacity-50" style="font-size: 4.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Operations & Extension Matrix Grid -->
                <div class="row g-4 mb-5">
                    <!-- Farming Demographics Module -->
                    <div class="col-lg-6">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <h5 class="text-dark mb-4 fw-bold pb-2 border-bottom border-light-dark text-uppercase tracking-wider small">
                                <i class="fas fa-users text-muted me-2"></i> Farming Families Baseline
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle small mb-0">
                                    <thead class="table-light text-uppercase tracking-wider text-muted" style="font-size: 0.75rem;">
                                        <tr>
                                            <th class="border-0 py-2">Extension Planning Area</th>
                                            <th class="border-0 text-end py-2">Registered Families</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted">
                                        <tr><td class="py-2.5">Chipande</td><td class="text-end fw-medium py-2.5">27,243</td></tr>
                                        <tr><td class="py-2.5">Lirangwe</td><td class="text-end fw-medium py-2.5">34,394</td></tr>
                                        <tr><td class="py-2.5">Lunzu</td><td class="text-end fw-medium py-2.5">34,248</td></tr>
                                        <tr><td class="py-2.5">Kunthembwe</td><td class="text-end fw-medium py-2.5">39,032</td></tr>
                                        <tr><td class="py-2.5">Ntonda</td><td class="text-end fw-medium py-2.5">55,178</td></tr>
                                        <tr class="table-light text-dark fw-bold">
                                            <td class="py-2.5">District Aggregate Total</td>
                                            <td class="text-end py-2.5">190,095</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Operational Delivery Constraints Module -->
                    <div class="col-lg-6">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="text-dark mb-4 fw-bold pb-2 border-bottom border-light-dark text-uppercase tracking-wider small">
                                    <i class="fas fa-chart-line text-muted me-2"></i> Extension Delivery Parameters
                                </h5>
                                <div class="p-4 rounded-3 mb-4 text-center border" style="background-color: #fff5f5; border-color: #fee2e2 !important;">
                                    <h2 class="fw-extrabold m-0 tracking-tight text-danger" style="font-size: 2.5rem;">1 : 3,116</h2>
                                    <span class="small text-uppercase fw-bold tracking-wider text-danger" style="font-size: 0.75rem;">Current Staff-to-Farmer Ratio</span>
                                </div>
                            </div>
                            <div>
                                <p class="small text-muted text-center m-0" style="line-height: 1.6;">
                                    While the standard target recommended operation ratio remains <strong>1:750</strong>, the Directorate is deploying systematic structural balancing measures and localized mobilization frameworks to optimize extension accessibility lines across all 5 key planning sectors.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Production Portfolios -->
                <div class="card bg-white border-0 shadow-sm p-4 p-md-5 rounded-3">
                    <h4 class="text-dark fw-bold mb-4 tracking-tight" style="font-size: 1.5rem;">Market & Production Sectors</h4>
                    <div class="row g-4 text-muted small" style="line-height: 1.6;">
                        <div class="col-md-4 border-end-md">
                            <h6 class="text-dark fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.85rem;"><i class="fas fa-wheat-awn text-primary me-2"></i> Key Crops Matrix</h6>
                            <p class="mb-0 text-muted">Maize (Staple food security baseline), Cotton, Pigeon Peas, Tobacco, Cassava, and Sweet Potatoes.</p>
                        </div>
                        <div class="col-md-4 border-end-md">
                            <h6 class="text-dark fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.85rem;"><i class="fas fa-store text-primary me-2"></i> Strategic Trade Outlets</h6>
                            <p class="mb-0 text-muted">Chadzunda, Mdeka, Chikuli, Chileka, Chilobwe, Lirangwe, and Lunzu central marketplaces.</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-dark fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.85rem;"><i class="fas fa-fish text-primary me-2"></i> Aquaculture & Fisheries</h6>
                            <p class="mb-0 text-muted">Systematically promoting sustainable smallholder fish farming networks and community-managed production ponds across inland water systems.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
/* Micro-Layout Framework Fixes */
.border-light-dark { border-color: #f1f5f9 !important; }
.fs-7 { font-size: 0.85rem !important; }
.py-2\.5 { padding-top: 0.65rem !important; padding-bottom: 0.65rem !important; }

@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #e2e8f0 !important;
        padding-right: 1.5rem !important;
    }
}
</style>

<?= $this->endSection()?>