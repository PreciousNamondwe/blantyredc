<?= $this->extend('templates/layout.php') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- News Collection -->
<section class="bg-light py-5 overlap-container">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
               <h2 class="text-dark fw-bold mb-3">Blantyre District News</h2>
                <p class="text-secondary mt-2 max-w-2xl mx-auto">Stay informed with official press releases, ongoing district developments, and civic announcements published by the local council administration.</p>
            </div>
        </div>

        <?php if (empty($newsArticles)): ?>
            <!-- Empty State Layout -->
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center py-5">
                    <div class="bg-white rounded-lg shadow-sm p-5 border">
                        <div class="text-muted mb-3">
                            <i class="fas fa-newspaper fa-3x text-light-muted"></i>
                        </div>
                        <h4 class="text-dark font-weight-bold mb-2">No News Articles Found</h4>
                        <p class="text-secondary small mb-0">There are currently no active announcements or news items published for this region. Please check back later for updates.</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- News Grid -->
            <div class="news-grid">
                <?php foreach ($newsArticles as $article): ?>
                    <?php
                        $images = [];
                        if (!empty($article['featured_image'])) {
                            $decoded = json_decode($article['featured_image'], true);
                            if (is_array($decoded)) {
                                $images = $decoded;
                            } else {
                                $images = [$article['featured_image']];
                            }
                        }
                        if (empty($images)) {
                            $images = ['image/news_placeholder.jpg'];
                        }
                    ?>
                    <div class="news-card" data-article-title="<?= esc($article['title'], 'attr') ?>">
                        <div class="news-card-image position-relative overflow-hidden">
                            <?php foreach ($images as $index => $imagePath): ?>
                                <img src="<?= base_url($imagePath) ?>"
                                     alt="<?= esc($article['title']) ?>"
                                     class="news-card-img slide-image <?= $index === 0 ? 'active' : '' ?>">
                            <?php endforeach; ?>
                            <div class="news-card-image-overlay"></div>
                            <span class="news-card-tag"><i class="fas fa-bullhorn me-1"></i> Official Notice</span>
                        </div>
                        <div class="news-card-body">
                            <div class="news-card-meta">
                                <span class="news-meta-date">
                                    <i class="far fa-calendar-alt me-1"></i> 
                                    <?= $article['published_at'] ? date('M j, Y', strtotime($article['published_at'])) : 'Draft Status' ?>
                                </span>
                            </div>
                            <h3 class="news-card-title"><?= esc($article['title']) ?></h3>
                            
                            <?php if (!empty($article['excerpt'])): ?>
                                <p class="news-card-excerpt"><?= esc($article['excerpt']) ?></p>
                            <?php endif; ?>
                            
                            <button type="button" class="btn text-primary p-0 fw-bold d-flex align-items-center mt-auto news-more-button" style="text-decoration: none; box-shadow: none;">
                                Read Full Article <i class="bi bi-arrow-right ms-2 transition-icon" style="font-size: 16px;"></i>
                            </button>
                            
                            <div class="news-card-full-content d-none">
                                <?= nl2br(esc($article['content'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

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
    /* Professional Clean News Grid Infrastructure */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
    }
    .news-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        min-height: 480px;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
    }
    .news-card-image {
        position: relative;
        height: 220px;
        background-color: #f1f5f9;
    }
    .slide-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.8s ease, transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .slide-image.active {
        opacity: 1;
    }
    .news-card:hover .slide-image.active {
        transform: scale(1.03);
    }
    .news-card-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 60%, rgba(0, 0, 0, 0.4) 100%);
    }
    .news-card-tag {
        position: absolute;
        left: 1rem;
        top: 1rem;
        padding: 0.35rem 0.75rem;
        background: #0f172a; /* Dark institutional slate tag */
        color: #fff;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        border-radius: 4px;
        z-index: 2;
    }
    .news-card-body {
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
        flex: 1;
    }
    .news-card-meta {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        font-size: 0.85rem;
        color: #64748b;
    }
    .news-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 0.75rem;
        color: #1e293b;
        /* Dynamic multi-line clamp to avoid broken card heights */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 3.5rem;
    }
    .news-card-excerpt {
        margin-bottom: 1.5rem;
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-more-button:hover .transition-icon {
        transform: translateX(4px);
    }
    .text-light-muted {
        color: #cbd5e1;
    }

    /* Modal Styling Refinements */
    .news-modal {
        position: fixed;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1100;
        padding: 1.5rem;
    }
    .news-modal.hidden {
        display: none;
    }
    .news-modal-content {
        width: min(800px, 100%);
        max-height: 85vh;
        overflow-y: auto;
        background: #ffffff;
        border-radius: 12px;
        padding: 2.5rem;
        position: relative;
        border: 1px solid #e2e8f0;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .news-modal-close {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        background: #f1f5f9;
        border: none;
        color: #475569;
        font-size: 1.5rem;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
    }
    .news-modal-close:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .news-modal-header {
        margin-bottom: 1.25rem;
        padding-right: 2rem;
    }
    .news-modal-title {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.3;
        color: #0f172a;
        margin: 0;
    }
    .news-modal-image {
        position: relative;
        height: 360px;
        width: 100%;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        background-color: #f1f5f9;
    }
    .news-modal-body {
        color: #334155;
        font-size: 1.05rem;
        line-height: 1.75;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById('news-modal');
        var modalTitle = document.getElementById('news-modal-title');
        var modalSlides = document.getElementById('news-modal-slides');
        var modalBody = document.getElementById('news-modal-body');
        var modalClose = document.getElementById('news-modal-close');
        var modalSlideInterval = null;

        document.querySelectorAll('.news-more-button').forEach(function (button) {
            button.addEventListener('click', function () {
                var card = button.closest('.news-card');
                var title = card.dataset.articleTitle;
                var content = card.querySelector('.news-card-full-content').innerHTML;
                var slides = card.querySelectorAll('.slide-image');

                modalTitle.textContent = title;
                modalBody.innerHTML = content;
                modalSlides.innerHTML = '';

                slides.forEach(function (slide, index) {
                    var clone = slide.cloneNode();
                    clone.classList.remove('active');
                    if (index === 0) {
                        clone.classList.add('active');
                    }
                    modalSlides.appendChild(clone);
                });

                if (modalSlideInterval) {
                    clearInterval(modalSlideInterval);
                }
                if (modalSlides.children.length > 1) {
                    var activeIndex = 0;
                    modalSlideInterval = setInterval(function () {
                        var modalImages = modalSlides.querySelectorAll('.slide-image');
                        modalImages[activeIndex].classList.remove('active');
                        activeIndex = (activeIndex + 1) % modalImages.length;
                        modalImages[activeIndex].classList.add('active');
                    }, 6000);
                }

                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Lock background scrolling
            });
        });

        function closeModal() {
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Release background scrolling
            }
            if (modalSlideInterval) {
                clearInterval(modalSlideInterval);
                modalSlideInterval = null;
            }
        }

        modalClose.addEventListener('click', closeModal);
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Loop background carousel on individual timeline cards safely
        document.querySelectorAll('.news-card').forEach(function (card) {
            var slides = card.querySelectorAll('.slide-image');
            if (slides.length <= 1) {
                return;
            }

            var activeIndex = 0;
            setInterval(function () {
                slides[activeIndex].classList.remove('active');
                activeIndex = (activeIndex + 1) % slides.length;
                slides[activeIndex].classList.add('active');
            }, 6000);
        });
    });
</script>

<?= $this->endSection() ?>