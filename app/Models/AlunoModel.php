<?php

namespace App\Models;

use CodeIgniter\Model;

class AlunoModel extends Model
{
    protected $table      = 'alunos'; // Garanta que o nome da tabela está aqui
    protected $primaryKey = 'id_aluno';

    protected $allowedFields = [
        'nome', 
        'data_nascimento', 
        'genero', 
        'naturalidade',      
        'provincia_natural', 
        'bi',                
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

    // Callbacks que rodam automaticamente antes de salvar
    protected $beforeInsert = ['tratarDadosRelacionais'];
    protected $beforeUpdate = ['tratarDadosRelacionais'];

    /**
     * Esta função intercepta os dados e transforma strings vazias em NULL
     * para evitar o erro de Foreign Key (Chave Estrangeira)
     */
    protected function tratarDadosRelacionais(array $data)
    {
        $relacoes = ['id_provincia', 'id_municipio', 'id_comuna'];

        foreach ($relacoes as $campo) {
            if (isset($data['data'][$campo])) {
                // Se o valor for vazio, "0" ou apenas espaços, vira NULL
                if (trim($data['data'][$campo]) === '' || $data['data'][$campo] === '0') {
                    $data['data'][$campo] = null;
                }
            }
        }

        return $data;
    }
}