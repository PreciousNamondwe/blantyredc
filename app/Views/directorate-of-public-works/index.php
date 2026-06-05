<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero (Aligned with Portal Brand Guidelines) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Public Works & Infrastructure</h1>
    </div>
</section>

<!-- Main Civic Content Frame -->
<section class="w-100" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                
                <!-- Card 1: Sector Core Overview -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3 mb-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Infrastructure Excellence</h4>
                            <p class="text-muted mb-4" style="line-height: 1.6;">
                                The Directorate of Public Works manages the district's physical assets and civil engineering infrastructure projects. From public healthcare facilities and primary education centers to the vast rural feeder road networks, we ensure safe connectivity, structural integrity, and long-term asset stability.
                            </p>
                            
                            <!-- Highlighted Context Box -->
                            <div class="p-3 rounded-3 border" style="background-color: #f0f7ff; border-color: #e0f2fe !important;">
                                <h6 class="text-primary small text-uppercase tracking-wider fw-bold mb-1" style="font-size: 0.75rem;">Strategic Regional Logistics</h6>
                                <p class="text-muted small mb-0" style="line-height: 1.5;">
                                    Blantyre serves as a critical macro-communications node, maintaining integrated multi-modal road, rail, and transit corridors connecting to Mozambique, Zimbabwe, South Africa, and international trade lines.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Structural Action Icon -->
                        <div class="col-lg-4 text-center d-none d-lg-block">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 180px; height: 180px; background-color: #f0f4f8;">
                                <i class="fas fa-hard-hat text-muted opacity-50" style="font-size: 4.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Road Network Grid & Technical Metrics -->
                <div class="row g-4 mb-5">
                    <!-- Giant Metrics Display Block -->
                    <div class="col-lg-4">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3 text-center d-flex flex-column justify-content-center">
                            <h1 class="text-danger fw-extrabold mb-1" style="font-size: 3.5rem; tracking-tight: -0.05em;">1,665</h1>
                            <span class="text-muted small text-uppercase tracking-wider fw-bold" style="font-size: 0.75rem;">Total KM Road Network</span>
                        </div>
                    </div>
                    
                    <!-- Structural Classification Table/List Breakdown -->
                    <div class="col-lg-8">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <h5 class="text-dark mb-4 fw-bold pb-2 border-bottom border-light-dark text-uppercase tracking-wider small">
                                <i class="fas fa-road text-muted me-2"></i> Road Classification Breakdown
                            </h5>
                            <div class="row g-3 text-muted">
                                <div class="col-md-6 border-end-md">
                                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                        <li class="d-flex justify-content-between align-items-center pr-md-3">
                                            <span class="fw-semibold text-dark">Main Arterial Roads:</span>
                                            <span class="badge bg-light text-dark border font-weight-medium">138 KM</span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center pr-md-3">
                                            <span class="fw-semibold text-dark">Secondary Routes:</span>
                                            <span class="badge bg-light text-dark border font-weight-medium">111 KM</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6 ps-md-4">
                                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span class="fw-semibold text-dark">Tertiary Routes:</span>
                                            <span class="badge bg-light text-dark border font-weight-medium">44 KM</span>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span class="fw-semibold text-dark">District Feeder Roads:</span>
                                            <span class="badge bg-light text-dark border font-weight-medium">1,298 KM</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Asset Logistics & Spatial Mapping -->
                <div class="card bg-white border-0 shadow-sm p-4 p-md-5 rounded-3">
                    <div class="row g-4 align-items-center">
                        <!-- Route Inventories -->
                        <div class="col-lg-6">
                            <h4 class="text-dark fw-bold mb-4 tracking-tight" style="font-size: 1.5rem;">Strategic Infrastructure Assets</h4>
                            <div class="mb-4">
                                <h6 class="text-danger small text-uppercase tracking-wider fw-bold mb-1" style="font-size: 0.75rem;">Primary Civil Corridors</h6>
                                <p class="text-muted small mb-0" style="line-height: 1.5;">M1 Network Backbone (Zalewa - Madziabango corridor), M4 Arterial (Bangwe - Malowa highway axis), and M8 System (Limbe - Chigumula line).</p>
                            </div>
                            <div>
                                <h6 class="text-danger small text-uppercase tracking-wider fw-bold mb-1" style="font-size: 0.75rem;">Social & Administrative Physical Plants</h6>
                                <p class="text-muted small mb-0" style="line-height: 1.5;">Structural oversight and lifecycle management of institutional housing schemes, urban/rural marketplace facilities, and peripheral public clinical structures.</p>
                            </div>
                        </div>
                        
                        <!-- Spatial Request Trigger Box -->
                        <div class="col-lg-6 ps-lg-5">
                            <div class="p-4 rounded-3 border text-center" style="background-color: #f8fafc;">
                                <i class="fas fa-map-marked-alt text-muted opacity-50 mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-dark fw-bold mb-1" style="font-size: 1.1rem;">Geospatial Road Network Map</h5>
                                <p class="text-muted small mb-3">Access comprehensive GIS spatial layout layers mapping entire district infrastructural assets.</p>
                                <a href="#" class="btn btn-outline-danger btn-sm font-weight-semibold px-4 py-2 text-uppercase tracking-wider" style="font-size: 0.75rem;">Request Spatial Data</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
/* Micro-Layout Utilities */
.border-light-dark { border-color: #f1f5f9 !important; }
.fs-7 { font-size: 0.85rem !important; }

@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #e2e8f0 !important;
        padding-right: 2.5rem !important;
    }
}
</style>

<?= $this->endSection()?>