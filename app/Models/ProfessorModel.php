<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorModel extends Model
{
    protected $table            = 'professores';
    protected $primaryKey       = 'id_professor';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; // Mude para true se quiser usar o deleted_at
    
    // Campos que podem ser gravados no banco
    protected $allowedFields    = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco'
    ];

    // Timestamps automáticos (Certifique-se que as colunas existem na tabela)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validação básica opcional
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}