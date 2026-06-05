$(function () {
  // "use strict";

  // Initialize Lucide icons
  lucide.createIcons();

  $(document).scroll(function () {
    var scroll = $(this).scrollTop();
    var topDist = $("body").position();
    if (scroll > topDist.top) {
        // $('#header').css({"position":"fixed","top":"0"});
        $("#header").addClass('fixed-top');
    } else {
        // $('#header').css({"position":"static","top":"auto"});
        $("#header").removeClass('fixed-top');
    }
});

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 16
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Header fixed top on scroll
   */
  let selectHeader = select('#header');
  if (selectHeader) {
    let headerOffset = selectHeader.offsetTop
    let nextElement = selectHeader.nextElementSibling
    const headerFixed = () => {
      if ((headerOffset - window.scrollY) <= 0) {
        selectHeader.classList.add('fixed-top')
        nextElement.classList.add('scrolled-offset')
      } else {
        selectHeader.classList.remove('fixed-top')
        nextElement.classList.remove('scrolled-offset')
      }
    }
    window.addEventListener('load', headerFixed)
    onscroll(document, headerFixed)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile');
    this.classList.toggle('bx-menu');
    this.classList.toggle('bx-x');
  });

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true);

  /**
   * AI Chatbot Functionality
   */
  const chatbotModal = select('#chatbotModal');
  const chatbotBubble = select('#chatbotBubble');
  const closeChatbot = select('#closeChatbot');
  const chatInput = select('#chatInput');
  const sendMessage = select('#sendMessage');
  const chatMessages = select('#chatMessages');
  const greetingMessage = select('#greetingMessage');

  // Show greeting message for 10 seconds on page load
  setTimeout(() => {
    if (greetingMessage) {
      greetingMessage.classList.add('show');
    }
  }, 2000); // Show after 2 seconds

  // Hide greeting message after 10 seconds
  setTimeout(() => {
    if (greetingMessage) {
      greetingMessage.classList.remove('show');
    }
  }, 12000); // Hide after 12 seconds (2s delay + 10s display)

  // Open chatbot modal
  if (chatbotBubble) {
    chatbotBubble.addEventListener('click', () => {
      chatbotModal.classList.add('active');
      if (greetingMessage) {
        greetingMessage.classList.remove('show');
      }
      chatInput.focus();
    });
  }

  // Close chatbot modal
  if (closeChatbot) {
    closeChatbot.addEventListener('click', () => {
      chatbotModal.classList.remove('active');
    });
  }

  // Send message function
  const sendUserMessage = () => {
    const message = chatInput.value.trim();
    if (message) {
      // Add user message to chat
      const userMessageDiv = document.createElement('div');
      userMessageDiv.className = 'message user-message';
      userMessageDiv.innerHTML = `
        <div class="message-content">${message}</div>
        <div class="message-time">Just now</div>
      `;
      chatMessages.appendChild(userMessageDiv);

      // Clear input
      chatInput.value = '';

      // Scroll to bottom
      chatMessages.scrollTop = chatMessages.scrollHeight;

      // Simulate bot response
      setTimeout(() => {
        const botMessageDiv = document.createElement('div');
        botMessageDiv.className = 'message bot-message';
        botMessageDiv.innerHTML = `
          <div class="message-content">Thank you for your message! I'm processing your request and will provide assistance shortly.</div>
          <div class="message-time">Just now</div>
        `;
        chatMessages.appendChild(botMessageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }, 1000);
    }
  };

  // Send message on button click
  if (sendMessage) {
    sendMessage.addEventListener('click', sendUserMessage);
  }

  // Send message on Enter key
  if (chatInput) {
    chatInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        sendUserMessage();
      }
    });
  }

  // Close modal when clicking outside
  document.addEventListener('click', (e) => {
    if (chatbotModal && chatbotBubble && 
        chatbotModal.classList.contains('active') && 
        !chatbotModal.contains(e.target) && 
        !chatbotBubble.contains(e.target)) {
      chatbotModal.classList.remove('active');
    }
  });

  /**
   * Tourism Modal Functionality
   */
  const tourismModal = select('#tourismModal');
  const tourismModalImage = select('#tourismModalImage');
  const tourismModalTitle = select('#tourismModalTitle');
  const tourismModalDescription = select('#tourismModalDescription');

  // Open tourism modal
  window.openTourismModal = (imageUrl, title, description) => {
    tourismModalImage.src = imageUrl;
    tourismModalTitle.textContent = title;
    tourismModalDescription.textContent = description;
    tourismModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  // Close tourism modal
  window.closeTourismModal = () => {
    tourismModal.classList.remove('active');
    document.body.style.overflow = 'auto';
  };

  // Close modal on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      if (tourismModal && tourismModal.classList.contains('active')) {
        closeTourismModal();
      }
      if (chatbotModal && chatbotModal.classList.contains('active')) {
        chatbotModal.classList.remove('active');
      }
    }
  });

  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

