<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRelationshipProfileTopik extends Migration
{
    public function up()
    {
        $this->forge->addColumn('profile', [
            'kelompok_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addForeignKey('kelompok_id', 'kelompok', 'id');
    }

    public function down()
    {
        $this->forge->dropForeignKey('profile', 'profile_kelompok_id_foreign');
        $this->forge->dropColumn('profile', 'kelompok_id');
    }
}
