<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>

<!-- 1. Visionary Hero Portal -->
<section class="hero-visionary position-relative overflow-hidden">
    <!-- Background -->
    <img src="<?= base_url('image/hero-img.png'); ?>" class="hero-bg w-100 h-100 object-cover position-absolute top-0 start-0" alt="Blantyre District Council HQ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Abstract Shapes -->
    <div class="abstract-shape shape-1"></div>
    <div class="abstract-shape shape-2"></div>

    <!-- Massive Typography Content -->
    <div class="container position-relative z-2 text-center fade-in-up py-5">
        <span class="hero-subtitle-pill d-inline-block px-3 py-1 rounded-pill mb-3" data-translate="welcome">Welcome to the Governance Portal</span>
        <h1 class="hero-title-massive text-white fw-extrabold mb-3" data-translate="district">BLANTYRE DISTRICT</h1>
        <p class="lead text-white-50 text-uppercase tracking-wider mb-4" data-translate="subtitle">The Commercial & Industrial Capital of Malawi</p>
        
        <!-- Hero Search Bar -->
        <div class="hero-search-container mx-auto" style="max-width: 600px;">
            <div class="hero-search-box input-group shadow-sm">
                <input type="text" class="hero-search-input form-control border-0 px-4 py-3" id="heroSearchInput" placeholder="Search services, documents, departments..." autocomplete="off">
                <button class="hero-search-btn btn px-4 text-white" id="heroSearchBtn" type="button" style="background-color: #0a2540; border-color: #0a2540;">
                    <i data-lucide="search"></i>
                </button>
            </div>
            <!-- Search Results Dropdown -->
            <div class="hero-search-results" id="heroSearchResults"></div>
        </div>
    </div>
</section>

<!-- Main Section Container (Changed background to clean white layout) -->
<!-- Main Wrapper Section (Changed to custom soft bluish-slate background to mirror civic styling layout) -->
<section class="w-100 py-0 position-relative" style="background-color: #f0f4f8;">

    <!-- 1. Emergency Services Strip (Maintained crisp red alert style) -->
    <div class="emergency-strip bg-danger text-white py-3 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <i data-lucide="ambulance" class="fs-2 me-3"></i>
                <div>
                    <h5 class="m-0 fw-bold text-uppercase tracking-wide">Emergency Response</h5>
                    <small class="text-white-50"> 24/7 District Support Line</small>
                </div>
            </div>
            <div class="d-flex gap-4 flex-wrap">
                <a href="tel:998" class="text-white text-decoration-none fw-bold hover-underline"><i data-lucide="phone" class="me-2"></i> 998 (Health)</a>
                <a href="tel:997" class="text-white text-decoration-none fw-bold hover-underline"><i data-lucide="shield" class="me-2"></i> 997 (Police)</a>
                <a href="tel:990" class="text-white text-decoration-none fw-bold hover-underline"><i data-lucide="flame" class="me-2"></i> 990 (Fire)</a>
            </div>
        </div>
    </div>
 
<div class="container py-5">
    <div class="row g-4">
        
        <!-- Mission, Vision & Mandate Card -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm p-4 p-md-5 rounded-3 bg-white">
                <h2 class="h3 fw-bold text-dark mb-4 border-bottom pb-2">Vision, Mission & Mandate</h2>
                
                <!-- Always Visible: Vision -->
                <div class="mb-3">
                    <h4 class="h5 fw-bold text-primary mb-2">Vision</h4>
                    <p class="text-dark">A Council that is able to provide sustainable quality socio-economic services adequately to its community.</p>
                </div>
                
                <!-- Collapsible Content -->
                <div class="collapse" id="missionMandateContent">
                    <div class="mb-4">
                        <h4 class="h5 fw-bold text-primary mb-2">Mission</h4>
                        <p class="text-dark">To provide timely high quality and equitable Social Service through promotion of Local Governance and popular participation of the communities attainment of sustainable social-economic development of the district.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold text-primary  mt-2">Core Values</h6>
                        <p class="small text-dark">Transparency, People-Centred, Gender sensitivity, Equitable services, Professionalism, Environmental friendly, and Appropriate technologies.</p>
                        <h6 class="fw-bold text-primary mt-3">Mandate (Functions)</h6>
                        <ul class="small text-dark ps-3">
                            <li>Local governance & development decision-making.</li>
                            <li>Promote local democratic participation.</li>
                            <li>Infrastructure & District Development Planning.</li>
                            <li>Resource mobilization & peace/security maintenance.</li>
                            <li>By-law formulation & staff management.</li>
                        </ul>
                    </div>
                </div>

                <!-- Toggle Button -->
                <div class="mt-auto pt-2">
                <button id="missionBtn"
                        class="btn btn-outline-primary btn-sm rounded-pill px-4"
                        type="button">
                    View More
                </button>
                </div>
            </div>
        </div>

        <!-- About Blantyre Card -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm p-4 p-md-5 rounded-3 bg-white">
                <h2 class="h3 fw-bold text-dark mb-4 border-bottom pb-2">About Blantyre</h2>
                 <div class="mb-3">
                    <h4 class="h5 fw-bold text-primary mb-2">Location</h4>
                    <p class="text-dark">Blantyre District is located in the Southern Region of Malawi.</p>
                </div>
                
                <!-- Collapsible Content -->
