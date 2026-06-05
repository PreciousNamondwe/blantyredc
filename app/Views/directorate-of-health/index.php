<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero (Synced with Core Portal Guidelines) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Health and Social Services</h1>
    </div>
</section>

<!-- Main Informational Framework Section (Soft Bluish-Slate Civic Layer) -->
<section class="w-100" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                
                <!-- Section 1: Core Mission Card -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3 mb-5">
                    <div class="row align-items-center">
                         <div class="col-lg-8">
                              <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Mission & Strategy</h4>
                              <p class="text-muted mb-4" style="line-height: 1.6;">
                                   The Directorate of Health and Social Services systematically oversees the delivery of essential health and protection services within Blantyre District. Our primary mission centers on stabilizing and actively improving the longitudinal health status of all citizens by elevating quality standards and localized access parameters to the national Essential Health Package.
                              </p>
                              
                              <!-- Strategic Objectives Info-Block -->
                              <div class="p-4 rounded-3 border-start border-4" style="background-color: #f8fafc; border-color: #0ea5e9 !important;">
                                   <h6 class="text-dark fw-bold text-uppercase tracking-wider small mb-3">Strategic Objectives</h6>
                                   <ul class="text-muted small mb-0 ps-3" style="line-height: 1.7;">
                                        <li class="mb-2">Increase fully immunized child coverage thresholds to 90%.</li>
                                        <li class="mb-2">Reduce systemic stock-outs of essential tracer medicines to under 6%.</li>
                                        <li class="mb-2">Increase modern contraceptive access matrices to 58%.</li>
                                        <li class="m-0">Expand integrated community health service delivery points to 50%.</li>
                                   </ul>
                              </div>
                         </div>
                         <div class="col-lg-4 text-center d-none d-lg-block">
                              <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 180px; height: 180px; background-color: #f0f4f8;">
                                   <i class="fas fa-hand-holding-heart text-muted opacity-50" style="font-size: 4.5rem;"></i>
                              </div>
                         </div>
                    </div>
                </div>

                <!-- Section 2: Facilities Network Framework -->
                <div class="mb-5">
                    <h3 class="text-dark text-center mb-4 fw-bold tracking-tight">District Healthcare Network</h3>
                    
                    <div class="row g-4">
                        <!-- Government Facilities Sub-Card -->
                        <div class="col-lg-8">
                            <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                                <h5 class="text-dark mb-4 fw-bold pb-2 border-bottom border-light-dark">
                                    <i class="fas fa-hospital text-primary me-2"></i> Government Health Centres
                                </h5>
                                <div class="row text-muted small g-3" style="line-height: 1.6;">
                                    <div class="col-md-4">
                                        <ul class="list-unstyled m-0">
                                            <li class="py-1">• Chileka</li><li class="py-1">• Chimembe</li><li class="py-1">• Dziwe</li><li class="py-1">• Lirangwe</li><li class="py-1">• Lundu</li><li class="py-1">• Madziabango</li><li class="py-1">• Makata</li><li class="py-1">• Mdeka</li><li class="py-1">• Mpemba</li><li class="py-1">• Namikoko</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 border-start-md">
                                        <ul class="list-unstyled m-0">
                                            <li class="py-1">• Soche Maternity</li><li class="py-1">• Pensulo</li><li class="py-1">• Mpingo</li><li class="py-1">• Kadidi</li><li class="py-1">• Bangwe</li><li class="py-1">• Chilomoni</li><li class="py-1">• Limbe</li><li class="py-1">• South Lunzu</li><li class="py-1">• Zingwangwa</li><li class="py-1">• Mbayani</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 border-start-md">
                                        <ul class="list-unstyled m-0">
                                            <li class="py-1">• Makhetha</li><li class="py-1">• Chirimba</li><li class="py-1">• AMECA</li><li class="py-1">• Gateway</li><li class="py-1">• Chavala</li><li class="py-1">• Chikowa</li><li class="py-1">• Lighthouse</li><li class="py-1">• Kanjedza Police</li><li class="py-1">• Ebola Treatment Unit</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Faith-Based & Private Partners Sub-Card -->
                        <div class="col-lg-4">
                            <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                                <h5 class="text-dark mb-3 fw-bold tracking-tight small text-uppercase text-muted">CHAM / IHAM Partners</h5>
                                <ul class="text-muted small list-unstyled mb-4" style="line-height: 1.8;">
                                    <li class="mb-1"><i class="fas fa-church me-2 text-primary"></i> Mlambe Hospital</li>
                                    <li class="mb-1"><i class="fas fa-church me-2 text-primary"></i> St. Vincent</li>
                                    <li class="mb-1"><i class="fas fa-mosque me-2 text-success"></i> Madina Social Services</li>
                                    <li><i class="fas fa-mosque me-2 text-success"></i> Limbe Muslim Jamat</li>
                                </ul>
                                
                                <h5 class="text-dark mb-3 fw-bold tracking-tight small text-uppercase text-muted pt-2 border-top border-light-dark">Private Sector</h5>
                                <ul class="text-muted small list-unstyled m-0" style="line-height: 1.8;">
                                    <li class="mb-1">• SHIFA Hospital</li>
                                    <li class="mb-1">• Mwaiwathu Hospital</li>
                                    <li>• Blantyre Adventist</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Social Welfare Portfolio -->
                <div class="mt-5">
                    <div class="card bg-white border-0 shadow-sm p-4 p-md-5 rounded-3">
                        <div class="row g-4">
                             <div class="col-lg-4 border-end-lg">
                                  <h3 class="text-dark fw-bold mb-3 tracking-tight">Social Welfare</h3>
                                  <p class="text-muted small mb-4" style="line-height: 1.6;">
                                      Promoting fundamental human dignity across the district by actively systematically mitigating structural vulnerabilities for individuals and communities exposed to systemic social challenges.
                                  </p>
                                  <div class="d-inline-block px-3 py-1 rounded-2 small fw-bold tracking-wider text-uppercase" style="background-color: #fee2e2; color: #991b1b; font-size: 0.75rem;">
                                      Devolved Functions
                                  </div>
                             </div>
                             
                             <div class="col-lg-8 ps-lg-4">
                                  <div class="row g-4">
                                       <div class="col-md-6">
                                            <h6 class="text-dark fw-bold mb-2"><i class="fas fa-gavel text-primary me-2"></i> Probation & Rehab</h6>
                                            <p class="text-muted small mb-0" style="line-height: 1.5;">Crime prevention tracks, pre-trial services, management of reformatory infrastructure, and character reformation programs for youth.</p>
                                       </div>
                                       <div class="col-md-6">
                                            <h6 class="text-dark fw-bold mb-2"><i class="fas fa-child text-primary me-2"></i> Child Welfare</h6>
                                            <p class="text-muted small mb-0" style="line-height: 1.5;">Systematic protection from institutional abuse, custody management processing, social inquiries, and regulatory childcare supervision.</p>
                                       </div>
                                       <div class="col-md-6">
                                            <h6 class="text-dark fw-bold mb-2"><i class="fas fa-hands-helping text-primary me-2"></i> Public Assistance</h6>
                                            <p class="text-muted small mb-0" style="line-height: 1.5;">Targeted emergency response provisions, administrative assistance pathways for destitute individuals, and student coordination.</p>
                                       </div>
                                       <div class="col-md-6">
                                            <h6 class="text-dark fw-bold mb-2"><i class="fas fa-brain text-primary me-2"></i> Early Development</h6>
                                            <p class="text-muted small mb-0" style="line-height: 1.5;">National ECD policy execution frameworking, community center activities, and localized early stimulation program tracking for toddlers.</p>
                                       </div>
                                  </div>
                             </div>
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
    .border-start-md {
        border-left: 1px solid #cbd5e1 !important;
        padding-left: 1.5rem !important;
    }
}

@media (min-width: 992px) {
    .border-end-lg {
        border-right: 1px solid #cbd5e1 !important;
        padding-right: 2rem !important;
    }
}
</style>

<?= $this->endSection()?>