// tables
$('#downloads').DataTable({
  "scrollX": true
});
// data tables
  
}); 

// Custom Dropdown Functionality
class CustomDropdown {
    constructor(element) {
        this.element = element;
        this.toggle = element.querySelector('.custom-dropdown-toggle');
        this.menu = element.querySelector('.custom-dropdown-menu');
        this.items = element.querySelectorAll('.custom-dropdown-item');
        this.searchInput = element.querySelector('.custom-dropdown-search input');
        this.isOpen = false;
        this.selectedValue = '';
        this.selectedText = '';
        
        this.init();
    }
    
    init() {
        // Toggle dropdown
        this.toggle.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleDropdown();
        });
        
        // Item selection
        this.items.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                this.selectItem(item);
            });
        });
        
        // Search functionality
        if (this.searchInput) {
            this.searchInput.addEventListener('input', (e) => {
                this.filterItems(e.target.value);
            });
        }
        
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!this.element.contains(e.target)) {
                this.close();
            }
        });
        
        // Keyboard navigation
        this.element.addEventListener('keydown', (e) => {
            this.handleKeyboard(e);
        });
        
        // Set initial selection
        const selectedItem = this.element.querySelector('.custom-dropdown-item.selected');
        if (selectedItem) {
            this.selectedValue = selectedItem.dataset.value || selectedItem.textContent;
            this.selectedText = selectedItem.textContent;
            this.updateToggle();
        }
    }
    
    toggleDropdown() {
        if (this.isOpen) {
            this.close();
        } else {
            this.open();
        }
    }
    
    open() {
        this.isOpen = true;
        this.toggle.classList.add('active');
        this.menu.classList.add('show');
        
        // Focus search input if available
        if (this.searchInput) {
            setTimeout(() => this.searchInput.focus(), 100);
        }
    }
    
    close() {
        this.isOpen = false;
        this.toggle.classList.remove('active');
        this.menu.classList.remove('show');
    }
    
    selectItem(item) {
        // Remove previous selection
        this.items.forEach(i => i.classList.remove('selected'));
        
        // Add selection to clicked item
        item.classList.add('selected');
        
        // Update values
        this.selectedValue = item.dataset.value || item.textContent;
        this.selectedText = item.textContent;
        
        // Update toggle display
        this.updateToggle();
        
        // Close dropdown
        this.close();
        
        // Trigger change event
        this.triggerChange();
    }
    
    updateToggle() {
        this.toggle.textContent = this.selectedText || 'Select an option';
    }
    
    filterItems(searchTerm) {
        const term = searchTerm.toLowerCase();
        let visibleCount = 0;
        
        this.items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(term)) {
                item.style.display = 'flex';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        let noResults = this.element.querySelector('.no-results');
        if (visibleCount === 0) {
            if (!noResults) {
                noResults = document.createElement('div');
                noResults.className = 'no-results';
                noResults.textContent = 'No results found';
                this.menu.appendChild(noResults);
            }
        } else if (noResults) {
            noResults.remove();
        }
    }
    
    handleKeyboard(e) {
        if (!this.isOpen) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.open();
            }
            return;
        }
        
        const items = Array.from(this.items).filter(item => item.style.display !== 'none');
        const currentIndex = items.findIndex(item => item.classList.contains('selected'));
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                const nextIndex = (currentIndex + 1) % items.length;
                this.highlightItem(items[nextIndex]);
                break;
                
            case 'ArrowUp':
                e.preventDefault();
                const prevIndex = currentIndex === -1 ? items.length - 1 : (currentIndex - 1 + items.length) % items.length;
                this.highlightItem(items[prevIndex]);
                break;
                
            case 'Enter':
                e.preventDefault();
                if (currentIndex >= 0) {
                    this.selectItem(items[currentIndex]);
                }
                break;
                
            case 'Escape':
                e.preventDefault();
                this.close();
                break;
        }
    }
    
    highlightItem(item) {
        this.items.forEach(i => i.classList.remove('selected'));
        item.classList.add('selected');
        
        // Scroll into view if needed
        item.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }
    
    triggerChange() {
        const event = new CustomEvent('change', {
            detail: {
                value: this.selectedValue,
                text: this.selectedText
            },
            bubbles: true
        });
        this.element.dispatchEvent(event);
    }
    
    getValue() {
        return this.selectedValue;
    }
    
    getText() {
        return this.selectedText;
    }
    
    setValue(value) {
        const item = this.element.querySelector(`[data-value="${value}"]`);
        if (item) {
            this.selectItem(item);
        }
    }
    
    setDisabled(disabled) {
        if (disabled) {
            this.element.classList.add('disabled');
            this.toggle.setAttribute('disabled', 'disabled');
        } else {
            this.element.classList.remove('disabled');
            this.toggle.removeAttribute('disabled');
        }
    }
}

