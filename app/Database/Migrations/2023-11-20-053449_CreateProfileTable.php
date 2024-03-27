<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfileTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'        => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'user_id'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['l', 'p'],
            ],
            'umur'        => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'descripsi'   => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'divisi_id'   => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true
            ],
        ]);

        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('divisi_id', 'divisi', 'id');

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('profile');
    }

    public function down()
    {
        $this->forge->dropTable('profile');
    }
}
