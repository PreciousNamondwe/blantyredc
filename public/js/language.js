// Language Translation System
class LanguageManager {
    constructor() {
        this.currentLang = localStorage.getItem('preferredLanguage') || 'en';
        this.translations = {
            en: {
                welcome: 'Welcome to the Future of Governance',
                district: 'BLANTYRE DISTRICT',
                subtitle: 'The Commercial & Industrial Capital of Malawi',
                search_placeholder: 'Search services, documents, departments...',
                public_services: 'Public Services',
                view_directory: 'View Directory',
                leadership: 'Leadership',
                district_updates: 'District Updates',
                latest_happenings: 'LATEST HAPPENINGS',
                development_tracker: 'Development Tracker',
                view_all_projects: 'View All Projects',
                invest_in_blantyre: 'Invest in Blantyre',
                visit_blantyre: 'Visit Blantyre',
                citizen_feedback: 'Citizen Feedback',
                quick_downloads: 'Quick Downloads',
                business_licensing: 'Business Licensing',
                prop_rates: 'Prop. Rates',
                planning: 'Planning',
                environment: 'Environment',
                health: 'Health',
                education: 'Education',
                bylaws: 'By-Laws',
                emergency_response: 'Emergency Response',
                report_complaint: 'Report Complaint',
                track_application: 'Track Application',
                legal_services: 'Legal Services'
            },
            ny: {
                welcome: 'Wabwerera ku Boma Lachitupa',
                district: 'BLANTYRE DISTRICT',
                subtitle: 'Mzinda wa Malawi wa Malonda ndi Ntchito',
                search_placeholder: 'Sakani ntchito, makalata, ma dipatimenti...',
                public_services: 'Ntchito Zanthu',
                view_directory: 'Onani Nthawi',
                leadership: 'Ulamuliro',
                district_updates: 'Zosintha m\'Boma',
                latest_happenings: 'ZOMWE ZIKUCHITIKA',
                development_tracker: 'Katswiri za Kukula',
                view_all_projects: 'Onani Zigumbe Zonse',
                invest_in_blantyre: 'Investa m\'Blantyre',
                visit_blantyre: 'Poyani m\'Blantyre',
                citizen_feedback: 'Mawu a Anthu',
                quick_downloads: 'Kutsitsa Kwambiri',
                business_licensing: 'Mabuku a Malonda',
                prop_rates: 'Misonkho ya Nyumba',
                planning: 'Kukonzekera',
                environment: 'Zamalonda',
                health: 'Zaumoyo',
                education: 'Maphunziro',
                bylaws: 'Malamulo a Boma',
                emergency_response: 'Thandizo la Kuwopsa',
                report_complaint: 'Lembani Kulakwitsa',
                track_application: 'Landiritsa Ufulu',
                legal_services: 'Ntchito Zamalanda'
            },
            tum: {
                welcome: 'Wabwerera ku Boma Lachitupa',
                district: 'BLANTYRE DISTRICT',
                subtitle: 'Mzinda wa Malawi wa Malonda ndi Ntchito',
                search_placeholder: 'Sakani ntchito, makalata, ma dipatimenti...',
                public_services: 'Ntchito Zanthu',
                view_directory: 'Onani Nthawi',
                leadership: 'Ulamuliro',
                district_updates: 'Zosintha m\'Boma',
                latest_happenings: 'ZOMWE ZIKUCHITIKA',
                development_tracker: 'Katswiri za Kukula',
                view_all_projects: 'Onani Zigumbe Zonse',
                invest_in_blantyre: 'Investa m\'Blantyre',
                visit_blantyre: 'Poyani m\'Blantyre',
                citizen_feedback: 'Mawu a Anthu',
                quick_downloads: 'Kutsitsa Kwambiri',
                business_licensing: 'Mabuku a Malonda',
                prop_rates: 'Misonkho ya Nyumba',
                planning: 'Kukonzekera',
                environment: 'Zamalonda',
                health: 'Athanzi',
                education: 'Maphunziro',
                bylaws: 'Malamulo a Boma',
                emergency_response: 'Thandizo la Kuwopsa',
                report_complaint: 'Lembani Kulakwitsa',
                track_application: 'Landiritsa Ufulu',
                legal_services: 'Ntchito Zamalanda'
            }
        };
    }

