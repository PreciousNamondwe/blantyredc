<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompleteBackendSchema extends Migration
{
    public function up()
    {
        // Drop existing tables if they exist (for fresh start)
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $tables = [
            'audit_log',
            'user_sessions',
            'service_assignments',
            'users',
            'payment_transactions',
            'application_status_log',
            'application_documents',
            'application_data',
            'applications',
            'services',
            'notifications'
        ];

        foreach ($tables as $table) {
            $this->forge->dropTable($table, true);
        }

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // ============================================
        // 1. USERS AND AUTHENTICATION
        // ============================================

        // Users table for system access
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'department_head', 'staff', 'reviewer'],
                'default' => 'staff',
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'last_login' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['role']);
        $this->forge->addKey(['department']);
        $this->forge->createTable('users');

        // User sessions for authentication
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'session_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'expires_at' => [
                'type' => 'TIMESTAMP',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_sessions');

        // ============================================
        // 2. SERVICE CONFIGURATION
        // ============================================

        // Service configuration table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'service_key' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'service_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'fee_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'processing_days' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 5,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'sort_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['department']);
        $this->forge->createTable('services');

        // Service assignments to responsible users
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'service_key' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'assigned_user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'is_primary' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['service_key']);
        $this->forge->addKey(['assigned_user_id']);
        $this->forge->addForeignKey('assigned_user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('service_key', 'services', 'service_key', 'CASCADE', 'CASCADE');
        $this->forge->createTable('service_assignments');

        // ============================================
        // 3. APPLICATIONS (UNIFIED FOR ALL SERVICES)
        // ============================================

        // Main applications table - unified for all service types
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'reference_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'service_key' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'submitted', 'under_review', 'approved', 'rejected', 'completed', 'cancelled'],
                'default' => 'draft',
            ],
            'priority' => [
                'type' => 'ENUM',
                'constraint' => ['low', 'normal', 'high', 'urgent'],
                'default' => 'normal',
            ],
            'assigned_to' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'submitted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'review_started_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'approved_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'completed_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['service_key']);
        $this->forge->addKey(['status']);
        $this->forge->addKey(['assigned_to']);
        $this->forge->addForeignKey('service_key', 'services', 'service_key', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('assigned_to', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('applications');

        // Flexible application data storage
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'application_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'data_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'data_key' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'data_value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['application_id']);
        $this->forge->addKey(['data_type']);
        $this->forge->addForeignKey('application_id', 'applications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('application_data');

        // Application documents
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'application_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'document_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'file_size' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'mime_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'uploaded_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['application_id']);
        $this->forge->addForeignKey('application_id', 'applications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('application_documents');

        // Application status log
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'application_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'old_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'new_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'changed_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['application_id']);
        $this->forge->addForeignKey('application_id', 'applications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('changed_by', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('application_status_log');

        // ============================================
        // 4. PAYMENTS
        // ============================================

        // Payment transactions
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'application_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'default' => 'MWK',
            ],
            'payment_method' => [
                'type' => 'ENUM',
                'constraint' => ['cash', 'bank_transfer', 'mobile_money', 'card'],
            ],
            'transaction_reference' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'completed', 'failed', 'refunded'],
                'default' => 'pending',
            ],
            'paid_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['application_id']);
        $this->forge->addForeignKey('application_id', 'applications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment_transactions');

        // ============================================
        // 5. NOTIFICATIONS & AUDIT
        // ============================================

        // Notifications
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'application_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['status_change', 'assignment', 'payment', 'reminder', 'system'],
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'is_read' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id']);
        $this->forge->addKey(['application_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->addForeignKey('application_id', 'applications', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('notifications');

        // Audit log
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'action' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'resource_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'resource_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'old_values' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'new_values' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id']);
        $this->forge->addKey(['resource_type', 'resource_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('audit_log');

        // ============================================
        // 6. INSERT INITIAL DATA
        // ============================================

        // Insert services
        $services = [
            [
                'service_key' => 'birth_certificate',
                'service_name' => 'Birth Certificate',
                'description' => 'Application for birth certificate',
                'department' => 'Health',
                'fee_amount' => 5000.00,
                'processing_days' => 5,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'service_key' => 'death_certificate',
                'service_name' => 'Death Certificate',
                'description' => 'Application for death certificate',
                'department' => 'Health',
                'fee_amount' => 3000.00,
                'processing_days' => 3,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'service_key' => 'marriage_certificate',
                'service_name' => 'Marriage Certificate',
                'description' => 'Application for marriage certificate',
                'department' => 'Registry',
                'fee_amount' => 10000.00,
                'processing_days' => 7,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'service_key' => 'business_license',
                'service_name' => 'Business License',
                'description' => 'Application for business license',
                'department' => 'Commerce/Trade',
                'fee_amount' => 25000.00,
                'processing_days' => 10,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'service_key' => 'property_rates',
                'service_name' => 'Property Rates Payment',
                'description' => 'Property rates payment and assessment',
                'department' => 'Finance',
                'fee_amount' => 0.00,
                'processing_days' => 2,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'service_key' => 'complaint_reporting',
                'service_name' => 'Complaint Reporting',
                'description' => 'Report complaints and issues',
                'department' => 'General Administration',
                'fee_amount' => 0.00,
                'processing_days' => 3,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'service_key' => 'firearm_license',
                'service_name' => 'Firearm License',
                'description' => 'Application for firearm license',
                'department' => 'Police',
                'fee_amount' => 15000.00,
                'processing_days' => 14,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'service_key' => 'affidavits',
                'service_name' => 'Affidavits',
                'description' => 'Affidavit services and declarations',
                'department' => 'Legal',
                'fee_amount' => 2000.00,
                'processing_days' => 2,
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'service_key' => 'deceased_estates',
                'service_name' => 'Deceased Estates',
                'description' => 'Estate administration and probate',
                'department' => 'Legal',
                'fee_amount' => 5000.00,
                'processing_days' => 10,
                'is_active' => true,
                'sort_order' => 9,
            ],
        ];

        $this->db->table('services')->insertBatch($services);

        // Insert default admin user
        $this->db->table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@blantyredc.gov.mw',
            'password_hash' => password_hash('Admin@123', PASSWORD_DEFAULT),
            'full_name' => 'System Administrator',
            'role' => 'admin',
            'department' => 'IT',
            'phone' => '+265 1 822 000',
            'is_active' => true,
        ]);
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $tables = [
            'audit_log',
            'notifications',
            'payment_transactions',
            'application_status_log',
            'application_documents',
            'application_data',
            'applications',
            'service_assignments',
            'services',
            'user_sessions',
            'users',
        ];

        foreach ($tables as $table) {
            $this->forge->dropTable($table, true);
        }

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }
}