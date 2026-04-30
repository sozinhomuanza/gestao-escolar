<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Disciplinas extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_disciplina' => [
                    'type' => 'INT',
                    'constraint' => 9,
                    'usigned' => true,
                    'auto_increment' => true
                ],

                'disciplina' => [
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

        $this->forge->addKey('id_disciplina', true);
        $this->forge->createTable('disciplinas');
    }

    public function down()
    {
        $this->forge->dropTable('disciplinas');
    }
}
