<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Salas extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_sala' => [
                    'type' => 'INT',
                    'constraint' => 9,
                    'usigned' => true,
                    'auto_increment' => true
                ],

                'sala' => [
                    'type' => 'VARCHAR',
                    'constraint' => 128,

                ],

                'descricao' => [
                    'type' => 'VARCHAR',
                    'constraint' => 128,

                ],

                
                'created_at' => [
                    'type' => 'DATETIME',

                ],
                'updated_at' => [
                    'type' => 'DATETIME',

                ],
                'deleted_at' => [
                    'type' => 'DATETIME',

                ],
            ]

        );

        $this->forge->addKey('id_sala', true);
        $this->forge->createTable('salas');
    }

    public function down()
    {
        $this->forge->dropTable('salas');
    }
}
