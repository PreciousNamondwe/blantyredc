<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => false,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['planning', 'ongoing', 'completed', 'suspended', 'cancelled'],
                'default' => 'planning',
                'null' => false,
            ],
            'progress_percentage' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'estimated_completion_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'actual_completion_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'budget' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'null' => false,
            ],
            'spent_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'null' => false,
            ],
            'contractor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'image_url' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'details' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'fund_source' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true,
                'null' => false,
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
        $this->forge->addKey(['status']);
        $this->forge->addKey(['category']);
        $this->forge->addKey(['location']);
        $this->forge->addKey(['is_active']);
        $this->forge->addForeignKey('created_by', 'users', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('projects');
    }

    public function down()
    {
        $this->forge->dropTable('projects');
    }
}