<?= $this->extend('templates/layout.php')?>

<?= $this->section('content')?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Internal Hero -->
<?php
    $officials = $officials ?? [];
    $mpOfficials = array_filter($officials, fn($official) => stripos((string) $official['position'], 'Member of Parliament') !== false);
    $wardOfficials = array_filter($officials, fn($official) => stripos((string) $official['position'], 'Ward Councilor') !== false || stripos((string) $official['position'], 'Councillor') !== false || stripos((string) $official['position'], 'Councilor') !== false);
    $otherOfficials = array_filter($officials, fn($official) => stripos((string) $official['position'], 'Member of Parliament') === false && stripos((string) $official['position'], 'Ward Councilor') === false && stripos((string) $official['position'], 'Councillor') === false && stripos((string) $official['position'], 'Councilor') === false);

    // Refactored profile cards matching the clean, independent layout of your home page
    $renderOfficial = function (array $official, string $iconClass = 'fas fa-landmark') {
        $photo = $official['photo'] ?: 'image/cropped-BDC-site-logo.png';
        $displayTitle = $official['department'] ?: $official['position'];
        $modalTitle = trim($official['position'] . ($official['department'] ? ' - ' . $official['department'] : ''));
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm p-3 text-center bg-white profile-card hover-up position-relative" 
                 role="button" 
                 data-bs-toggle="modal" 
                 data-bs-target="#profileModal"
                 data-name="<?= esc($official['name']) ?>"
                 data-title="<?= esc($modalTitle) ?>"
                 data-image="<?= base_url($photo) ?>"
                 data-email="<?= esc($official['email'] ?? '') ?>"
                 data-phone="<?= esc($official['phone'] ?? '') ?>"
                 data-bio="<?= esc($official['bio'] ?? '') ?>"
                 style="cursor: pointer; border-radius: 0.5rem; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                
                <div class="leader-img-wrapper mb-3 mx-auto mt-2">
                    <img src="<?= base_url($photo) ?>" 
                         alt="<?= esc($official['name']) ?>" 
                         class="leader-img img-fluid rounded-circle bg-light shadow-sm" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                
                <div class="card-body p-2 d-flex flex-column">
                    <h5 class="fw-bold text-dark h6 mb-1"><?= esc($official['name']) ?></h5>
                    <p class="small text-primary text-uppercase fw-semibold tracking-wider mb-3" style="font-size: 0.75rem;">
                        <i class="<?= esc($iconClass) ?> me-1"></i><?= esc($displayTitle) ?>
                    </p>
                    <div class="mt-auto pt-2 text-muted small border-top" style="font-size: 0.75rem;">
                        <i class="fas fa-info-circle me-1"></i> View Profile
                    </div>
                </div>
            </div>
        </div>
        <?php
    };
?>

<!-- Main Content Wrapper Section (Uses your exact custom soft bluish-slate background) -->
<section class="w-100 py-5" style="background-color: #dde6ef;">
    <div class="container">
        
        <?php if (empty($officials)): ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card bg-white text-dark border-0 shadow-sm p-4 text-center rounded-3">
                        <p class="text-muted mb-0">No elected officials have been published yet.</p>
                    </div>
                </div>
            </div>
        <?php else: ?>

            <!-- 1. Members of Parliament Section -->
            <?php if (!empty($mpOfficials)): ?>
                <div class="row justify-content-center mb-5">
                    <div class="col-12">
                        <div class="section-header d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                            <h2 class="section-title text-dark fw-bold m-0 h4">Members of Parliament</h2>
                        </div>
                        <p class="text-dark small mb-4" style="max-width: 800px;">
                            Blantyre District Council has a total of 8 Members of Parliament. 
                            Three of these also appear under Blantyre City Council because their constituencies overlap between the two authorities.
                        </p>
                        <div class="row g-4">
                            <?php foreach ($mpOfficials as $official): ?>
                                <?php $renderOfficial($official, 'fas fa-landmark'); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 2. Ward Councilors Section -->
            <?php if (!empty($wardOfficials)): ?>
                <div class="row justify-content-center mb-5">
                    <div class="col-12">
                        <div class="section-header d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                            <h2 class="section-title text-dark fw-bold m-0 h4">Ward Councilors</h2>
                        </div>
                        <p class="text-dark small mb-4">
                            Blantyre District Council has a total of 14 Ward Councilors:
                        </p>
                        <div class="row g-4">
                            <?php foreach ($wardOfficials as $official): ?>
                                <?php $renderOfficial($official, 'fas fa-map-marker-alt'); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 3. Other Officials Section -->
            <?php if (!empty($otherOfficials)): ?>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="section-header d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                            <h2 class="section-title text-dark fw-bold m-0 h4">Other Officials</h2>
                        </div>
                        <div class="row g-4">
                            <?php foreach ($otherOfficials as $official): ?>
                                <?php $renderOfficial($official, 'fas fa-landmark'); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</section>
 
<!-- Profile Modal -->
<div class="modal fade profile-modal" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg"
             style="
                background: linear-gradient(145deg, #f4f8fc, #dde6ef);
                border-radius: 1rem;
                overflow: hidden;
             ">

            <!-- Header -->
            <div class="modal-header border-0 pb-0"
                 style="background: transparent;">
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body text-center pt-0 px-4 pb-4">

                <!-- Profile Image -->
                <div class="modal-profile-image mb-3 mx-auto">
                    <img src=""
                         alt=""
                         id="modalProfileImage"
                         class="rounded-circle shadow"
                         style="
                            width: 140px;
                            height: 140px;
                            object-fit: cover;
                            border: 5px solid #ffffff;
                            background: #fff;
                         ">
                </div>

                <!-- Name -->
                <h3 class="modal-profile-name fw-bold h4 mb-1 text-dark"
                    id="modalProfileName">
                </h3>

                <!-- Title -->
                <p class="modal-profile-title text-uppercase fw-semibold small mb-3"
                   id="modalProfileTitle"
                   style="
                        color: #1e4fa8;
                        letter-spacing: 1px;
                   ">
                </p>

                <!-- Bio -->
                <p class="modal-profile-bio small mb-4"
                   id="modalProfileBio"
                   style="
                        line-height: 1.7;
                        color: #4b5563;
                   ">
                </p>

                <!-- Contact Buttons -->
                <div class="modal-profile-contact d-flex gap-2 justify-content-center flex-wrap">

                    <a href=""
                       id="modalProfileEmail"
                       class="btn btn-sm px-4 text-white border-0 shadow-sm"
                       style="
                            background: linear-gradient(135deg, #0a2540, #1e4fa8);
                            border-radius: 50px;
                       ">
                        <i class="fas fa-envelope me-1"></i> Email
                    </a>

                    <a href=""
                       id="modalProfilePhone"
                       class="btn btn-sm px-4 shadow-sm"
                       style="
                            background: #ffffff;
                            color: #0a2540;
                            border: 1px solid #cbd5e1;
                            border-radius: 50px;
                       ">
                        <i class="fas fa-phone me-1"></i> Call
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
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
<?= $this->endSection()?>