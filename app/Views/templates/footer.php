    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src=" https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
   

    <!-- Modern Animation Stack -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="<?= base_url('js/animations.js'); ?>"></script>

    <script src="<?= base_url('js/owl.carousel.min.js'); ?>"          type="text/javascript"></script>
    <script src="<?= base_url('js/main.js'); ?>"                      type="text/javascript"></script>
    <script src="<?= base_url('js/language.js'); ?>"                  type="text/javascript"></script>
    
    <!-- Simple Mobile Navigation -->
    <script>
    (function() {
        function initMobileNav() {
            const toggle = document.querySelector('.mobile-nav-toggle');
            if (!toggle) return;
            
            // Create menu if not exists
            let menu = document.querySelector('.mobile-nav-menu');
            let overlay = document.querySelector('.mobile-nav-overlay');
            
            if (!menu) {
                menu = document.createElement('div');
                menu.className = 'mobile-nav-menu';
                menu.innerHTML = `
                    <div class="mobile-nav-header">
                        <h3 class="mobile-nav-title">Menu</h3>
                        <button class="mobile-nav-close" aria-label="Close menu">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mobile-nav-content">
                        <div class="mobile-nav-section">
                            <div class="mobile-nav-section-title">Main</div>
                            <ul class="mobile-nav-links">
                                <li><a href="<?= base_url('/'); ?>"><i class="fas fa-home"></i> Overview</a></li>
                                <li><a href="<?= base_url('projects'); ?>"><i class="fas fa-project-diagram"></i> Projects</a></li>
                                <li><a href="<?= base_url('tenders'); ?>"><i class="fas fa-file-alt"></i> Tenders</a></li>
                            </ul>
                        </div>
                        <div class="mobile-nav-section">
                            <div class="mobile-nav-section-title">Services</div>
                            <ul class="mobile-nav-links">
                                <li><a href="<?= base_url('marriage-certificates'); ?>"><i class="fas fa-ring"></i> Marriage Certificate</a></li>
                                <li><a href="<?= base_url('birth-certificate'); ?>"><i class="fas fa-baby"></i> Birth Certificate</a></li>
                                <li><a href="<?= base_url('death-certificate'); ?>"><i class="fas fa-heart-broken"></i> Death Certificate</a></li>
                                <li><a href="<?= base_url('business-license'); ?>"><i class="fas fa-briefcase"></i> Business License</a></li>
                                <li><a href="<?= base_url('property-rates'); ?>"><i class="fas fa-home"></i> Property Rates</a></li>
                            </ul>
                        </div>
                        <div class="mobile-nav-section">
                            <div class="mobile-nav-section-title">Quick Actions</div>
                            <a href="<?= base_url('complaint-reporting'); ?>" class="mobile-report-btn" style="
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                background: #dc3545;
                                color: white;
                                padding: 1rem;
                                border-radius: 8px;
                                text-decoration: none;
                                font-weight: 600;
                                text-transform: uppercase;
                                letter-spacing: 1px;
                                gap: 0.5rem;
                                margin-top: 0.5rem;
                            ">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>REPORT ISSUE</span>
                            </a>
                        </div>
                    </div>
                `;
                document.body.appendChild(menu);
                
                // Close button
                menu.querySelector('.mobile-nav-close').addEventListener('click', closeMenu);
            }
            
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'mobile-nav-overlay';
                document.body.appendChild(overlay);
                overlay.addEventListener('click', closeMenu);
            }
            
            let isOpen = false;
            
            function openMenu() {
                isOpen = true;
                toggle.classList.add('active');
                menu.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            
            function closeMenu() {
                isOpen = false;
                toggle.classList.remove('active');
                menu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
            
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (isOpen) closeMenu();
                else openMenu();
            });
            
            // Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isOpen) closeMenu();
            });
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileNav);
        } else {
            initMobileNav();
        }
    })();
    </script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            // tables
            // $('#example').DataTable();
            // data tables
        });
    </script>   
 



</body>
</html>