    translate(key) {
        return this.translations[this.currentLang][key] || this.translations.en[key] || key;
    }

    setLanguage(lang) {
        this.currentLang = lang;
        localStorage.setItem('preferredLanguage', lang);
        this.updatePageContent();
    }

    updatePageContent() {
        // Update hero section
        const welcomeEl = document.querySelector('.hero-subtitle-pill');
        if (welcomeEl) welcomeEl.textContent = this.translate('welcome');
        
        const districtEl = document.querySelector('.hero-title-massive');
        if (districtEl) districtEl.innerHTML = this.translate('district').replace(' ', '<br>');
        
        const subtitleEl = document.querySelector('.lead.text-white-50');
        if (subtitleEl) subtitleEl.textContent = this.translate('subtitle');

        // Update search placeholder
        const searchInput = document.querySelector('.hero-search-input');
        if (searchInput) searchInput.placeholder = this.translate('search_placeholder');

        // Update section headers
        const publicServicesEl = document.querySelector('.section-title');
        if (publicServicesEl && publicServicesEl.textContent.includes('Public Services')) {
            publicServicesEl.textContent = this.translate('public_services');
        }

        // Update specific sections by content matching
        document.querySelectorAll('h2.section-title').forEach(el => {
            const text = el.textContent.trim();
            if (text === 'Leadership') el.textContent = this.translate('leadership');
            if (text === 'District Updates') el.textContent = this.translate('district_updates');
            if (text === 'Development Tracker') el.textContent = this.translate('development_tracker');
            if (text === 'Visit Blantyre') el.textContent = this.translate('visit_blantyre');
        });

        // Update service cards
        const serviceCards = {
            'Business Licensing': 'business_licensing',
            'Prop. Rates': 'prop_rates',
            'Planning': 'planning',
            'Environment': 'environment',
            'Health': 'health',
            'Education': 'education',
            'By-Laws': 'bylaws'
        };

        document.querySelectorAll('.dense-card h4, .dense-card h3').forEach(el => {
            const text = el.textContent.trim();
            if (serviceCards[text]) {
                el.textContent = this.translate(serviceCards[text]);
            }
        });

        // Update buttons and links
        document.querySelectorAll('a, button').forEach(el => {
            const text = el.textContent.trim();
            if (text === 'View Directory') el.textContent = this.translate('view_directory');
            if (text === 'View All Projects') el.textContent = this.translate('view_all_projects');
            if (text === 'Report Complaint') el.textContent = this.translate('report_complaint');
            if (text === 'Track Application') el.textContent = this.translate('track_application');
            if (text === 'Legal Services') el.textContent = this.translate('legal_services');
            if (text === 'Citizen Feedback') el.textContent = this.translate('citizen_feedback');
            if (text === 'Quick Downloads') el.textContent = this.translate('quick_downloads');
        });

        // Update emergency section
        const emergencyEl = document.querySelector('h5.text-uppercase');
        if (emergencyEl && emergencyEl.textContent.includes('Emergency Response')) {
            emergencyEl.textContent = this.translate('emergency_response');
        }

        // Update badges
        document.querySelectorAll('.badge').forEach(el => {
            const text = el.textContent.trim();
            if (text === 'LATEST HAPPENINGS') el.textContent = this.translate('latest_happenings');
        });

        // Update investment section
        const investEl = document.querySelector('.display-5');
        if (investEl && investEl.textContent.includes('Invest in Blantyre')) {
            investEl.textContent = this.translate('invest_in_blantyre');
        }
    }
}

// Initialize language manager
const langManager = new LanguageManager();

// Update language switcher to use language manager
document.querySelectorAll('.language-option').forEach(option => {
    option.addEventListener('click', function(e) {
        e.preventDefault();
        const langCode = this.getAttribute('data-lang');
        langManager.setLanguage(langCode);
        
        // Update UI
        document.getElementById('currentLang').textContent = langCode.toUpperCase();
        document.querySelectorAll('.language-option').forEach(opt => opt.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('languageMenu').style.display = 'none';
    });
});
