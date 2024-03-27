<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDivisiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('divisi');
    }

    public function down()
    {
        $this->forge->dropTable('divisi');
    }
}