<div class="collapse" id="blantyreMoreContent">

    <div class="mb-4">
        <h4 class="h5 fw-bold text-primary mb-2">Population</h4>
        <p class="text-dark">
            Blantyre District has a large and growing population made up of both
            urban and rural communities. The district serves as a major economic
            and administrative hub in the Southern Region of Malawi.
        </p>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold text-primary mt-2">Culture and Ethnicity</h6>
        <p class="small text-dark">
            Blantyre District is home to diverse ethnic communities, with the
            Mang’anja, Yao, Lomwe, Chewa, and Ngoni among the most prominent groups.
            Chichewa is widely spoken, while Yao and other local languages are also
            used within communities. The district's cultural diversity is reflected
            in its traditions, music, dance, cuisine, and community celebrations.
        </p>

        <h6 class="fw-bold text-primary mt-3">Economy and Livelihoods</h6>
        <ul class="small text-dark ps-3">
            <li>Agriculture remains a key source of income in rural areas.</li>
            <li>Trade, manufacturing, and service industries support urban livelihoods.</li>
            <li>The district hosts important commercial and industrial activities.</li>
            <li>Forestry and small-scale businesses contribute to local development.</li>
        </ul>
    </div>

</div>

                <div class="mt-auto pt-4">
                <button id="aboutBtn"
                        class="btn btn-outline-primary btn-sm rounded-pill px-4"
                        type="button">
                    Read More
                </button>
                </div>
            </div>
        </div>
        
    </div>
