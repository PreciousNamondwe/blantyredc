<?= $this->extend('templates/layout.php') ?>

<?= $this->section('content') ?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Services Hero Section -->

<!-- Services Categories -->
<section id="services-categories" class="py-5">
    <div class="container">
        <div class="categories-tabs">
            <button class="category-tab active" data-category="all">
                <i class="fas fa-th-large"></i>
                All Services
            </button>
            <button class="category-tab" data-category="administrative">
                <i class="fas fa-building"></i>
                Administrative
            </button>
            <button class="category-tab" data-category="health">
                <i class="fas fa-heartbeat"></i>
                Health
            </button>
            <button class="category-tab" data-category="education">
                <i class="fas fa-graduation-cap"></i>
                Education
            </button>
            <button class="category-tab" data-category="infrastructure">
                <i class="fas fa-road"></i>
                Infrastructure
            </button>
            <button class="category-tab" data-category="social">
                <i class="fas fa-users"></i>
                Social Services
            </button>
            <button class="category-tab" data-category="business">
                <i class="fas fa-briefcase"></i>
                Business
            </button>
        </div>
    </div>
</section>

<!-- Services Content -->
<section id="services-content" class="py-5">
    <div class="container">
        <!-- Services Grid -->
        <div id="servicesGrid" class="services-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem;align-items:stretch;">
                  <div class="service-card" data-category="administrative">
                <div class="service-icon">
                    <i class="fas fa-file-contract"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Administrative</span>
                    <h3 class="service-title">Adminstarive Services</h3>
                    <p class="service-description">Register marriages, obtain marriage certificates, and related legal documentation.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Civil Marriage</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Customary Marriage</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Certificate</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-administration'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Adminstrative
                    </a>
                </div>
            </div>

            

            <!-- Health Services -->
            <div class="service-card" data-category="health">
                <div class="service-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Health</span>
                    <h3 class="service-title">Healthcare Services</h3>
                    <p class="service-description">Access public healthcare facilities, immunization programs, and health consultations.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Primary Care</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Immunization</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Maternal Health</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-health'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Find Health Center
                    </a>
                </div>
            </div>

        

            <!-- Education Services -->
            <div class="service-card" data-category="education">
                <div class="service-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Education</span>
                    <h3 class="service-title">Education Services</h3>
                    <p class="service-description">Public education services, school enrollment, and educational support programs.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> School Enrollment</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Scholarships</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> School Feeding</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-education'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Enroll Now
                    </a>
                </div>
            </div>

           
            <!-- Infrastructure Services -->
            <div class="service-card" data-category="infrastructure">
                <div class="service-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Infrastructure</span>
                    <h3 class="service-title">Infrastructure Services</h3>
                    <p class="service-description">Access clean water supply, sanitation services, and waste management.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Water Connection</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Sanitation</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Waste Collection</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-public-works'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Request Service
                    </a>
                </div>
            </div>


            <!-- Social Services -->
            <div class="service-card" data-category="social">
                <div class="service-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Social Services</span>
                    <h3 class="service-title">Social Welfare Support</h3>
                    <p class="service-description">Social protection programs, welfare assistance, and vulnerable population support.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Financial Assistance</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Food Support</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Counseling</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-health'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Apply for Support
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="social">
                <div class="service-icon">
                    <i class="fas fa-child"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Social Services</span>
                    <h3 class="service-title">Child Protection Services</h3>
                    <p class="service-description">Child welfare programs, protection services, and children's rights advocacy.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Child Protection</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Foster Care</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Adoption Services</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('complaint-reporting'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Get Help
                    </a>
                </div>
            </div>

            <!-- Business Services -->
            <div class="service-card" data-category="business">
                <div class="service-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Business</span>
                    <h3 class="service-title">Business Registration</h3>
                    <p class="service-description">Register new businesses, renew licenses, and obtain business permits.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Business Registration</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> License Renewal</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Trade Permits</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('business-license'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Register Business
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="business">
                <div class="service-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Business</span>
                    <h3 class="service-title">Market & Trading Services</h3>
                    <p class="service-description">Market stall allocation, trading licenses, and vendor registration services.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Market Stalls</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Trading License</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Vendor Registration</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('business-license'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Apply for Stall
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="business">
                <div class="service-icon">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Business</span>
                    <h3 class="service-title">Construction Permits</h3>
                    <p class="service-description">Building permits, construction approvals, and safety inspections.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Building Permits</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Safety Inspections</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Zoning Approval</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-planning-development'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Apply for Permit
                    </a>
                </div>
            </div>

            <!-- Additional Services -->
            <div class="service-card" data-category="administrative">
                <div class="service-icon">
                    <i class="fas fa-landmark"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Administrative</span>
                    <h3 class="service-title">Land & Property Services</h3>
                    <p class="service-description">Land registration, title deeds, and property transfer services.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Land Registration</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Title Deeds</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Property Transfer</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-planning-development'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Access Service
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="health">
                <div class="service-icon">
                    <i class="fas fa-virus"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Health</span>
                    <h3 class="service-title">Disease Control & Prevention</h3>
                    <p class="service-description">Public health programs, disease surveillance, and vaccination campaigns.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Vaccination</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Disease Surveillance</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Health Education</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-health'); ?>"class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Learn More
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="social">
                <div class="service-icon">
                    <i class="fas fa-wheelchair"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Social Services</span>
                    <h3 class="service-title">Disability Services</h3>
                    <p class="service-description">Support services for persons with disabilities, accessibility programs.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Disability Support</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Accessibility</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Assistive Devices</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-health'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Get Support
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="education">
                <div class="service-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Education</span>
                    <h3 class="service-title">Digital Learning & ICT</h3>
                    <p class="service-description">Computer training, digital literacy, and ICT infrastructure development.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Computer Training</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Digital Literacy</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Internet Access</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('directorate-of-education'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Join Program
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="infrastructure">
                <div class="service-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Infrastructure</span>
                    <h3 class="service-title">Connectivity & Utilities</h3>
                    <p class="service-description">Access internet services, telecommunication support, and community radio programs.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Internet Services</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Telecommunication</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Community Radio</span>
                    </div>
                </div>
                <div class="service-action text-end">
                    <a href="<?= base_url('property-rates'); ?>" class="btn btn-service btn-primary">
                        <i class="fas fa-arrow-right me-2"></i>
                        Pay Rates
                    </a>
                </div>
            </div>

            <div class="service-card" data-category="business">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="service-content">
                    <span class="service-category">Business</span>
                    <h3 class="service-title">Economic Development</h3>
                    <p class="service-description">Business development support, entrepreneurship programs, and economic initiatives.</p>
                    <div class="service-features">
                        <span class="feature-tag"><i class="fas fa-check"></i> Business Support</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Entrepreneurship</span>
                        <span class="feature-tag"><i class="fas fa-check"></i> Investment Promotion</span>
                    </div>
                </div>
                <div class="service-action">
                    <a href="<?= base_url('business-license'); ?>" class="btn btn-service">
                        <i class="fas fa-arrow-right"></i>
                        Grow Business
                    </a>
                </div>
            </div>
           
        <!-- No Results Message -->
        <div id="noServicesResults" class="no-results" style="display: none;">
            <i class="fas fa-search"></i>
            <h4>No services found</h4>
            <p>Try adjusting your search or filter criteria</p>
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
// Service category filtering
document.querySelectorAll('.category-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Update active state
        document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        const category = this.dataset.category;
        filterServices(category);
    });
});

// Service search functionality
document.getElementById('servicesSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    searchServices(searchTerm);
});

function filterServices(category) {
    const cards = document.querySelectorAll('.service-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const cardCategory = card.dataset.category;
        if (category === 'all' || cardCategory === category) {
            card.style.display = 'block';
            card.classList.add('fade-in');
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateNoResults(visibleCount);
}

function searchServices(searchTerm) {
    const cards = document.querySelectorAll('.service-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('.service-title').textContent.toLowerCase();
        const description = card.querySelector('.service-description').textContent.toLowerCase();
        const category = card.querySelector('.service-category').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm) || category.includes(searchTerm)) {
            card.style.display = 'block';
            card.classList.add('fade-in');
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateNoResults(visibleCount);
}

function updateNoResults(visibleCount) {
    const noResults = document.getElementById('noServicesResults');
    const grid = document.getElementById('servicesGrid');
    
    if (visibleCount === 0) {
        noResults.style.display = 'block';
        grid.style.display = 'none';
    } else {
        noResults.style.display = 'none';
        grid.style.display = 'grid';
    }
}
</script>

<?= $this->endSection() ?>
