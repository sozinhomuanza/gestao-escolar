<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alunos extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_aluno' => [
                    'type' => 'INT',
                    'constraint' => 9,
                    'usigned' => true,
                    'auto_increment' => true
                ],

                'nome' => [
                    'type' => 'VARCHAR',
                    'constraint' => 128,

                ],

                'data_de_nascimento' => [
                    'type' => 'DATE',

                ],

                'responsavel' => [
                    'type' => 'VARCHAR',
                    'constraint' => 128,

                ],

                'sexo' => [
                    'type' => 'VARCHAR',
                    'constraint' => 32,

                ],


                'telefone' => [
                    'type' => 'VARCHAR',
                    'constraint' => 32,

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

        $this->forge->addKey('id_aluno', true);
        $this->forge->createTable('alunos');
    }

    public function down()
    {
        $this->forge->dropTable('alunos');
    }
}