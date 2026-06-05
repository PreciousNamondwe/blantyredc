<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixMissingUpdatedAtColumns extends Migration
{
    public function up()
    {
        $tables = [
            'user_sessions',
            'application_status_log',
            'payment_transactions',
            'notifications',
        ];

        foreach ($tables as $table) {
            $result = $this->db->query("SHOW COLUMNS FROM `{$table}` LIKE 'updated_at'");
            if ($result && $result->getNumRows() === 0) {
                $this->forge->addColumn($table, [
                    'updated_at' => [
                        'type' => 'TIMESTAMP',
                        'null' => true,
                        'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                        'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                    ],
                ]);
            }
        }
    }

    public function down()
    {
        $tables = [
            'user_sessions',
            'application_status_log',
            'payment_transactions',
            'notifications',
        ];

        foreach ($tables as $table) {
            if ($this->db->query("SHOW COLUMNS FROM `{$table}` LIKE 'updated_at'")->getNumRows() > 0) {
                $this->forge->dropColumn($table, 'updated_at');
            }
        }
    }
}
