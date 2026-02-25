<?php
namespace App\Models;
use CodeIgniter\Model;

class DisciplinaModel extends Model {
    protected $table      = 'disciplinas';
    protected $primaryKey = 'id_disciplina';
    protected $allowedFields = ['nome_disciplina', 'carga_horaria', 'descricao'];
    protected $useTimestamps = true;
}