</div>
</section>
<!-- Main Content Area Wrapper -->
<section class="container py-5">
    
    <!-- 3. Public Services Grid -->
    <div class="section-header d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
        <h2 class="section-title text-dark fw-bold m-0">Public Services</h2>
        <a href="<?= base_url('services'); ?>" class="text-decoration-none small text-dark mb-0 text-uppercase fw-bold tracking-wide">View Directory <i data-lucide="arrow-right" class="ms-1"></i></a>
    </div>
    
    <div class="bento-grid-dense mb-5">
        <a href="<?= base_url('business-license'); ?>" class="dense-card featured text-decoration-none p-4 rounded shadow-sm d-flex flex-column h-100 bg-white">
            <div class="mb-auto">
                <span class="badge bg-warning text-dark mb-3">Trending</span>
                <h3 class="h4 fw-bold text-dark mb-2">Business Licensing</h3>
            </div>
            <p class="text-dark small mb-0">
                Apply for new licenses, renew existing ones, or check compliance status online.
            </p>
        </a>
        <a href="<?= base_url('services'); ?>" class="dense-card text-decoration-none p-4 rounded shadow-sm bg-white hover-up">
            <i data-lucide="home" class="text-accent mb-3 fs-4"></i>
            <h4 class="h6 fw-bold text-dark mb-1">Prop. Rates</h4>
            <p class="small text-dark small mb-0">Pay city & ground rates securely.</p>
        </a>
        <a href="<?= base_url('services'); ?>" class="dense-card text-decoration-none p-4 rounded shadow-sm bg-white hover-up">
            <i data-lucide="hard-hat" class="text-accent mb-3 fs-4"></i>
            <h4 class="h6 fw-bold text-dark mb-1">Planning</h4>
            <p class="small text-dark mb-0">Building permits & zoning maps.</p>
        </a>
        <a href="<?= base_url('directorate-of-public-works'); ?>" class="dense-card text-decoration-none p-4 rounded shadow-sm bg-white hover-up">
            <i data-lucide="leaf" class="text-accent mb-3 fs-4"></i>
            <h4 class="h6 fw-bold text-dark mb-1">Public works</h4>
            <p class="small text-dark mb-0">Project Management</p>
        </a>
        <a href="<?= base_url('directorate-of-health'); ?>" class="dense-card text-decoration-none p-4 rounded shadow-sm bg-white hover-up">
            <i data-lucide="heart" class="text-accent mb-3 fs-4"></i>
            <h4 class="h6 fw-bold text-dark mb-1">Health</h4>
            <p class="small text-dark mb-0">Clinic locations & services.</p>
        </a>
        <a href="<?= base_url('directorate-of-education'); ?>" class="dense-card text-decoration-none p-4 rounded shadow-sm bg-white hover-up">
            <i data-lucide="graduation-cap" class="text-accent mb-3 fs-4"></i>
            <h4 class="h6 fw-bold text-dark mb-1">Education</h4>
            <p class="small text-dark mb-0">Bursaries & school lists.</p>
        </a>
        <a href="<?= base_url('directorate-of-agriculture'); ?>" class="dense-card text-decoration-none p-4 rounded shadow-sm bg-white hover-up">
            <i data-lucide="gavel" class="text-accent mb-3 fs-4"></i>
            <h4 class="h6 fw-bold text-dark mb-1">Agriculture</h4>
            <p class="small text-dark mb-0">District Agriculture activities</p>
        </a>
    </div>

    <!-- 4. District Leadership -->
    <div class="mb-5">
        <div class="section-header border-bottom pb-2 mb-4">
            <h2 class="section-title text-dark fw-bold m-0">District Leadership</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <?php 
            $districtLeadership = $districtLeadership ?? [];
            if (empty($districtLeadership)): 
            ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <p class="mb-0">District leadership information is being updated. Please visit our <a href="<?= base_url('management') ?>" class="alert-link ">Management page</a> to view all team members.</p>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($districtLeadership as $leader): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="leadership-card card h-100 border-0 shadow-sm p-4 text-center bg-white">
                            <div class="leader-img-wrapper mb-3 mx-auto">
                                <img src="<?= base_url($leader['photo'] ?: 'image/cropped-BDC-site-logo.png') ?>" alt="<?= esc($leader['name']) ?>" class="leader-img img-fluid rounded-circle bg-light shadow-sm" style="width: 130px; height: 130px; object-fit: cover;">
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-1"><?= esc($leader['name']) ?></h4>
                            <p class="small text-primary text-uppercase fw-semibold tracking-wider mb-3"><?= esc($leader['position']) ?></p>
                            <p class="small text-dark mb-3 flex-grow-1"><?= esc($leader['bio'] ?? 'Dedicated professional committed to serving Blantyre District Council with excellence and integrity.') ?></p>
                            <p class="small text-dark fst-italic mb-4"><?php if (!empty($leader['department'])): ?>"Leading <?= esc($leader['department']) ?>"<?php endif; ?></p>
                            <a href="<?= base_url('management') ?>" class="btn btn-sm btn-outline-dark rounded-pill px-4 mt-auto align-self-center">View All Leaders</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- 10. Dynamic News Scroll Section -->
