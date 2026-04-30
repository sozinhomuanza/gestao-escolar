<?php

namespace App\Models;

use CodeIgniter\Model;

class AlunosModel extends Model
{
    protected $table      = 'alunos';
    protected $primaryKey = 'id_aluno';

    protected $allowedFields = [
        'nome', 
        'data_nascimento',
        'genero', 
        'bi',
        'naturalidade',
        'provincia_natural',
        'telefone', 
        'email', 
        'endereco', 
        'nome_responsavel', 
        'telefone_responsavel',
        'id_provincia', 
        'id_municipio', 
        'id_comuna'
    ];

    protected $validationRules = [
        'nome' => 'required|min_length[3]',
    ];

    /**
     * Busca alunos com localidades e turmas, com suporte a paginação.
     * Usa $this->db->table() + get() para que LIMIT/OFFSET sejam sempre respeitados.
     * (findAll() do Model CI4 ignora limit() encadeado no builder do modelo.)
     */
    public function getAlunosComLocalizacao($id_turma = null, $limit = null, $offset = 0)
    {
        $builder = $this->db->table('alunos')
            ->select('alunos.*, p.nome as provincia_nome, m.nome as municipio_nome, c.nome as comuna_nome, t.nome_turma, t.periodo')
            ->join('provincias p',   'p.id_provincia = alunos.id_provincia', 'left')
            ->join('municipios m',   'm.id_municipio = alunos.id_municipio', 'left')
            ->join('comunas c',      'c.id_comuna = alunos.id_comuna',       'left')
            ->join('matriculas mat', 'mat.id_aluno = alunos.id_aluno',       'left')
            ->join('turmas t',       't.id_turma = mat.id_turma',            'left');

        if ($id_turma) {
            $builder->where('mat.id_turma', $id_turma);
        }

        if ($limit !== null) {
            $builder->limit((int) $limit, (int) $offset);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Conta o total de alunos sem paginação, respeitando o filtro de turma.
     */
    public function contarAlunos($id_turma = null)
    {
        $builder = $this->db->table('alunos')
            ->join('matriculas mat', 'mat.id_aluno = alunos.id_aluno', 'left');

        if ($id_turma) {
            $builder->where('mat.id_turma', $id_turma);
        }

        return $builder->countAllResults();
    }
}
