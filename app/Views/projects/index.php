<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Abstract Shapes -->
<!-- Main Content Section -->
<section class="bg-light py-5 overlap-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                
                <!-- Main Institutional Content Card -->
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white rounded-lg">
                    
                    <div class="text-center max-w-3xl mx-auto mb-5">
                          <h2 class="text-dark fw-bold mb-3">Development Roadmap</h2>
                         <p class="text-secondary mb-0" style="font-size: 16px; line-height: 1.6;">
                             Monitoring the progress of infrastructure, public utilities, and social development projects across Blantyre. 
                             All district initiatives are transparently planned and approved through grassroots community governance structures, including the Village Development Committees (VDC), Area Development Committees (ADC), and the Full Council.
                         </p>
                    </div>

                    <!-- Project Table Container -->
                    <div class="table-responsive rounded border border-light-muted bg-white">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="bg-slate text-dark small text-uppercase font-weight-bold tracking-wider">
                                    <th class="py-3 ps-4 border-bottom-0" style="min-width: 320px;">Project Details</th>
                                    <th class="py-3 border-bottom-0" style="min-width: 180px;">Location</th>
                                    <th class="py-3 border-bottom-0" style="width: 140px;">Status</th>
                                    <th class="py-3 pe-4 border-bottom-0" style="width: 220px;">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($groupedProjects)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-secondary py-5">
                                            <div class="py-3">
                                                <i class="bi bi-folder-x text-muted d-block mb-2" style="font-size: 2.5rem;"></i>
                                                <span class="font-weight-bold d-block text-dark">No Active Projects</span>
                                                <small class="text-muted">There are currently no active developmental records tracking in this directory.</small>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($groupedProjects as $category => $projects): ?>
                                        <!-- Functional Sector Category Header Row -->
                                        <tr class="table-category-row">
                                            <th colspan="4" class="py-2.5 ps-4 text-primary bg-light-blue small font-weight-bold text-uppercase tracking-wider border-bottom-0">
                                                <i class="bi bi-tags-fill me-2 small"></i> <?= esc($category) ?> Sector
                                            </th>
                                        </tr>
                                        
                                        <?php foreach ($projects as $project): ?>
                                            <tr class="project-item-row">
                                                <!-- Project Title and Excerpt Description -->
                                                <td class="py-3 ps-4">
                                                    <span class="d-block text-dark font-weight-bold mb-1 project-title-text"><?= esc($project['title']) ?></span>
                                                    <?php if (!empty($project['description'])): ?>
                                                        <span class="text-secondary small d-block line-clamp-2" style="max-width: 640px; line-height: 1.5;">
                                                            <?= esc($project['description']) ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <!-- Project Physical Location -->
                                                <td class="py-3 text-secondary small">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-geo-alt-fill text-muted me-2" style="font-size: 14px;"></i>
                                                        <span><?= esc($project['location']) ?></span>
                                                    </div>
                                                </td>
                                                
                                                <!-- Modern Standardized Status Badges -->
                                                <td class="py-3">
                                                    <?php 
                                                        // Define standard public sector badge styles mappings dynamically
                                                        switch(strtolower($project['status'])) {
                                                            case 'completed': 
                                                                $badge_class = 'bg-success-light text-success'; 
                                                                break;
                                                            case 'ongoing': 
                                                                $badge_class = 'bg-warning-light text-warning-dark'; 
                                                                break;
                                                            case 'planning': 
                                                                $badge_class = 'bg-info-light text-info-dark'; 
                                                                break;
                                                            case 'suspended': 
                                                                $badge_class = 'bg-secondary-light text-secondary-dark'; 
                                                                break;
                                                            case 'cancelled': 
                                                                $badge_class = 'bg-danger-light text-danger'; 
                                                                break;
                                                            default: 
                                                                $badge_class = 'bg-light text-dark border';
                                                        }
                                                    ?>
                                                    <span class="badge px-2.5 py-1.5 rounded text-uppercase font-weight-bold tracking-wider <?= $badge_class ?>" style="font-size: 11px;">
                                                        <?= esc(ucfirst($project['status'])) ?>
                                                    </span>
                                                </td>
                                                
                                                <!-- Institutional Linear Metric Bar -->
                                                <td class="py-3 pe-4">
                                                    <?php 
                                                        $pct = (int)$project['progress_percentage'];
                                                        // Color assignment logic reflecting strict standard operations
                                                        if ($pct === 100) {
                                                            $bar_color = 'bg-success';
                                                        } elseif ($pct >= 50) {
                                                            $bar_color = 'bg-primary';
                                                        } elseif ($pct >= 20) {
                                                            $bar_color = 'bg-warning';
                                                        } else {
                                                            $bar_color = 'bg-danger';
                                                        }
                                                    ?>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="progress flex-grow-1 bg-light-muted rounded-pill" style="height: 6px;">
                                                            <div class="progress-bar rounded-pill <?= $bar_color ?>" 
                                                                 role="progressbar" 
                                                                 aria-valuenow="<?= $pct ?>" 
                                                                 aria-valuemin="0" 
                                                                 aria-valuemax="100" 
                                                                 style="width: <?= $pct ?>%">
                                                            </div>
                                                        </div>
                                                        <span class="small font-weight-bold text-dark text-nowrap" style="min-width: 42px; text-align: right;">
                                                            <?= $pct ?>%
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
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

<style>
    /* Public-Sector Alignment & Accessibility Standards */
    .max-w-3xl { max-width: 48rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
    .font-weight-bold { font-weight: 600; }
    .tracking-wider { letter-spacing: 0.05em; }
    .border-light-muted { border-color: #e2e8f0 !important; }
    .bg-light-muted { background-color: #f1f5f9; }
    
    /* Institutional Table Styles */
    .bg-slate { background-color: #f8fafc; }
    .bg-light-blue { background-color: #f0f7ff; }
    .py-2.5 { padding-top: 0.65rem; padding-bottom: 0.65rem; }
    .px-2.5 { padding-left: 0.65rem; padding-right: 0.65rem; }
    .py-1.5 { padding-top: 0.35rem; padding-bottom: 0.35rem; }
    
    .table-category-row th {
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }
    .project-item-row:first-of-type td {
        border-top: none;
    }
    .project-item-row td {
        border-bottom: 1px solid #f1f5f9;
    }
    .project-title-text {
        font-size: 1.05rem;
        color: #0f172a !important;
    }

    /* Soft Government-Style Status Color Palettes (High Contrast & Trust) */
    .bg-success-light { background-color: #dcfce7; }
    .text-success { color: #15803d !important; }
    
    .bg-warning-light { background-color: #fef9c3; }
    .text-warning-dark { color: #854d0e !important; }
    
    .bg-info-light { background-color: #e0f2fe; }
    .text-info-dark { color: #0369a1 !important; }
    
    .bg-danger-light { background-color: #fee2e2; }
    .text-danger { color: #b91c1c !important; }
    
    .bg-secondary-light { background-color: #f1f5f9; }
    .text-secondary-dark { color: #475569 !important; }

    /* Webkit Clamping safely avoids layout distortion from messy user entries */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<?= $this->endSection()?>