<!-- FIX: Removed 'container' from section classes so nesting padding rules don't collapse -->
  <section class="news-grid-wrapper py-5 border-top border-bottom bg-light" id="news-section">
    <div class="container">
        
        <div class="section-header d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
            <h2 class="section-title text-dark fw-bold m-0">District Updates</h2>
            <a href="<?= base_url('news'); ?>" class="text-decoration-none small text-dark mb-0 text-uppercase fw-bold tracking-wide">
                View All News <i data-lucide="arrow-right" class="ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($newsArticles as $index => $article): ?>
                <?php
                    // Dynamic Image Logic kept directly within the single card scope
                    $images = [];
                    if (!empty($article['featured_image'])) {
                        $decoded = json_decode($article['featured_image'], true);
                        if (is_array($decoded)) {
                            $images = $decoded;
                        } else {
                            $images = [$article['featured_image']];
                        }
                    }
                    $image = !empty($images) ? $images[0] : 'image/news_placeholder.jpg';
                ?>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 bg-white border-0 shadow-sm overflow-hidden d-flex flex-column rounded-3">
                        
                        <div class="position-relative" style="height: 220px; overflow: hidden;">
                            <img 
                                src="<?= base_url($image) ?>" 
                                class="w-100 h-100 object-cover" 
                                alt="<?= esc($article['title']) ?>"
                                style="object-fit: cover;"
                            >
                            <?php if ($index === 0): ?>
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-2 py-1.5 small shadow-sm">
                                    LATEST
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            
                            <div class="news-date text-muted small mb-2 fw-semibold">
                                <?= !empty($article['published_at'])
                                    ? date('F d, Y', strtotime($article['published_at']))
                                    : 'Latest Update' ?>
                            </div>

                            <h3 class="news-headline h5 fw-bold text-dark mb-2 line-clamp-2">
                                <?= esc($article['title']) ?>
                            </h3>

                            <?php if (!empty($article['excerpt'])): ?>
                                <p class="news-excerpt text-muted small mb-4 text-truncate">
                                    <?= esc($article['excerpt']) ?>
                                </p>
                            <?php else: ?>
                                <p class="news-excerpt text-muted small mb-4 text-truncate">
                                    No summary description provided for this specific district brief update.
                                </p>
                            <?php endif; ?>

                            <div class="mt-auto pt-2">
                                <a href="<?= base_url('news') ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-bold">
                                    Read Full Story
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

    <!-- 5. Development Tracker -->
   <div class="row g-4">
    <p class="section-header border-bottom pb-2 mb-4">
        <h2 class="section-title text-dark fw-bold m-0">Development Projects</h2>
    </p>
    <?php foreach ($latestProjects as $project): ?>

        <div class="col-md-6">
            <div class="project-card card p-4 border-0 shadow-sm bg-white"
                style="<?= $project['status'] === 'completed' ? 'border-left:4px solid #198754' : '' ?>">

                <!-- Top row -->
                <div class="d-flex justify-content-between mb-2">

                    <span class="badge
                        <?php
                            switch ($project['category']) {
                                case 'Infrastructure': echo 'bg-success bg-opacity-10 text-success'; break;
                                case 'Education': echo 'bg-warning bg-opacity-10 text-warning'; break;
                                default: echo 'bg-info bg-opacity-10 text-info';
                            }
                        ?> rounded-pill px-2">
                        <?= esc($project['category']) ?>
                    </span>

                    <small class="fw-bold text-dark">
                        <?= esc($project['progress_percentage']) ?>% Complete
                    </small>
                    
                </div>
                
                <!-- Title -->
                <h5 class="fw-bold mb-2">
                    <?= esc($project['title']) ?>
                </h5>

                <!-- Progress -->
                <a href="<?= base_url('projects') ?>" class="text-decoration-none d-block">

                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar
                            <?php
                                if ($project['progress_percentage'] == 100) echo 'bg-success';
                                elseif ($project['progress_percentage'] >= 70) echo 'bg-warning';
                                else echo 'bg-danger';
                            ?>"
                            style="width: <?= esc($project['progress_percentage']) ?>%">
                        </div>
                    </div>

                </a>

                <!-- Footer info -->
                <p class="small text-dark mb-0">
                    <i data-lucide="map-pin" class="me-1"></i>
                    <?= esc($project['location']) ?>
                    <?php if (!empty($project['created_at'])): ?>
                        • <?= date('M Y', strtotime($project['created_at'])) ?>
                    <?php endif; ?>
                </p>

            </div>
        </div>

    <?php endforeach; ?>
