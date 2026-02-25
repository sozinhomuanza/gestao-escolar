<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuários';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuário', 'senha', 'Perfil'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;
    
    // Regras de validação
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}