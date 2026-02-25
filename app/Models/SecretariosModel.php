<?php

namespace App\Models;

use CodeIgniter\Model;

class SecretariosModel extends Model
{
    protected $table            = 'secretarios';
    protected $primaryKey       = 'id_secretario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco',
    ];

    // Se o seu banco de dados NÃO tiver as colunas created_at e updated_at, 
    // mude para false para evitar erros de SQL ao salvar.
    protected $useTimestamps    = true; 
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}