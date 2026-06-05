# Developer Setup & Troubleshooting Guide: Blantyre District Council Website

This guide explains the issues encountered with the legacy codebase during the local setup process and the necessary steps to make it runnable on a modern environment (PHP 8.2+ and CodeIgniter 4.7.0).

## 1. Core Issues Encountered

When the project was first initialized, several critical issues prevented it from running:

### A. Outdated Bootstrapping
The `spark` and `public/index.php` files were using an old initialization method (including `system/bootstrap.php`) that is no longer compatible with modern CodeIgniter 4. This resulted in errors when trying to start the server.

### B. Configuration Drift
The configuration files in `app/Config/` did not match the expectations of the installed framework version (4.7.0). Key missing properties included:
- `Config\Autoload::$helpers`: Caused "null given" errors during autoloader initialization.
- `Config\App::$allowedHostnames`: Caused "undefined property" errors.
- `Config\App::$proxyIPs`: Was defined as a string but required an array.
- Missing configuration files: `Routing.php`, `Cors.php`, etc.

### C. Incorrect Asset Paths
The view files were hardcoded with paths like `base_url('public/image/...')`. 
- **The Problem:** When running the server with `php spark serve`, the `public/` directory is treated as the **Root Folder**. 
- **The Result:** Requesting `base_url('public/...')` resulted in `http://localhost:8080/public/...`, which led to 404 errors because the server was looking for a folder named `public` *inside* the real public folder.

---

## 2. Resolution Steps

To replicate the fixes or update your local environment, follow these steps:

### Step 1: Fix the Entry Points
Update both `spark` (in the root) and `public/index.php` to use the modern boot system:

```php
// Use this pattern
// In public/index.php
require FCPATH . '../vendor/codeigniter4/framework/system/Boot.php';
CodeIgniter\Boot::bootWeb($paths);

// In spark
require __DIR__ . '/vendor/codeigniter4/framework/system/Boot.php';
CodeIgniter\Boot::bootSpark($paths);
```

### Step 2: Align Configuration Files
Ensure your `app/Config/` files have the properties required by CI 4.7.0.

1.  **`Autoload.php`**: Add `public $helpers = [];`.
2.  **`App.php`**: 
    - Set `public $allowedHostnames = [];`.
    - Set `public $proxyIPs = [];` (Not a string!).
    - Set `public $indexPage = '';` (To remove index.php from URLs).
3.  **Missing Files**: If you get errors about missing classes like `Config\Routing`, copy the default versions from `vendor/codeigniter4/framework/app/Config/`.

### Step 3: Correct Asset URL Generation
In all view files (templates, home, etc.), change how you link assets:

- **Wrong:** `<?= base_url('public/css/style.css'); ?>`
- **Right:** `<?= base_url('css/style.css'); ?>`

Also, avoid manual string concatenation to prevent double slashes:
- **Wrong:** `<?= base_url(); ?>/js/main.js`
- **Right:** `<?= base_url('js/main.js'); ?>`

### Step 4: Environment Variables
Copy `env` to `.env` and set:
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
```

---

## 3. Running the Project

1.  **Install Dependencies**:
    ```bash
    composer update --ignore-platform-reqs
    ```
2.  **Start the Server**:
    ```bash
    php spark serve
    ```
3.  **Access the Site**: Open `http://localhost:8080` in your browser.

## 4. Why These Changes?

- **Security**: Placing the web root at `public/` hides your application code and configuration from the public.
- **Maintainability**: Using `base_url('path')` ensures that your links work regardless of whether the site is in a subdirectory or a root domain.
- **Compatibility**: CodeIgniter 4 is evolving; staying aligned with the installed vendor version prevents runtime crashes.
