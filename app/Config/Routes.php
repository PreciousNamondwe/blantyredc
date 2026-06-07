<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->get('/', 'Home::index');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
$routes->post('admin/news/(:num)/delete', 'News::delete/$1');
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
//news handlers
$routes->get('/news', 'News::index');
$routes->get('/news/create', 'News::create');
$routes->post('/news/store', 'News::store');
$routes->get('/news/delete/(:num)', 'News::delete/$1');
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('site-search-index', 'SearchController::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');
$routes->get('logout', 'Auth::logout');
// test routes
$routes->get('test-project', 'TestProject::index');
$routes->post('test-project/store', 'TestProject::store');
$routes->post('test/projects/delete/(:num)', 'TestProject::deleteProject/$1');
$routes->get('project/edit/(:num)', 'TestProject::edit/$1');
$routes->post('project/update/(:num)', 'TestProject::update/$1');
    
// custom routes
$routes->add('about-blantyre','Home::about_blantyre');
$routes->add('activity-features','Home::activity_features');
$routes->add('affidavits','Home::affidavits');
$routes->add('certification-of-certificates','Home::certification_of_certificates');
$routes->add('change-of-name','Home::change_of_name');
$routes->add('commissioner-of-oaths','Home::commissioner_of_oaths');
$routes->add('deceased-estates','Home::deceased_estates');
$routes->add('directorate-of-administration','Home::directorate_of_administration');
$routes->add('directorate-of-agriculture','Home::directorate_of_agriculture');
$routes->add('directorate-of-education','Home::directorate_of_education');
$routes->add('directorate-of-financial-services','Home::directorate_of_financial_services');
$routes->add('directorate-of-health','Home::directorate_of_health');
$routes->add('directorate-of-public-works','Home::directorate_of_public_works');
$routes->add('directorate-of-planning-development','Home::directorate_of_planning_development');
$routes->add('downloads','Home::downloads');
$routes->add('services','Home::services');
$routes->add('feature-activity','Home::feature_activity');
$routes->add('firearm','Home::firearm');
$routes->add('management','Home::management');
$routes->add('marriage-certificates','Home::marriage_certificates');
$routes->add('officials','Home::officials');
$routes->add('elected-officials','Home::officials');
$routes->add('electedofficals','Home::officials');
$routes->add('projects','Home::projects');
$routes->add('will-deposit','Home::will_deposit');
// Public notices routes - must be after admin routes to not interfere
// These are defined at the bottom of the file after admin routes
$routes->add('business-license','Home::business_license');
$routes->add('property-rates','Home::property_rates');
$routes->add('complaint-reporting','Home::complaint_reporting');
$routes->add('track-application','Home::track_application');
$routes->add('birth-certificate','Home::birth_certificate');
$routes->add('death-certificate','Home::death_certificate');

$routes->add('email/compose', 'Email::compose');
$routes->post('email/send-email', 'Email::send_email');
$routes->add('contact-us','ContactUs::index');
$routes->add('contact-us/send-email','ContactUs::send_email');


