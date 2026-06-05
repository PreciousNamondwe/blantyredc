<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateInitialSchema extends Migration
{
    public function up()
    {
        // Services table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'service_key' => ['type' => 'VARCHAR', 'constraint' => 100],
            'service_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'TEXT', 'null' => true],
            'department' => ['type' => 'VARCHAR', 'constraint' => 100],
            'fee_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => '0.00'],
            'processing_days' => ['type' => 'INT', 'constraint' => 11, 'default' => 5],
            'is_active' => ['type' => 'BOOLEAN', 'default' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('service_key');
        $this->forge->addKey('department');
        $this->forge->createTable('services');

        // Users table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'department_head', 'staff', 'reviewer'], 'default' => 'staff'],
            'department' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'is_active' => ['type' => 'BOOLEAN', 'default' => true],
            'last_login' => ['type' => 'TIMESTAMP', 'null' => true],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->addKey('role');
        $this->forge->addKey('department');
        $this->forge->createTable('users');

        // Applications table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'reference_number' => ['type' => 'VARCHAR', 'constraint' => 50],
            'service_key' => ['type' => 'VARCHAR', 'constraint' => 100],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'submitted', 'under_review', 'approved', 'rejected', 'completed', 'cancelled'], 'default' => 'draft'],
            'priority' => ['type' => 'ENUM', 'constraint' => ['low', 'normal', 'high', 'urgent'], 'default' => 'normal'],
            'assigned_to' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'submitted_at' => ['type' => 'TIMESTAMP', 'null' => true],
            'review_started_at' => ['type' => 'TIMESTAMP', 'null' => true],
            'approved_at' => ['type' => 'TIMESTAMP', 'null' => true],
            'completed_at' => ['type' => 'TIMESTAMP', 'null' => true],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('reference_number');
        $this->forge->addKey('service_key');
        $this->forge->addKey('status');
        $this->forge->addKey('assigned_to');
        $this->forge->addForeignKey('service_key', 'services', 'service_key', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('assigned_to', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('applications');

        // Application data table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'application_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'data_type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'data_key' => ['type' => 'VARCHAR', 'constraint' => 100],
            'data_value' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('application_id');
        $this->forge->addKey('data_type');
        $this->forge->addForeignKey('application_id', 'applications', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('application_data');
        
        // Service assignments table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'service_key' => ['type' => 'VARCHAR', 'constraint' => 100],
            'assigned_user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'is_primary' => ['type' => 'BOOLEAN', 'default' => false],
            'created_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at' => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('service_key');
        $this->forge->addKey('assigned_user_id');
        $this->forge->addForeignKey('service_key', 'services', 'service_key', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('assigned_user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('service_assignments');
    }

    public function down()
    {
        $this->forge->dropTable('service_assignments', true);
        $this->forge->dropTable('application_data', true);
        $this->forge->dropTable('applications', true);
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('services', true);
    }
}
