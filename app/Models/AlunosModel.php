<?php

namespace App\Models;

use CodeIgniter\Model;

class AlunosModel extends Model
{
    protected $table      = 'alunos';
    protected $primaryKey = 'id_aluno';

    // Campos permitidos para gravação (ATUALIZADO)
    protected $allowedFields = [
        'nome', 
        'data_nascimento',   // Ajustado para coincidir com o formulário
        'genero', 
        'bi',                // Novo campo
        'naturalidade',      // Novo campo
        'provincia_natural', // Novo campo
        'telefone', 
        'email', 
        'endereco', 
        'nome_responsavel', 
        'telefone_responsavel',
        'id_provincia', 
        'id_municipio', 
        'id_comuna'
    ];

    // Regras de validação
    protected $validationRules = [
        'nome' => 'required|min_length[3]',
        // Removi a obrigatoriedade estrita de localização aqui para evitar erros 
        // caso você queira salvar apenas os dados básicos primeiro.
    ];

    /**
     * Busca alunos com os nomes das localidades e turmas
     * Incluindo os novos campos de identificação
     */
    public function getAlunosComLocalizacao($id_turma = null)
    {
        // O alunos.* garante que bi, naturalidade e data_nascimento sejam selecionados
        $builder = $this->select('alunos.*, p.nome as provincia_nome, m.nome as municipio_nome, c.nome as comuna_nome, t.nome_turma, t.periodo')
            ->join('provincias p', 'p.id_provincia = alunos.id_provincia', 'left')
            ->join('municipios m', 'm.id_municipio = alunos.id_municipio', 'left')
            ->join('comunas c', 'c.id_comuna = alunos.id_comuna', 'left')
            ->join('matriculas mat', 'mat.id_aluno = alunos.id_aluno', 'left')
            ->join('turmas t', 't.id_turma = mat.id_turma', 'left');

        if ($id_turma) {
            $builder->where('mat.id_turma', $id_turma);
        }

        return $builder->findAll();
    }
}