-- Blantyre District Council - Complete Database Schema
-- This schema reflects the actual frontend forms and services

-- Drop existing tables if they exist (for fresh start)
DROP TABLE IF EXISTS `audit_log`;
DROP TABLE IF EXISTS `user_sessions`;
DROP TABLE IF EXISTS `service_assignments`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `payment_transactions`;
DROP TABLE IF EXISTS `application_status_log`;
DROP TABLE IF EXISTS `application_documents`;
DROP TABLE IF EXISTS `applications`;
DROP TABLE IF EXISTS `service_config`;

-- ============================================
-- 1. USERS AND AUTHENTICATION
-- ============================================

-- Users table for system access
CREATE TABLE `users` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'department_head', 'staff', 'reviewer') NOT NULL DEFAULT 'staff',
    `department` VARCHAR(100) NULL,
    `phone` VARCHAR(20) NULL,
    `is_active` BOOLEAN DEFAULT TRUE,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_role` (`role`),
    INDEX `idx_department` (`department`),
    INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User sessions for authentication
CREATE TABLE `user_sessions` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `session_token` VARCHAR(255) NOT NULL UNIQUE,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_agent` TEXT NULL,
    `expires_at` TIMESTAMP NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX `idx_token` (`session_token`),
    INDEX `idx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. SERVICE CONFIGURATION
-- ============================================

-- Service configuration table
CREATE TABLE `services` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `service_key` VARCHAR(100) NOT NULL UNIQUE,
    `service_name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `department` VARCHAR(100) NOT NULL,
    `fee_amount` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `processing_days` INT(11) DEFAULT 5,
    `is_active` BOOLEAN DEFAULT TRUE,
    `sort_order` INT(11) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_service_key` (`service_key`),
    INDEX `idx_department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Service assignments to responsible users
CREATE TABLE `service_assignments` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `service_key` VARCHAR(100) NOT NULL,
    `assigned_user_id` INT(11) UNSIGNED NOT NULL,
    `is_primary` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`assigned_user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`service_key`) REFERENCES `services`(`service_key`) ON DELETE CASCADE,
    INDEX `idx_service` (`service_key`),
    INDEX `idx_user` (`assigned_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. APPLICATIONS (UNIFIED FOR ALL SERVICES)
-- ============================================

