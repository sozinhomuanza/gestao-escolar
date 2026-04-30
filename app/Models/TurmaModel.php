<?php
namespace App\Models;
use CodeIgniter\Model;

class TurmaModel extends Model {
    protected $table      = 'turmas';
    protected $primaryKey = 'id_turma';
    protected $allowedFields = ['nome_turma', 'classe', 'id_sala', 'id_disciplina', 'id_professor', 'ano_letivo', 'periodo'];
    protected $useTimestamps = true;

    public function listarTurmas() {
        return $this->select('turmas.*, trabalhadores.nome as nome_professor, disciplinas.nome_disciplina, salas.nome_sala')
                    ->join('trabalhadores', 'trabalhadores.id_trabalhador = turmas.id_professor', 'left')
                    ->join('disciplinas', 'disciplinas.id_disciplina = turmas.id_disciplina', 'left')
                    ->join('salas', 'salas.id_sala = turmas.id_sala', 'left')
                    ->findAll();
    }
    
}
