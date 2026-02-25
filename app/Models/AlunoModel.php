<?php

namespace App\Models;

use CodeIgniter\Model;

class AlunoModel extends Model
{
   protected $allowedFields = [
    'nome', 
    'data_nascimento', 
    'genero', 
    'naturalidade',      // Adicionar este
    'provincia_natural', // Adicionar este
    'bi',                // Adicionar este
    'telefone', 
    'email', 
    'endereco', 
    'nome_responsavel', 
    'telefone_responsavel',
    'id_provincia',
    'id_municipio',
    'id_comuna'
];

    protected $useTimestamps = true;
}