</div>

    <!-- 6. Investment Gateway -->
    <div class="text-white rounded-3 p-5 mb-5 position-relative overflow-hidden shadow" style="background-color: #071324;">
        <div class="position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-3 text-white">Invest in Blantyre</h2>
                    <p class="lead opacity-75 mb-4 text-white">Discover prime opportunities in Malawi's commercial capital. From industrial zones to eco-tourism.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="<?= base_url('downloads'); ?>" class="btn btn-warning px-4 py-2 fw-bold shadow-sm">Download Investment Guide</a>
                        </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block">
                    <i data-lucide="trending-up" class="display-1 opacity-25 text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. Tourism Spotlight -->
    <div class="mb-5">
         <div class="section-header border-bottom pb-2 mb-4">
            <h2 class="section-title text-dark fw-bold m-0">Visit Blantyre</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="tourism-card position-relative overflow-hidden rounded shadow-sm" onclick="openTourismModal('<?= base_url('image/michiru.jpg'); ?>', 'Michiru Mountain', 'Hiking & Nature')">
                    <img src="<?= base_url('image/michiru.jpg'); ?>" class="w-100 object-cover" style="height: 250px;" alt="Michiru Mountain">
                    <div class="tourism-overlay position-absolute bottom-0 start-0 w-100 p-3 text-white bg-gradient-dark">
                        <h5 class="fw-bold mb-0 text-white">Michiru Mountain</h5>
                        <small class="text-white">Hiking & Nature</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tourism-card position-relative overflow-hidden rounded shadow-sm" onclick="openTourismModal('<?= base_url('image/museum.jpg'); ?>', 'Chichiri Museum', 'History & Culture')">
                    <img src="<?= base_url('image/lunzu.png'); ?>" class="w-100 object-cover" style="height: 250px;" alt="Museum">
                    <div class="tourism-overlay position-absolute bottom-0 start-0 w-100 p-3 text-white bg-gradient-dark">
                        <h5 class="fw-bold mb-0 text-white">Lunzu Market</h5>
                        <small class="text-white">Trade</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tourism-card position-relative overflow-hidden rounded shadow-sm" onclick="openTourismModal('<?= base_url('image/tea.jpg'); ?>', 'Tea Estates', 'Agri-Tourism')">
                    <img src="<?= base_url('image/tractor.jpg'); ?>" class="w-100 object-cover" style="height: 250px;" alt="Tea Estates">
                    <div class="tourism-overlay position-absolute bottom-0 start-0 w-100 p-3 text-white bg-gradient-dark">
                        <h5 class="fw-bold mb-0 text-white">Council Farming Tractor</h5>
                        <small class="text-white">Agri-Business</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 8. Voice Your Opinion & Downloads -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="bg-light p-4 rounded shadow-sm border h-100">
                <h4 class="fw-bold text-dark mb-3"><i data-lucide="message-circle" class="text-primary me-2"></i> Citizen Feedback</h4>
                <p class="small text-dark mb-3">How would you rate the waste collection services in your area this month?</p>
                <form>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="feedback" id="f1">
                        <label class="form-check-label text-dark" for="f1">Excellent</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="feedback" id="f2">
                        <label class="form-check-label text-dark" for="f2">Satisfactory</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="feedback" id="f3">
                        <label class="form-check-label text-dark" for="f3">Needs Improvement</label>
                    </div>
                    <button class="btn btn-sm btn-dark px-3 rounded-pill">Submit Vote</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
             <div class="bg-light p-4 rounded shadow-sm border h-100">
                <h4 class="fw-bold text-dark mb-3"><i data-lucide="download" class="text-primary me-2"></i> Quick Downloads</h4>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="<?= base_url('downloads'); ?>" class="text-decoration-none text-dark hover-link"><i data-lucide="file-text" class="text-danger me-2"></i> District Development Plan 2025-2030</a></li>
                    <li class="mb-2"><a href="<?= base_url('downloads'); ?>" class="text-decoration-none text-dark hover-link"><i data-lucide="file-text" class="text-danger me-2"></i> Business License Application Form</a></li>
                    <li class="mb-2"><a href="<?= base_url('downloads'); ?>" class="text-decoration-none text-dark hover-link"><i data-lucide="file-text" class="text-danger me-2"></i> Annual Financial Report 2024</a></li>
                    <li class="mt-3"><a href="<?= base_url('downloads'); ?>" class="text-decoration-none text-muted small fw-bold">View all 45 documents...</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 9. Partners -->
