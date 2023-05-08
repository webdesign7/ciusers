<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsernameAndMobileToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
                'null' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ]
        ]);

        $this->forge->addKey('username', true);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'mobile');
        $this->forge->dropColumn('users', 'username');
    }
}