-- Main applications table - unified for all service types
CREATE TABLE `applications` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `reference_number` VARCHAR(50) NOT NULL UNIQUE,
    `service_key` VARCHAR(100) NOT NULL,
    `status` ENUM('draft', 'submitted', 'under_review', 'approved', 'rejected', 'completed', 'cancelled') DEFAULT 'draft',
    `priority` ENUM('low', 'normal', 'high', 'urgent') DEFAULT 'normal',
    `assigned_to` INT(11) UNSIGNED NULL,
    `submitted_at` TIMESTAMP NULL,
    `review_started_at` TIMESTAMP NULL,
    `approved_at` TIMESTAMP NULL,
    `completed_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`service_key`) REFERENCES `services`(`service_key`),
    FOREIGN KEY (`assigned_to`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_reference` (`reference_number`),
    INDEX `idx_service` (`service_key`),
    INDEX `idx_status` (`status`),
    INDEX `idx_assigned_to` (`assigned_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Application data storage - flexible JSON for different form types
CREATE TABLE `application_data` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `application_id` INT(11) UNSIGNED NOT NULL,
    `data_type` VARCHAR(50) NOT NULL, -- 'applicant_info', 'service_specific', 'payment_info', etc.
    `data_key` VARCHAR(100) NOT NULL, -- field name
    `data_value` TEXT NULL, -- field value
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`application_id`) REFERENCES `applications`(`id`) ON DELETE CASCADE,
    INDEX `idx_application` (`application_id`),
    INDEX `idx_data_type` (`data_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. DOCUMENTS
-- ============================================

-- Application documents
CREATE TABLE `application_documents` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `application_id` INT(11) UNSIGNED NOT NULL,
    `document_type` VARCHAR(100) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `file_size` INT(11) NOT NULL,
    `mime_type` VARCHAR(100) NOT NULL,
    `uploaded_by` INT(11) UNSIGNED NULL, -- User who uploaded
    `is_required` BOOLEAN DEFAULT FALSE,
    `is_verified` BOOLEAN DEFAULT FALSE,
    `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`application_id`) REFERENCES `applications`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_application` (`application_id`),
    INDEX `idx_document_type` (`document_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 5. PAYMENTS
-- ============================================

-- Payment transactions
CREATE TABLE `payments` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `application_id` INT(11) UNSIGNED NOT NULL,
    `transaction_id` VARCHAR(100) NOT NULL UNIQUE,
    `payment_method` ENUM('mobile_money', 'bank_transfer', 'card', 'cash', 'online') NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `currency` VARCHAR(3) DEFAULT 'MWK',
    `status` ENUM('pending', 'processing', 'completed', 'failed', 'cancelled', 'refunded') DEFAULT 'pending',
    `gateway_response` JSON NULL,
    `payment_reference` VARCHAR(100) NULL,
    `paid_by` VARCHAR(255) NULL, -- Payer name for mobile money
    `paid_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`application_id`) REFERENCES `applications`(`id`) ON DELETE CASCADE,
    INDEX `idx_transaction` (`transaction_id`),
    INDEX `idx_application` (`application_id`),
    INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 6. WORKFLOW AND NOTIFICATIONS
-- ============================================

-- Application status log
CREATE TABLE `application_status_log` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `application_id` INT(11) UNSIGNED NOT NULL,
    `old_status` VARCHAR(50) NULL,
    `new_status` VARCHAR(50) NOT NULL,
    `changed_by` INT(11) UNSIGNED NULL,
    `comment` TEXT NULL,
    `is_system_change` BOOLEAN DEFAULT FALSE, -- System vs Manual change
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`application_id`) REFERENCES `applications`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`changed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_application` (`application_id`),
    INDEX `idx_changed_by` (`changed_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Notifications
CREATE TABLE `notifications` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `application_id` INT(11) UNSIGNED NULL,
    `notification_type` ENUM('application_assigned', 'status_updated', 'document_uploaded', 'payment_received', 'system_announcement') NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `is_read` BOOLEAN DEFAULT FALSE,
    `email_sent` BOOLEAN DEFAULT FALSE,
    `sms_sent` BOOLEAN DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `read_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`application_id`) REFERENCES `applications`(`id`) ON DELETE CASCADE,
    INDEX `idx_user` (`user_id`),
    INDEX `idx_application` (`application_id`),
    INDEX `idx_unread` (`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 7. AUDIT AND SYSTEM MANAGEMENT
-- ============================================

-- Audit log for all user actions
CREATE TABLE `audit_log` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) UNSIGNED NULL,
    `action` VARCHAR(100) NOT NULL,
    `table_name` VARCHAR(100) NULL,
    `record_id` INT(11) UNSIGNED NULL,
    `old_values` JSON NULL,
    `new_values` JSON NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_agent` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    INDEX `idx_user` (`user_id`),
    INDEX `idx_action` (`action`),
    INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- System settings
CREATE TABLE `system_settings` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` TEXT NULL,
    `setting_type` ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    `description` TEXT NULL,
    `is_public` BOOLEAN DEFAULT FALSE, -- Can be shown on frontend
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 8. CONTENT MANAGEMENT
-- ============================================

-- News and announcements
CREATE TABLE `news` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `content` TEXT NOT NULL,
    `excerpt` TEXT NULL,
    `featured_image` VARCHAR(500) NULL,
    `status` ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    `author_id` INT(11) UNSIGNED NOT NULL,
    `published_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    INDEX `idx_slug` (`slug`),
    INDEX `idx_status` (`status`),
    INDEX `idx_published_at` (`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Elected officials
CREATE TABLE `elected_officials` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `position` VARCHAR(255) NOT NULL,
    `department` VARCHAR(100) NULL,
    `phone` VARCHAR(20) NULL,
    `email` VARCHAR(255) NULL,
    `bio` TEXT NULL,
    `photo` VARCHAR(500) NULL,
    `social_media` JSON NULL, -- Facebook, Twitter, etc.
    `is_active` BOOLEAN DEFAULT TRUE,
    `sort_order` INT(11) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_position` (`position`),
    INDEX `idx_department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- INSERT DEFAULT SERVICES
-- ============================================

INSERT INTO `services` (`service_key`, `service_name`, `description`, `department`, `fee_amount`, `processing_days`, `sort_order`) VALUES
('birth_certificate', 'Birth Certificate', 'Official birth certificate registration and issuance', 'Health', 5000.00, 5, 1),
('death_certificate', 'Death Certificate', 'Official death certificate registration and issuance', 'Health', 3000.00, 3, 2),
('marriage_certificate', 'Marriage Certificate', 'Marriage registration and certificate issuance', 'Registry', 10000.00, 7, 3),
('business_license', 'Business License', 'Business registration and licensing services', 'Commerce', 25000.00, 10, 4),
('property_rates', 'Property Rates Payment', 'Property and ground rates payment', 'Finance', 0.00, 2, 5),
('complaint_reporting', 'Complaint Reporting', 'Report issues and service complaints', 'General', 0.00, 3, 6),
('firearm_license', 'Firearm License', 'Firearm registration and licensing', 'Police', 15000.00, 14, 7),
('affidavits', 'Affidavits', 'Commissioner of Oaths and affidavit services', 'Legal', 2000.00, 2, 8),
('deceased_estates', 'Deceased Estates', 'Management of deceased estates', 'Legal', 5000.00, 10, 9);

-- ============================================
-- INSERT DEFAULT SYSTEM SETTINGS
-- ============================================

INSERT INTO `system_settings` (`setting_key`, `setting_value`, `setting_type`, `description`, `is_public`) VALUES
('site_name', 'Blantyre District Council', 'string', 'Website name', true),
('site_email', 'info@blantyredc.gov.mw', 'string', 'Contact email', true),
('office_phone', '+265 1 820 111', 'string', 'Office phone number', true),
('office_address', 'Blantyre City Council, P.O. Box 1, Blantyre', 'string', 'Physical address', true),
('currency_code', 'MWK', 'string', 'Default currency', true),
('auto_assign_applications', 'true', 'boolean', 'Auto-assign applications to departments', false),
('notification_email_enabled', 'true', 'boolean', 'Enable email notifications', false),
('notification_sms_enabled', 'false', 'boolean', 'Enable SMS notifications', false),
('max_file_size', '5242880', 'number', 'Maximum file upload size in bytes', false),
('allowed_file_types', '["pdf","jpg","jpeg","png","doc","docx"]', 'json', 'Allowed file types for upload', false);

-- ============================================
-- CREATE DEFAULT ADMIN USER (CHANGE PASSWORD AFTER FIRST LOGIN)
-- ============================================

INSERT INTO `users` (`username`, `email`, `password_hash`, `full_name`, `role`, `department`) VALUES
('admin', 'admin@blantyredc.gov.mw', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin', 'ICT');

-- ============================================
-- INDEXES FOR PERFORMANCE
-- ============================================

-- Composite indexes for common queries
CREATE INDEX `idx_applications_status_service` ON `applications` (`status`, `service_key`);
CREATE INDEX `idx_applications_assigned_status` ON `applications` (`assigned_to`, `status`);
CREATE INDEX `idx_notifications_user_unread` ON `notifications` (`user_id`, `is_read`);
CREATE INDEX `idx_audit_user_created` ON `audit_log` (`user_id`, `created_at`);
CREATE INDEX `idx_application_data_app_type` ON `application_data` (`application_id`, `data_type`);
