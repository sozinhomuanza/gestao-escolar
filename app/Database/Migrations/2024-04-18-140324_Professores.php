<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Professores extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_professor' => [
                    'type' => 'INT',
                    'constraint' => 9,
                    'usigned' => true,
                    'auto_increment' => true
                ],

                'nome' => [
                    'type' => 'VARCHAR',
                    'constraint' => 128,

                ],
                'cpf' => [
                    'type' => 'VARCHAR',
                    'constraint' => 32,

                ],

                'telefone' => [
                    'type' => 'VARCHAR',
                    'constraint' => 32,

                ],

                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 128,

                ],
                'endereco' => [
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

        $this->forge->addKey('id_professor', true);
        $this->forge->createTable('professores');
    }

    public function down()
    {
        $this->forge->dropTable('professores');
    }
}