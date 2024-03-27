<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTokenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('token');
    }

    public function down()
    {
        $this->forge->dropTable('token');
    }
}