<div class="text-center mb-4">
    <small class="text-uppercase text-dark fw-bold tracking-widest">
        Our Development Partners
    </small>

    <div class="d-flex justify-content-center gap-5 mt-4 align-items-center flex-wrap opacity-75">

        <a href="https://www.un.org/" target="_blank" rel="noopener noreferrer">
            <img src="<?= base_url('image/un.png'); ?>"
                 class="partner-logo"
                 style="max-height: 45px;"
                 alt="United Nations">
        </a>

        <a href="https://www.usaid.gov/" target="_blank" rel="noopener noreferrer">
            <img src="<?= base_url('image/usaid.png'); ?>"
                 class="partner-logo"
                 style="max-height: 45px;"
                 alt="USAID">
        </a>

        <a href="https://www.worldbank.org/" target="_blank" rel="noopener noreferrer">
            <img src="<?= base_url('image/worldbank.jpg'); ?>"
                 class="partner-logo"
                 style="max-height: 45px;"
                 alt="World Bank">
        </a>

        <a href="https://european-union.europa.eu/" target="_blank" rel="noopener noreferrer">
            <img src="<?= base_url('image/eu.png'); ?>"
                 class="partner-logo"
                 style="max-height: 45px;"
                 alt="European Union">
        </a>

    </div>
</div>

</section>
<!-- 11. Ultra-Modern Footer -->
<footer class="modern-footer text-white pt-5 pb-3 position-relative" style="background-color: #071324;">
    <div class="container">
        <div class="row g-4 mb-4">
<div class="col-lg-4 text-center d-flex flex-column align-items-center">
    
<img 
    src="<?= base_url('image/new_logo.png'); ?>" 
    alt="Logo"
    class="mb-3"
    style="height: 55px; width: auto; object-fit: contain;"
>

      <div class="d-flex gap-3 mt-3">
                    <a href="https://www.facebook.com/BlantyreDistrictCouncil" class="text-white-50 hover-white"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white-50 hover-white"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white-50 hover-white"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white-50 hover-white"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="text-uppercase fw-bold text-white mb-3">Governance</h6>
                <ul class="list-unstyled footer-links small">
                    <li class="mb-2"><a href="<?= base_url('management'); ?>" class="text-white-50 text-decoration-none hover-white">Leadership</a></li>
                    <li class="mb-2"><a href="<?= base_url('officials'); ?>" class="text-white-50 text-decoration-none hover-white">Elected Officials</a></li>
                    <li class="mb-2"><a href="<?= base_url('directorate-of-financial-services'); ?>" class="text-white-50 text-decoration-none hover-white">Financies</a></li>
                    <li class="mb-2"><a href="<?= base_url('directorate-of-health'); ?>" class="text-white-50 text-decoration-none hover-white">Health</a></li>
                  </ul>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="text-uppercase fw-bold text-white mb-3">Services</h6>
                <ul class="list-unstyled footer-links small">
                    <li class="mb-2"><a href="<?= base_url('business-license'); ?>" class="text-white-50 text-decoration-none hover-white">Business Licenses</a></li>
                    <li class="mb-2"><a href="<?= base_url('marriage-certificates'); ?>" class="text-white-50 text-decoration-none hover-white">Marriage Certificates</a></li>
                   <li class="mb-2"><a href="<?= base_url('birth-certificate'); ?>" class="text-white-50 text-decoration-none hover-white">Birth & Death Certificates</a></li>
                    <li class="mb-2"><a href="<?= base_url('firearm'); ?>" class="text-white-50 text-decoration-none hover-white">Firearm License</a></li>                    
                </ul>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="text-uppercase fw-bold text-white mb-3">Resources</h6>
                <ul class="list-unstyled footer-links small">
                    <li class="mb-2"><a href="<?= base_url('downloads'); ?>" class="text-white-50 text-decoration-none hover-white">Downloads</a></li>
                    <li class="mb-2"><a href="<?= base_url('tenders'); ?>" class="text-white-50 text-decoration-none hover-white">Tenders & Vacancie</a></li>
                    <li class="mb-2"><a href="<?= base_url('news'); ?>" class="text-white-50 text-decoration-none hover-white">news</a></li>
                    <li class="mb-2"><a href="<?= base_url('projects'); ?>" class="text-white-50 text-decoration-none hover-white">Projects</a></li>
                </ul>
            </div>
            
            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="text-uppercase fw-bold text-white mb-3">Support</h6>
                <ul class="list-unstyled footer-links small">
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Contact Us</a></li>
                    <li class="mb-2"><a href="<?= base_url('complaint-reporting'); ?>" class="text-white-50 text-decoration-none hover-white">Report Fault</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Emergency</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">FAQs</a></li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 small text-white-50">
            <div class="d-flex align-items-center gap-3">
                <span>&copy; 2026 Blantyre District Council</span>
                <span>|</span>
                <span class="d-flex align-items-center"><span class="bg-success rounded-circle d-inline-block me-2" style="width:8px; height:8px;"></span> Systems Online</span>
            </div>
            <div class="d-flex gap-4">
                <span><i data-lucide="package" class="me-1"></i> 1.2k+ Projects</span>
                <span><i data-lucide="users" class="me-1"></i> 500k+ Citizens</span>
            </div>
        </div>
    </div>
