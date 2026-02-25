<?php

namespace App\Models;

use CodeIgniter\Model;

class TrabalhadorModel extends Model 
{
    protected $table      = 'trabalhadores';
    protected $primaryKey = 'id_trabalhador';
    
    // IMPORTANTE: Adicionados os campos de localização para permitir o salvamento
    protected $allowedFields = [
        'nome', 
        'funcao', 
        'telefone', 
        'email',
        'data_admissao', 
        'id_provincia', 
        'id_municipio', 
        'id_comuna', 
        'doc_bi', 
        'doc_certificado'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at'; // Verifique se existem estas colunas na sua tabela
    protected $updatedField  = 'updated_at';

    // Regras de validação para garantir que os dados cheguem corretos
    protected $validationRules = [
        'nome'          => 'required|min_length[3]|max_length[255]',
        'funcao'        => 'required',
        'id_provincia'  => 'required|numeric',
        'id_municipio'  => 'required|numeric',
        'id_comuna'     => 'required|numeric',
        'email'         => 'permit_empty|valid_email',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O nome do trabalhador é obrigatório.',
        ],
        'id_provincia' => [
            'required' => 'Selecione a província de residência.',
        ]
    ];
}