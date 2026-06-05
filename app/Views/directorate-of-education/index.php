<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero (Synced with Core Portal Guidelines) -->
<section class="bg-whitish-blue-canvas ">
    <div class="container py-5">
         <h1 class="text-center section-title-dark mb-0">Education & Sports</h1>
    </div>
</section>

<!-- Main Civic Content Frame -->
<section class="w-100" style="background-color: #f0f4f8;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                
                <!-- Card 1: Core Institutional Overview -->
                <div class="card bg-white text-dark border-0 shadow-sm p-4 p-md-5 rounded-3 mb-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h4 class="text-dark mb-3 fw-bold tracking-tight" style="font-size: 1.5rem;">Empowering the Future</h4>
                            <p class="text-muted mb-4" style="line-height: 1.6;">
                                The Directorate of Education, Sports and Youth coordinates all public instructional delivery and youth developmental programs within Blantyre District. The administration manages a vast field operational network of 15 distinct operational zones, serving over 150,000 pupils across primary and secondary tiers.
                            </p>
                            
                            <!-- Tactical Institutional Indicators -->
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 text-center border" style="background-color: #f8fafc;">
                                        <h3 class="text-dark fw-bold mb-0">159</h3>
                                        <span class="text-muted small tracking-wider text-uppercase fw-semibold" style="font-size: 0.7rem;">Public Primary Schools</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 text-center border" style="background-color: #f8fafc;">
                                        <h3 class="text-dark fw-bold mb-0">57</h3>
                                        <span class="text-muted small tracking-wider text-uppercase fw-semibold" style="font-size: 0.7rem;">Secondary Schools</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 text-center border" style="background-color: #fff5f5; border-color: #fee2e2 !important;">
                                        <h3 class="text-danger fw-bold mb-0">61 : 1</h3>
                                        <span class="text-danger small tracking-wider text-uppercase fw-semibold" style="font-size: 0.7rem;">Pupil / Teacher Ratio</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Branding Icon Space -->
                        <div class="col-lg-4 text-center d-none d-lg-block">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 180px; height: 180px; background-color: #f0f4f8;">
                                <i class="fas fa-graduation-cap text-muted opacity-50" style="font-size: 4.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Operational Ratios & Challenges Grid -->
                <div class="row g-4 mb-5">
                    <!-- Metrics Table Module -->
                    <div class="col-lg-7">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <h5 class="text-dark mb-4 fw-bold pb-2 border-bottom border-light-dark text-uppercase tracking-wider small">
                                <i class="fas fa-chart-bar text-muted me-2"></i> Key Education Indicators
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle small mb-0">
                                    <thead class="table-light text-uppercase tracking-wider text-muted" style="font-size: 0.75rem;">
                                        <tr>
                                            <th class="border-0 py-2">Systemic Indicator Axis</th>
                                            <th class="border-0 text-end py-2">Operational Ratio</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted">
                                        <tr><td class="py-2.5">Pupil Qualified Teacher Ratio (PQTR)</td><td class="text-end fw-bold text-dark py-2.5">62 : 1</td></tr>
                                        <tr><td class="py-2.5">Pupil Classroom Ratio (PCR)</td><td class="text-end fw-bold text-dark py-2.5">127 : 1</td></tr>
                                        <tr><td class="py-2.5">Pupil Latrine Ratio (PLR)</td><td class="text-end fw-bold text-dark py-2.5">87 : 1</td></tr>
                                        <tr><td class="py-2.5">Teacher House Ratio (THR)</td><td class="text-end fw-bold text-dark py-2.5">5 : 1</td></tr>
                                        <tr class="table-light text-dark fw-bold">
                                            <td class="py-2.5">Primary School Leaving Certificate Pass Rate (Average)</td>
                                            <td class="text-end py-2.5 text-primary">64%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Structural Challenges Module -->
                    <div class="col-lg-5">
                        <div class="card bg-white border-0 shadow-sm p-4 h-100 rounded-3">
                            <h5 class="text-dark mb-4 fw-bold pb-2 border-bottom border-light-dark text-uppercase tracking-wider small">
                                <i class="fas fa-exclamation-triangle text-muted me-2"></i> Sector Constraints
                            </h5>
                            <div class="d-flex align-items-start mb-3">
                                <div class="me-3 mt-1"><i class="fas fa-exclamation-circle text-danger"></i></div>
                                <p class="small text-muted mb-0" style="line-height: 1.5;">
                                    <strong>Teacher Scarcity:</strong> Staff distribution constraints in remote rural placements remain critical, with localized school ratios reaching up to 187:1 in extreme peripheral zones.
                                </p>
                            </div>
                            <div class="d-flex align-items-start border-top border-light-dark pt-3">
                                <div class="me-3 mt-1"><i class="fas fa-building text-warning"></i></div>
                                <p class="small text-muted mb-0" style="line-height: 1.5;">
                                    <strong>Infrastructure Deficit:</strong> Structural physical resource shortfalls across Community Day Secondary Schools (CDSS) are being mitigated via targeted allocations from local Capital Development Funds.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Technical Skills & Vocational Matrix -->
                <div class="card bg-white border-0 shadow-sm p-4 p-md-5 rounded-3">
                    <div class="row g-4">
                        <div class="col-lg-4 border-end-lg">
                            <h4 class="text-dark fw-bold mb-3 tracking-tight" style="font-size: 1.5rem;">Tertiary & Skills</h4>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Providing regulated technical, vocational, and professional education training tracks to support sustainable local alternative livelihood options for the youth demographic.
                            </p>
                        </div>
                        
                        <div class="col-lg-8 ps-lg-4">
                            <div class="row g-4 text-muted small">
                                <div class="col-md-6">
                                    <h6 class="text-dark fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.85rem;">
                                        <i class="fas fa-tools text-primary me-2"></i> Vocational Training Centers
                                    </h6>
                                    <p class="mb-0 text-muted" style="line-height: 1.5;">Institutionalized skill options are delivered primarily via the Stephanos Foundation, Comboni Technical, and Maoni Technical College.</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-dark fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.85rem;">
                                        <i class="fas fa-chalkboard-teacher text-primary me-2"></i> Educator Development
                                    </h6>
                                    <p class="mb-0 text-muted" style="line-height: 1.5;">Chilangoma DAPP Teachers Training College (TTC) serves as the primary strategic driver for producing qualified primary educators.</p>
                                </div>
                                <div class="col-12 border-top border-light-dark pt-3 mt-3">
                                    <span class="text-muted fw-bold text-uppercase tracking-wider me-2" style="font-size: 0.75rem;">Core Curriculums:</span>
                                    <span class="badge bg-light text-secondary border px-2 py-1.5 rounded ms-1">Carpentry & Joinery</span>
                                    <span class="badge bg-light text-secondary border px-2 py-1.5 rounded ms-1">Fabrication Welding</span>
                                    <span class="badge bg-light text-secondary border px-2 py-1.5 rounded ms-1">Plumbing</span>
                                    <span class="badge bg-light text-secondary border px-2 py-1.5 rounded ms-1">Agro-Business</span>
                                    <span class="badge bg-light text-secondary border px-2 py-1.5 rounded ms-1">Electrical Installation</span>
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
/* Micro-Layout Alignment Tokens */
.border-light-dark { border-color: #f1f5f9 !important; }
.fs-7 { font-size: 0.85rem !important; }
.py-2\.5 { padding-top: 0.65rem !important; padding-bottom: 0.65rem !important; }
.py-1\.5 { padding-top: 0.35rem !important; padding-bottom: 0.35rem !important; }

@media (min-width: 992px) {
    .border-end-lg {
        border-right: 1px solid #e2e8f0 !important;
        padding-right: 2rem !important;
    }
}
</style>

<?= $this->endSection()?>