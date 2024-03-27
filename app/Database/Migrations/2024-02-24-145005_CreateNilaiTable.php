<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilaiTable extends Migration
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
            'kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'topik' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nilai' => [
                'type' => 'INT',
                'constraint' => 11
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('nilai');
    }

    public function down()
    {
        $this->forge->dropTable('nilai');
    }
}
