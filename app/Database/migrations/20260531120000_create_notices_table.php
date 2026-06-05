<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNoticesTable extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => false,
            ],
            'reference' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'general',
            ],
            'urgency_level' => [
                'type' => 'ENUM',
                'constraint' => ['low', 'medium', 'high', 'urgent'],
                'default' => 'medium',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'published', 'archived'],
                'default' => 'draft',
            ],
            'author_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'published_at' => [
                'type' => 'TIMESTAMP',
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
                $this->forge->addKey(['status']);
                $this->forge->addKey(['published_at']);
                $this->forge->addKey(['urgency_level']);
                $this->forge->addKey(['category']);
            $this->forge->addForeignKey(
                'author_id',
                'users',
                'id',
                'CASCADE',
                'CASCADE'
            );
        $this->forge->createTable('notices');
    }

    public function down()
    {
        $this->forge->dropTable('notices');
    }
}