// Initialize all custom dropdowns
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.custom-dropdown');
    dropdowns.forEach(dropdown => {
        new CustomDropdown(dropdown);
    });
});

// Helper function to create custom dropdown from select element
function createCustomDropdown(selectElement) {
    const wrapper = document.createElement('div');
    wrapper.className = 'custom-dropdown';
    
    // Create toggle
    const toggle = document.createElement('button');
    toggle.className = 'custom-dropdown-toggle';
    toggle.type = 'button';
    toggle.textContent = selectElement.options[0]?.text || 'Select an option';
    
    // Create menu
    const menu = document.createElement('div');
    menu.className = 'custom-dropdown-menu';
    
    // Add items
    Array.from(selectElement.options).forEach(option => {
        const item = document.createElement('div');
        item.className = 'custom-dropdown-item';
        item.textContent = option.text;
        item.dataset.value = option.value;
        
        if (option.selected) {
            item.classList.add('selected');
        }
        
        menu.appendChild(item);
    });
    
    // Create hidden input to preserve form submission
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = selectElement.name;
    hiddenInput.value = selectElement.value;
    
    wrapper.appendChild(toggle);
    wrapper.appendChild(menu);
    wrapper.appendChild(hiddenInput);
    
    // Replace select with custom dropdown
    selectElement.parentNode.replaceChild(wrapper, selectElement);
    
    // Initialize custom dropdown with hidden input reference
    const dropdown = new CustomDropdown(wrapper);
    dropdown.hiddenInput = hiddenInput;
    
    // Override selectItem to update hidden input
    const originalSelectItem = dropdown.selectItem.bind(dropdown);
    dropdown.selectItem = function(item) {
        originalSelectItem(item);
        if (this.hiddenInput) {
            this.hiddenInput.value = this.selectedValue;
        }
    };
    
    return dropdown;
}

// Auto-convert select elements with data-custom-dropdown attribute
function initializeCustomDropdowns() {
    console.log('Initializing custom dropdowns...');
    const selectElements = document.querySelectorAll('select[data-custom-dropdown]');
    console.log('Found select elements:', selectElements.length);
    
    selectElements.forEach((select, index) => {
        console.log(`Converting select ${index + 1}:`, select.name);
        try {
            createCustomDropdown(select);
            console.log(`Successfully converted select ${index + 1}`);
        } catch (error) {
            console.error(`Error converting select ${index + 1}:`, error);
        }
    });
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing custom dropdowns...');
    initializeCustomDropdowns();
});

// Also initialize after window loads to ensure all elements are ready
window.addEventListener('load', function() {
    console.log('Window loaded, re-initializing custom dropdowns...');
    setTimeout(initializeCustomDropdowns, 500);
});

// Also initialize after any dynamic content loads
if (window.jQuery) {
    $(document).ajaxComplete(function() {
        console.log('Ajax complete, re-initializing custom dropdowns...');
        setTimeout(initializeCustomDropdowns, 100);
    });
}

// Manual initialization function for testing
window.initCustomDropdowns = initializeCustomDropdowns;

