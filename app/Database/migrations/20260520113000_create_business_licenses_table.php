<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateBusinessLicensesTable extends Migration
{
    public function up()
    {
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
            'business_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'business_type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'business_category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'market' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'registration_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'expiry_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'license_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'under_review', 'approved', 'rejected', 'expired', 'cancelled'],
                'default' => 'pending',
            ],
            'fee_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'location_type' => [
                'type' => 'ENUM',
                'constraint' => ['Rural', 'Peri-Urban', 'Urban'],
                'null' => true,
            ],
            'owner_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'owner_id_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'owner_id_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'owner_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'owner_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'business_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'business_location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'number_of_employees' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'annual_turnover' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'previous_license_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'is_renewal' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'inspection_required' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'inspection_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'inspection_report' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approved_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'rejected_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'rejection_reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'completed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('application_id');
        $this->forge->addUniqueKey('license_number');
        $this->forge->addKey('status');
        $this->forge->addKey('owner_email');
        $this->forge->addKey('business_type');
        $this->forge->addKey('market');
        $this->forge->addKey('expiry_date');

        $this->forge->addForeignKey('application_id', 'applications', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('business_licenses');
    }

    public function down()
    {
        $this->forge->dropTable('business_licenses');
    }
}