<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero (Aligned with Core Portal Brand Guidelines) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Administration & Council Services</h1>
    </div>
</section>

<!-- Main Civic Content Frame -->
<section class="w-100" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                
                <!-- Card 1: Core Institutional Mandate -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3 mb-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Directorate Mandate</h4>
                            <p class="text-muted mb-3" style="line-height: 1.6;">
                                The Directorate of Administration is tasked with managing all core council management frameworks, delivering internal supportive workflows to secondary directorates, and executing direct administrative actions for the public.
                            </p>
                            <p class="text-muted mb-0" style="line-height: 1.6;">
                                To protect standards of transparent human capital deployment and ethical administration, the directorate reports directly to the council's <strong>Human Resource Service Committee</strong>-a committee composed of duly elected public officials.
                            </p>
                        </div>
                        
                        <!-- Systemic Symbol Block -->
                        <div class="col-lg-4 text-center d-none d-lg-block">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 170px; height: 170px; background-color: #f0f4f8;">
                                <i class="fas fa-sitemap text-muted opacity-50" style="font-size: 4rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Header: Operational Divisions -->
                <h4 class="text-dark mb-4 fw-bold text-uppercase tracking-wider small">
                    <i class="fas fa-layer-group text-muted me-2"></i> Operational Sections managed
                </h4>

                <!-- Core Grid: 2-Column Responsive Layout -->
                <div class="row g-4">
                    
                    <!-- Box 1: ICT Services -->
                    <div class="col-md-6">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-shape bg-light-primary text-primary rounded p-2 me-3">
                                    <i class="fas fa-desktop fs-5"></i>
                                </div>
                                <h5 class="text-dark m-0 fw-bold" style="font-size: 1.1rem;">Information & ICT Services</h5>
                            </div>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Addresses all core network architecture, information security, and technical system needs across the council. Working alongside public information divisions, this section guarantees smooth, modernized access to civic details for the general public.
                            </p>
                        </div>
                    </div>

                    <!-- Box 2: Human Resource Management -->
                    <div class="col-md-6">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-shape bg-light-primary text-primary rounded p-2 me-3">
                                    <i class="fas fa-users-cog fs-5"></i>
                                </div>
                                <h5 class="text-dark m-0 fw-bold" style="font-size: 1.1rem;">Human Resource Management</h5>
                            </div>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Administers all elements of human capital planning, recruitment pipelines, and performance audits. This section coordinates closely with the central government to ensure optimal workforce deployment levels across all departments.
                            </p>
                        </div>
                    </div>

                    <!-- Box 3: Chiefs Administration Services -->
                    <div class="col-md-6">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-shape bg-light-primary text-primary rounded p-2 me-3">
                                    <i class="fas fa-crown fs-5"></i>
                                </div>
                                <h5 class="text-dark m-0 fw-bold" style="font-size: 1.1rem;">Chiefs Administration Services</h5>
                            </div>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Manages delegated traditional governance functions transferred from central government. This division maintains the operational links between traditional leaders and the state, supplying complete administrative infrastructure to local traditional chiefs.
                            </p>
                        </div>
                    </div>

                    <!-- Box 4: General Administrative Services -->
                    <div class="col-md-6">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-shape bg-light-primary text-primary rounded p-2 me-3">
                                    <i class="fas fa-cogs fs-5"></i>
                                </div>
                                <h5 class="text-dark m-0 fw-bold" style="font-size: 1.1rem;">General Administrative Services</h5>
                            </div>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Governs essential central operations, including structural procurement actions, fleet management, facilities maintenance, safe storage of official will deposits, legal marriage solemnization, and continuous internal workflows aimed at boosting service quality.
                            </p>
                        </div>
                    </div>

                    <!-- Box 5: Deceased Estates (Span Full Width for Visual Variance) -->
                    <div class="col-12">
                        <div class="card border-0 shadow-sm p-4 rounded-3" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-left: 4px solid #475569 !important;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-shape bg-dark text-white rounded p-2 me-3">
                                    <i class="fas fa-gavel fs-5"></i>
                                </div>
                                <h5 class="text-dark m-0 fw-bold" style="font-size: 1.1rem;">Deceased Estates Management Services</h5>
                            </div>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Operates in structural partnership with the Office of the Administrator General. This specialized service group guarantees that all matters regarding deceased estate inheritances and distributions are audited, processed, and closed with legal precision and utmost urgency.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<style>
/* Micro-Layout Context Layout Utilities */
.fs-7 { font-size: 0.85rem !important; }
.font-weight-semibold { font-weight: 600 !important; }
.bg-light-primary { background-color: #ebf5ff !important; }
.icon-shape {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}
</style>

<?= $this->endSection()?>