<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSoalTable extends Migration
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
            'topik_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'question' => [
                'type' => 'TEXT',
            ],
            'choice_a' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'value_a' => [
                'type' => 'INT',
            ],
            'choice_b' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'value_b' => [
                'type' => 'INT',
            ],
            'choice_c' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'value_c' => [
                'type' => 'INT',
            ],
            'choice_d' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'value_d' => [
                'type' => 'INT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('topik_id', 'topik', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('soal');
    }

    public function down()
    {
        $this->forge->dropTable('soal');
    }
}
