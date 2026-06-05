  <!-- ======= Premium Command Bar ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="d-flex align-items-center">
          <a href="<?= base_url('/'); ?>" class="text-decoration-none me-4">
            <img src="<?= base_url('image/new_logo.png'); ?>" alt="Blantyre DC Logo" style="height: 50px; width: auto;">
          </a>
          
          <!-- Language Switcher -->
          <div class="language-switcher dropdown">
            <button class="language-toggle" id="languageToggle">
              <i data-lucide="globe" class="me-1"></i>
              <span id="currentLang">EN</span>
              <i data-lucide="chevron-down" class="ms-1"></i>
            </button>
            <ul class="language-menu" id="languageMenu">
              <li><a href="#" data-lang="en" class="language-option active">
                <span class="flag"></span> English
              </a></li>
              <li><a href="#" data-lang="ny" class="language-option">
                <span class="flag"></span> Chichewa
              </a></li>
              <li><a href="#" data-lang="tum" class="language-option">
                <span class="flag"></span> Tumbuka
              </a></li>
            </ul>
          </div>
          
          <!-- District Status (Desktop Only) -->
          <div class="d-none d-lg-flex align-items-center border-start border-secondary ps-4 ms-2 opacity-75">
              <div class="me-3 small text-white-50">
                  <i class="fas fa-cloud-sun text-warning me-1"></i> 24°C
              </div>
              <div class="small text-white-50">
                  <i class="fas fa-clock text-info me-1"></i> <span id="district-time">--:--</span>
              </div>
          </div>
      </div>

      <nav id="navbar" class="navbar">
        <ul class="nav-menu">
          <li><a class="nav-link active" href="<?= base_url('/'); ?>">Overview</a></li>
          
          <li class="dropdown"><a href="#"><span>Council</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
               <li><a href="<?= base_url('officials'); ?>">Elected Officials</a></li>
              <li><a href="<?= base_url('management'); ?>">Management</a></li>
            </ul>
          </li>

          <li class="dropdown"><a href="#" ><span>Services</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= base_url('services'); ?>" >All services</a></li>
              <li class="dropdown"><a href="#"><span>Online Applications</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                                    <li><a href="<?= base_url('marriage-certificates'); ?>">Marriage Certificate</a></li>
                  <li><a href="<?= base_url('birth-certificate'); ?>">Birth & Death Certificate</a></li>
                   <li><a href="<?= base_url('business-license'); ?>">Business License</a></li>
                  <li><a href="<?= base_url('firearm'); ?>">Firearm License</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span> Directorates</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="<?= base_url('directorate-of-administration'); ?>">Administrative Services</a></li>
                  <li><a href="<?= base_url('directorate-of-financial-services'); ?>">Financial Services</a></li>
                  <li><a href="<?= base_url('directorate-of-planning-development'); ?>">Planning & Development</a></li>
                  <li><a href="<?= base_url('directorate-of-health'); ?>">Health Services</a></li>
                  <li><a href="<?= base_url('directorate-of-agriculture'); ?>">Agriculture</a></li>
                  <li><a href="<?= base_url('directorate-of-education'); ?>">Education</a></li>
                  <li><a href="<?= base_url('directorate-of-public-works'); ?>">Public Works</a></li>
                                     
                </ul>
              </li>
               <li><a href="<?= base_url('deceased-estates'); ?>">Legal Services</a></li>
            </ul>
          </li>
           <li><a class="nav-link" href="<?= base_url('news'); ?>">News</a></li> 
          <li><a class="nav-link" href="<?= base_url('projects'); ?>">Projects</a></li>
          <li><a class="nav-link" href="<?= base_url('tenders'); ?>">Tenders</a></li>
         
        </ul>
        <button class="mobile-nav-toggle" aria-label="Toggle navigation menu">
          <div class="burger-icon">
            <span class="burger-line"></span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
          </div>
        </button>
      </nav>

      <!-- REPORT Button - Desktop Only -->
      <a href="<?= base_url('complaint-reporting'); ?>" class="btn btn-sm btn-danger rounded-1 px-3 fw-bold ms-3 d-none d-lg-flex align-items-center" 
         style="font-size: 0.75rem; letter-spacing: 1px; height: 36px;">
         <i class="fas fa-exclamation-triangle me-1"></i> REPORT
      </a>

    </div>
  </header>
  
  <script>
      // Simple Time Script for Navbar
      function updateTime() {
          const now = new Date();
          document.getElementById('district-time').innerText = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
      }
      setInterval(updateTime, 1000);
      updateTime();

      // Language Switcher Functionality
      const languageToggle = document.getElementById('languageToggle');
      const languageMenu = document.getElementById('languageMenu');
      const currentLangSpan = document.getElementById('currentLang');
      
      // Toggle language menu
      languageToggle.addEventListener('click', function(e) {
          e.stopPropagation();
          languageMenu.style.display = languageMenu.style.display === 'block' ? 'none' : 'block';
      });

      // Handle language selection
      const languageOptions = document.querySelectorAll('.language-option');
      const languages = {
          'en': { name: 'English', code: 'EN' },
          'ny': { name: 'Chichewa', code: 'NY' },
          'tum': { name: 'Tumbuka', code: 'TUM' }
      };

      languageOptions.forEach(option => {
          option.addEventListener('click', function(e) {
              e.preventDefault();
              const langCode = this.getAttribute('data-lang');
              const langData = languages[langCode];
              
              // Update current language display
              currentLangSpan.textContent = langData.code;
              
              // Update active state
              document.querySelectorAll('.language-option').forEach(opt => opt.classList.remove('active'));
              this.classList.add('active');
              
              // Close menu
              languageMenu.style.display = 'none';
              
              // Store language preference
              localStorage.setItem('preferredLanguage', langCode);
              
              // Here you would typically reload the page or update content
              // For demo purposes, we'll just show an alert
              console.log(`Language changed to: ${langData.name} (${langData.code})`);
              
              // In a real implementation, you would:
              // 1. Reload page with language parameter: window.location.href = `?lang=${langCode}`;
              // 2. Or make AJAX call to load translated content
              // 3. Or update DOM elements with translations
          });
      });

      // Close menu when clicking outside
      document.addEventListener('click', function() {
          languageMenu.style.display = 'none';
      });

      // Load saved language preference
      const savedLang = localStorage.getItem('preferredLanguage');
      if (savedLang && languages[savedLang]) {
          currentLangSpan.textContent = languages[savedLang].code;
          document.querySelectorAll('.language-option').forEach(opt => opt.classList.remove('active'));
          document.querySelector(`[data-lang="${savedLang}"]`).classList.add('active');
      }
  </script>