$routes->get('marriage-certificates', 'MarriageCertificateController::index');
$routes->post('marriage-certificates/store', 'MarriageCertificateController::store');
// ============================================================================
// ONLINE BUSINESS LICENSING ROUTES
// ============================================================================
$routes->group('business-license', function($routes) {
    // Route to load and view the application form page
    // URL: http://localhost/Blantyre-District-council-web-App/public/business-license
    $routes->get('/', 'BusinessLicenseController::index');
    
    // Route to handle the POST submission of the application form data and ID upload
    // URL: http://localhost/Blantyre-District-council-web-App/public/business-license/submit
    $routes->post('submit', 'BusinessLicenseController::submit');
});
// Web Workspace View Route
$routes->get('applications/show/(:num)', 'ApplicationController::showWeb/$1');
// API Routes for Digital Forms
$routes->group('api', function($routes) {
    $routes->get('complaints/fetch', 'ApplicationController::getComplaints');
    $routes->post('applications/submit', 'ApplicationController::submit');
    $routes->get('applications/(:num)/status', 'ApplicationController::status/$1');
    $routes->post('applications/(:num)/documents', 'ApplicationController::uploadDocument/$1');
    $routes->get('applications/my-applications', 'ApplicationController::myApplications');

    // Authentication routes
    $routes->post('auth/login', 'Api\AuthController::login');
    $routes->post('auth/logout', 'Api\AuthController::logout');
    $routes->get('auth/profile', 'Api\AuthController::profile', ['filter' => 'auth']);
    $routes->post('auth/refresh', 'Api\AuthController::refresh', ['filter' => 'auth']);

    // Application management routes
    $routes->group('applications', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'Api\ApplicationController::index');
        $routes->get('(:num)', 'Api\ApplicationController::show/$1');
        $routes->post('(:num)/status', 'Api\ApplicationController::updateStatus/$1');
        $routes->post('(:num)/assign', 'Api\ApplicationController::assign/$1');
        $routes->get('(:num)/documents', 'Api\ApplicationController::documents/$1');
        $routes->post('(:num)/documents', 'Api\ApplicationController::uploadDocument/$1');
        $routes->get('(:num)/history', 'Api\ApplicationController::history/$1');
    });

    // Admin routes
    $routes->group('admin', ['filter' => 'admin'], function($routes) {
        $routes->get('applications', 'AdminController::applications');
        $routes->get('users', 'Api\AdminController::users');
        $routes->post('users', 'Api\AdminController::createUser');
        $routes->put('users/(:num)', 'Api\AdminController::updateUser/$1');
        $routes->get('services', 'Api\AdminController::services');
        $routes->post('services', 'Api\AdminController::createService');
        $routes->get('payments/stats', 'Api\AdminController::paymentStats');
    });

    // Department head routes
    $routes->group('department', ['filter' => 'department_head'], function($routes) {
        $routes->get('applications', 'Api\ApplicationController::departmentApplications');
        $routes->post('applications/(:num)/status', 'Api\ApplicationController::updateStatus/$1');
        $routes->post('applications/(:num)/assign', 'Api\ApplicationController::assign/$1');
    });

    // Staff routes
    $routes->group('staff', ['filter' => 'staff'], function($routes) {
        $routes->get('applications', 'Api\ApplicationController::assignedApplications');
        $routes->post('applications/(:num)/status', 'Api\ApplicationController::updateStatus/$1');
        $routes->get('applications/(:num)/review', 'Api\ApplicationController::reviewApplication/$1');
    });

    // Reviewer routes
    $routes->group('reviewer', ['filter' => 'reviewer'], function($routes) {
        $routes->get('applications', 'Api\ApplicationController::assignedApplications');
        $routes->post('applications/(:num)/review', 'Api\ApplicationController::submitReview/$1');
    });
    // Public notices API routes
    $routes->get('notices/urgent', 'NoticesController::getUrgentNotices');
    $routes->get('notices/recent', 'NoticesController::getRecentNotices');
    $routes->get('notices/search', 'NoticesController::search');
});
    