</footer>

<!-- AI Chatbot Modal -->
<div class="chatbot-modal" id="chatbotModal">
    <div class="chatbot-container"
        style="background:#071324;color:#fff;border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.4);">

        <div class="chatbot-header"
            style="background:linear-gradient(135deg,#071324,#0b1f3a);color:#fff;border-bottom:1px solid rgba(255,255,255,0.08);padding:15px;display:flex;justify-content:space-between;align-items:center;">

            <div class="chatbot-info" style="display:flex;align-items:center;">
                <div class="chatbot-avatar">
                    <i data-lucide="bot" class="fs-2 me-3"></i>
                </div>

                <div class="chatbot-details">
                    <h5 style="margin:0;color:#fff;">AI Assistant</h5>
                    <span style="color:#4ade80;font-size:12px;">Online</span>
                </div>
            </div>

            <button class="chatbot-close" id="closeChatbot"
                style="background:none;border:none;color:#fff;opacity:0.8;cursor:pointer;">
                <i data-lucide="x" class="fs-2 me-3"></i>
            </button>
        </div>

        <div class="chatbot-messages" id="chatMessages"
            style="background:#06101f;padding:15px;max-height:400px;overflow-y:auto;">

            <div class="message bot-message">
                <div class="message-content"
                    style="background:#0b1f3a;color:#fff;padding:10px 14px;border-radius:12px;display:inline-block;">
                    Hello! I'm your AI assistant for Blantyre District Council. How can I help you today?
                </div>
                <div class="message-time" style="font-size:11px;color:#b8c2d3;margin-top:5px;">
                    Just now
                </div>
            </div>

        </div>

        <div class="chatbot-input-container"
            style="background:#071324;border-top:1px solid rgba(255,255,255,0.08);display:flex;padding:10px;gap:10px;">

            <input type="text" id="chatInput"
                style="flex:1;background:#0b1f3a;color:#fff;border:1px solid rgba(255,255,255,0.1);padding:10px;border-radius:10px;"
                placeholder="Type your message..." />

            <button id="sendMessage"
                style="background:#1e4fa8;color:#fff;border:none;padding:10px 14px;border-radius:10px;cursor:pointer;">
                <i data-lucide="send" class="fs-2 me-3"></i>
            </button>
        </div>

    </div>
</div>

<!-- AI Chatbot Bubble -->
<div class="chatbot-bubble" id="chatbotBubble"
    style="background:#071324;color:#fff;border-radius:50px;padding:12px;box-shadow:0 10px 30px rgba(0,0,0,0.3);cursor:pointer;">

    <div class="bubble-content" style="display:flex;align-items:center;gap:8px;">
        <i data-lucide="bot"></i>
        <span></span>
    </div>

    <div class="greeting-message" id="greetingMessage"
        style="position:absolute;background:#0b1f3a;padding:10px;border-radius:10px;max-width:220px;color:#fff;margin-top:10px;">

        <div class="greeting-content">
            <i data-lucide="sparkles"></i>
            <p style="margin:5px 0 0;font-size:13px;color:#b8c2d3;">
                Need help? I'm here to assist you with Blantyre District services!
            </p>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const missionContent = document.getElementById('missionMandateContent');
    const aboutContent = document.getElementById('blantyreMoreContent');

    const missionBtn = document.getElementById('missionBtn');
    const aboutBtn = document.getElementById('aboutBtn');

    let isOpen = false;

    function toggleAll() {

        if (!isOpen) {
            missionContent.classList.add('show');
            aboutContent.classList.add('show');

            missionBtn.textContent = 'View Less';
            aboutBtn.textContent = 'Read Less';
        } else {
            missionContent.classList.remove('show');
            aboutContent.classList.remove('show');

            missionBtn.textContent = 'View More';
            aboutBtn.textContent = 'Read More';
        }

        isOpen = !isOpen;
    }

    missionBtn.addEventListener('click', toggleAll);
    aboutBtn.addEventListener('click', toggleAll);

});
</script>
<?= $this->endSection()?>