// Mobile Navigation Functionality
class MobileNavigation {
    constructor() {
        this.toggle = null;
        this.menu = null;
        this.overlay = null;
        this.isOpen = false;
        
        this.init();
    }
    
    init() {
        // Create mobile navigation elements if they don't exist
        this.createMobileNav();
        
        // Get elements
        this.toggle = document.querySelector('.mobile-nav-toggle');
        this.menu = document.querySelector('.mobile-nav-menu');
        this.overlay = document.querySelector('.mobile-nav-overlay');
        
        if (!this.toggle || !this.menu) return;
        
        // Event listeners
        this.toggle.addEventListener('click', () => this.toggleMenu());
        this.overlay.addEventListener('click', () => this.closeMenu());
        
        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeMenu();
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992 && this.isOpen) {
                this.closeMenu();
            }
        });
    }
    
    createMobileNav() {
        // Check if mobile nav menu already exists
        if (document.querySelector('.mobile-nav-menu')) return;
        
        // Get desktop navigation links
        const desktopNav = document.querySelector('.navbar-nav, .nav-menu');
        if (!desktopNav) return;
        
        // Check if toggle exists, if not create it
        let mobileToggle = document.querySelector('.mobile-nav-toggle');
        if (!mobileToggle) {
            // Create mobile navigation toggle
            mobileToggle = document.createElement('button');
            mobileToggle.className = 'mobile-nav-toggle';
            mobileToggle.setAttribute('aria-label', 'Toggle navigation menu');
            mobileToggle.innerHTML = `
                <div class="burger-icon">
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </div>
            `;
            document.body.appendChild(mobileToggle);
        } else {
            // Make sure existing toggle is a button and has proper styling
            if (mobileToggle.tagName !== 'BUTTON') {
                const newToggle = document.createElement('button');
                newToggle.className = mobileToggle.className;
                newToggle.innerHTML = `
                    <div class="burger-icon">
                        <span class="burger-line"></span>
                        <span class="burger-line"></span>
                        <span class="burger-line"></span>
                    </div>
                `;
                mobileToggle.parentNode.replaceChild(newToggle, mobileToggle);
                mobileToggle = newToggle;
            }
        }
        
        // Create mobile navigation menu
        const mobileMenu = document.createElement('div');
        mobileMenu.className = 'mobile-nav-menu';
        
        // Extract navigation links
        const navLinks = this.extractNavLinks(desktopNav);
        
        mobileMenu.innerHTML = `
            <div class="mobile-nav-header">
                <h3 class="mobile-nav-title">Menu</h3>
                <button class="mobile-nav-close" aria-label="Close menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mobile-nav-content">
                ${navLinks}
            </div>
        `;
        
        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'mobile-nav-overlay';
        
        // Add to page
        document.body.appendChild(mobileMenu);
        document.body.appendChild(overlay);
        
        // Add close functionality to close button
        const closeBtn = mobileMenu.querySelector('.mobile-nav-close');
        closeBtn.addEventListener('click', () => this.closeMenu());
    }
    
    extractNavLinks(desktopNav) {
        const links = Array.from(desktopNav.querySelectorAll('a'));
        const sections = {
            main: [],
            services: [],
            about: []
        };
        
        links.forEach(link => {
            const text = link.textContent.trim();
            const href = link.getAttribute('href');
            const icon = link.querySelector('i')?.className || 'fas fa-chevron-right';
            
            // Categorize links
            if (text.includes('Home') || text.includes('Services') || text.includes('About')) {
                sections.main.push({ text, href, icon });
            } else if (text.includes('License') || text.includes('Rates') || text.includes('Certificate')) {
                sections.services.push({ text, href, icon });
            } else {
                sections.about.push({ text, href, icon });
            }
        });
        
        let html = '';
        
        // Main Navigation
        if (sections.main.length > 0) {
            html += `
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-title">Main</div>
                    <ul class="mobile-nav-links">
                        ${sections.main.map(link => `
                            <li>
                                <a href="${link.href}">
                                    <i class="${link.icon}"></i>
                                    ${link.text}
                                </a>
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `;
        }
        
        // Services
        if (sections.services.length > 0) {
            html += `
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-title">Services</div>
                    <ul class="mobile-nav-links">
                        ${sections.services.map(link => `
                            <li>
                                <a href="${link.href}">
                                    <i class="${link.icon}"></i>
                                    ${link.text}
                                </a>
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `;
        }
        
        // About & Other
        if (sections.about.length > 0) {
            html += `
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-title">About</div>
                    <ul class="mobile-nav-links">
                        ${sections.about.map(link => `
                            <li>
                                <a href="${link.href}">
                                    <i class="${link.icon}"></i>
                                    ${link.text}
                                </a>
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `;
        }
        
        // Add language switcher
        html += `
            <div class="mobile-nav-section">
                <div class="mobile-nav-section-title">Language</div>
                <div class="mobile-language-switcher">
                    <button class="mobile-language-btn" data-lang="en">English</button>
                    <button class="mobile-language-btn" data-lang="ny">Chichewa</button>
                    <button class="mobile-language-btn" data-lang="tum">Tumbuka</button>
                </div>
            </div>
        `;
        
        // Add Report Button section
        html += `
            <div class="mobile-nav-section">
                <div class="mobile-nav-section-title">Quick Actions</div>
                <a href="${window.baseUrl || ''}complaint-reporting" class="mobile-report-btn" style="
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
                    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
                    transition: all 0.3s ease;
                ">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>REPORT ISSUE</span>
                </a>
            </div>
        `;
        
        return html;
    }
    
    toggleMenu() {
        if (this.isOpen) {
            this.closeMenu();
        } else {
            this.openMenu();
        }
    }
    
    openMenu() {
        this.isOpen = true;
        this.toggle.classList.add('active');
        this.menu.classList.add('active');
        this.overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    closeMenu() {
        this.isOpen = false;
        this.toggle.classList.remove('active');
        this.menu.classList.remove('active');
        this.overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Initialize mobile navigation
document.addEventListener('DOMContentLoaded', function() {
    new MobileNavigation();
    
    // Handle mobile language switching
    const mobileLangBtns = document.querySelectorAll('.mobile-language-btn');
    mobileLangBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const lang = this.dataset.lang;
            
            // Update active state
            mobileLangBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Trigger language change (assuming languageManager exists)
            if (window.languageManager) {
                window.languageManager.setLanguage(lang);
            }
            
            // Close mobile menu
            const mobileNav = document.querySelector('.mobile-nav-menu');
            const mobileToggle = document.querySelector('.mobile-nav-toggle');
            const overlay = document.querySelector('.mobile-nav-overlay');
            
            if (mobileNav) mobileNav.classList.remove('active');
            if (mobileToggle) mobileToggle.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
});

/**
 * Profile Modal Functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    const profileModal = document.getElementById('profileModal');
    
    if (profileModal) {
        const modalImage = document.getElementById('modalProfileImage');
        const modalName = document.getElementById('modalProfileName');
        const modalTitle = document.getElementById('modalProfileTitle');
        const modalBio = document.getElementById('modalProfileBio');
        const modalEmail = document.getElementById('modalProfileEmail');
        const modalPhone = document.getElementById('modalProfilePhone');
        
        // Get all clickable profile cards
        const profileCards = document.querySelectorAll('.profile-card[role="button"]');
        
        profileCards.forEach(card => {
            card.addEventListener('click', function() {
                // Extract data attributes
                const name = this.dataset.name;
                const title = this.dataset.title;
                const image = this.dataset.image;
                const email = this.dataset.email;
                const phone = this.dataset.phone;
                const bio = this.dataset.bio;
                
                // Populate modal
                if (modalImage) {
                    modalImage.src = image;
                    modalImage.alt = name;
                }
                if (modalName) modalName.textContent = name;
                if (modalTitle) modalTitle.textContent = title;
                if (modalBio) modalBio.textContent = bio || '';
                
                // Update contact links
                if (modalEmail) {
                    modalEmail.href = 'mailto:' + email;
                    modalEmail.style.display = email ? 'inline-block' : 'none';
                }
                if (modalPhone) {
                    modalPhone.href = 'tel:' + phone;
                    modalPhone.style.display = phone ? 'inline-block' : 'none';
                }
            });
        });
    }
}); 

/**
 * Hero Search Functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('heroSearchInput');
    const searchBtn = document.getElementById('heroSearchBtn');
    const searchResults = document.getElementById('heroSearchResults');
    
    if (!searchInput || !searchResults) return;
    
    let searchIndex = [];
    let searchIndexLoaded = false;
    let searchTimeout = null;
    let lastResults = [];
    
    fetch(`${window.baseUrl || '/'}site-search-index`)
        .then(response => response.ok ? response.json() : [])
        .then(items => {
            searchIndex = Array.isArray(items) ? items : [];
            searchIndexLoaded = true;
        })
        .catch(() => {
            searchIndex = [];
            searchIndexLoaded = true;
        });
    
    function performSearch(query) {
        if (!query || query.length < 2) {
            searchResults.classList.remove('active');
            searchResults.innerHTML = '';
            lastResults = [];
            return;
        }

        if (!searchIndexLoaded) {
            searchResults.innerHTML = `
                <div class="search-no-results">
                    <i data-lucide="loader"></i>
                    <p>Loading search...</p>
                </div>
            `;
            searchResults.classList.add('active');
            if (window.lucide) window.lucide.createIcons();
            setTimeout(() => performSearch(query), 150);
            return;
        }
        
        const lowerQuery = query.toLowerCase();
        const terms = lowerQuery.split(/\s+/).filter(Boolean);
        
        lastResults = searchIndex
            .map(item => {
                const title = String(item.title || '').toLowerCase();
                const description = String(item.description || '').toLowerCase();
                const category = String(item.category || '').toLowerCase();
                const haystack = `${title} ${description} ${category}`;

                let score = 0;
                if (title === lowerQuery) score += 100;
                if (title.startsWith(lowerQuery)) score += 50;
                if (title.includes(lowerQuery)) score += 30;
                if (description.includes(lowerQuery)) score += 15;
                if (category.includes(lowerQuery)) score += 10;
                terms.forEach(term => {
                    if (title.includes(term)) score += 8;
                    if (description.includes(term)) score += 4;
                    if (category.includes(term)) score += 3;
                });

                return { ...item, score, haystack };
            })
            .filter(item => item.score > 0 || terms.every(term => item.haystack.includes(term)))
            .sort((a, b) => b.score - a.score || String(a.title).localeCompare(String(b.title)))
            .slice(0, 12);
        
        if (lastResults.length === 0) {
            searchResults.innerHTML = `
                <div class="search-no-results">
                    <i data-lucide="search-x"></i>
                    <p>No results found for "${escapeHtml(query)}"</p>
                </div>
            `;
        } else {
            searchResults.innerHTML = lastResults.map(item => `
                <a href="${buildSearchUrl(item.url)}" class="search-result-item">
                    <div class="search-result-icon">
                        <i data-lucide="${escapeHtml(item.icon || 'search')}"></i>
                    </div>
                    <div class="search-result-content">
                        <div class="search-result-title">${escapeHtml(item.title)}</div>
                        <div class="search-result-description">${escapeHtml(item.description)}</div>
                    </div>
                    <span class="search-result-category">${escapeHtml(item.category)}</span>
                </a>
            `).join('');
            
            if (window.lucide) {
                window.lucide.createIcons();
            }
        }
        
        searchResults.classList.add('active');
    }

    function buildSearchUrl(url) {
        const value = String(url || '/');
        if (value === '/') {
            return window.baseUrl || '/';
        }

        if (value.startsWith('http') || value.startsWith('#')) {
            return value;
        }

        return `${window.baseUrl || '/'}${value}`;
    }

    function goToBestResult() {
        const query = searchInput.value.trim();
        performSearch(query);

        if (lastResults.length > 0) {
            window.location.href = buildSearchUrl(lastResults[0].url);
        }
    }
    
    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Input event with debounce
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            searchResults.classList.remove('active');
            searchResults.innerHTML = '';
            return;
        }
        
        searchTimeout = setTimeout(() => performSearch(query), 150);
    });
    
    // Search button click
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            const query = searchInput.value.trim();
            performSearch(query);
        });
    }
    
    // Enter key search
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            goToBestResult();
        }
    });
    
    // Close search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.remove('active');
        }
    });
    
    // Focus shows results if query exists
    searchInput.addEventListener('focus', function() {
        if (this.value.trim().length >= 2) {
            searchResults.classList.add('active');
        }
    });
}); 