// Admin Dashboard Routes (Web Interface)
$routes->group('admin', ['filter' => 'webadmin'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    
    $routes->get('users', 'AdminController::users');
    $routes->post('users/create', 'AdminController::createUser');
    $routes->post('users/edit/(:num)', 'AdminController::editUser/$1');
    $routes->post('users/delete/(:num)', 'AdminController::deleteUser/$1');
    
    $routes->get('services', 'AdminController::services');
    $routes->get('services/create', 'AdminController::createService');
    $routes->post('services/create', 'AdminController::createService');
    $routes->get('services/(:num)/edit', 'AdminController::editService/$1');
    $routes->post('services/(:num)/edit', 'AdminController::editService/$1');
    $routes->post('services/(:num)/edit', 'AdminController::editService/$1');  // FIXED: ID in middle
    $routes->post('services/(:num)/delete', 'AdminController::deleteService/$1');
    
    $routes->get('business-types', 'AdminController::businessTypes');
    $routes->get('business-types/create', 'AdminController::createBusinessType');
    $routes->post('business-types/create', 'AdminController::createBusinessType');
    $routes->get('business-types/(:num)/edit', 'AdminController::editBusinessType/$1');
    $routes->post('business-types/(:num)/edit', 'AdminController::editBusinessType/$1');
    $routes->post('business-types/(:num)/delete', 'AdminController::deleteBusinessType/$1');
    
    $routes->get('projects', 'AdminController::projects');
    $routes->get('projects/create', 'AdminController::createProject');
    $routes->post('projects/create', 'AdminController::createProject');
    $routes->get('projects/(:num)/edit', 'AdminController::editProject/$1');
    $routes->post('projects/(:num)/edit', 'AdminController::editProject/$1');
    $routes->post('projects/(:num)/delete', 'AdminController::deleteProject/$1');
    
    // --- FIXED: COMBINED APPLICATIONS WORKSPACE ACTION ENGINES ---
    $routes->get('applications', 'AdminController::applications');
    $routes->post('applications/update-marriage', 'AdminController::updateMarriageInline');
    $routes->post('applications/update-business', 'AdminController::updateBusinessInline');
    $routes->get('applications/download/(:any)', 'AdminController::download/$1');
    // --------------------------------------------------------------

  // --- OFFICIALS WORKSPACE ---
    $routes->get('officials', 'AdminController::officials');
    $routes->get('officials/create', 'AdminController::createOfficial');
    $routes->post('officials/create', 'AdminController::createOfficial');
    $routes->get('officials/(:num)/edit', 'AdminController::editOfficial/$1');
    $routes->post('officials/(:num)/edit', 'AdminController::editOfficial/$1');
    // Ensure this line is present inside your admin routes group block:
    $routes->post('officials/(:num)/delete', 'AdminController::deleteOfficial/$1'); 
    
    $routes->post('management/create', 'AdminController::createManagement');
    $routes->post('management/(:num)/edit', 'AdminController::editManagement/$1');
    // Place this inside your admin group container matching your management forms layout:
    $routes->post('management/(:num)/delete', 'AdminController::deleteManagement/$1');;
   
    $routes->get('news', 'AdminController::news');
    $routes->post('news/create', 'AdminController::createNews');
    $routes->post('news/(:num)/edit', 'AdminController::editNews/$1');
    $routes->post('news/(:num)/delete', 'AdminController::deleteNews/$1');
    
    // Maps your sidebar link route directly to your notices CRUD functions
    $routes->get('notifications', 'AdminController::notices'); 
    $routes->post('notices/create', 'AdminController::createNotice');
    $routes->post('notices/create', 'AdminController::createNotice');
    $routes->post('notices/edit/(:num)', 'AdminController::editNotice/$1');
    $routes->post('notices/edit/(:num)', 'AdminController::editNotice/$1');
    // Notice Deletion Endpoint matching your base url template pattern
    $routes->post('notices/(:num)/delete', 'AdminController::deleteNotice/$1');

    $routes->post('projects/delete/(:num)', 'AdminController::deleteProject/$1'); // FIXED: Removed repetitive 'admin/' prefix
    $routes->get('test-project/edit/(:num)', 'TestProject::edit/$1');
    $routes->post('test-project/update/(:num)', 'TestProject::update/$1');
});

// Public notices routes (defined after admin routes to prevent conflicts)
$routes->get('tenders', 'NoticesController::index');
$routes->get('tenders/(:any)', 'NoticesController::detail/$1');
$routes->get('notices', 'NoticesController::index');
$routes->get('notices/(:any)', 'NoticesController::detail/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
   }