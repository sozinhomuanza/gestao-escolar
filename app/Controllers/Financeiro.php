<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Financeiro extends BaseController
{
    protected $db;

    // Valor fixo da propina/matrícula — altere aqui quando necessário
    const VALOR_PROPINA = '500,00 Kz';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Lista alunos por turma com filtro
     */
    public function lista_por_turma($id_turma = null)
    {
        $data['turmas'] = $this->db->table('turmas')
                                   ->orderBy('nome_turma', 'ASC')
                                   ->get()
                                   ->getResultArray();

        $data['id_turma_selecionada'] = $id_turma;
        $data['alunos'] = [];
        $data['titulo'] = 'Gerar Guia por Turma';

        if ($id_turma) {
            $builder = $this->db->table('matriculas');
            $builder->select('
                alunos.id_aluno,
                alunos.nome,
                matriculas.referencia_pagamento as rupe,
                turmas.nome_turma,
                turmas.classe
            ');
            $builder->join('alunos', 'alunos.id_aluno = matriculas.id_aluno');
            $builder->join('turmas', 'turmas.id_turma = matriculas.id_turma');
            $builder->where('matriculas.id_turma', $id_turma);
            $builder->orderBy('alunos.nome', 'ASC');

            $data['alunos'] = $builder->get()->getResultArray();
        }

        return view('financeiro/lista_por_turma', $data);
    }

    /**
     * Guia Individual — busca o RUPE directamente da BD (ignora parâmetro da URL)
     */
    public function imprimir_guia($id_aluno, $numero_rupe = null)
    {
        $builder = $this->db->table('matriculas');
        $builder->select('
            alunos.nome,
            turmas.nome_turma,
            turmas.classe,
            matriculas.data_inscricao,
            matriculas.referencia_pagamento
        ');
        $builder->join('alunos', 'alunos.id_aluno = matriculas.id_aluno');
        $builder->join('turmas', 'turmas.id_turma = matriculas.id_turma');
        $builder->where('matriculas.id_aluno', $id_aluno);
        $builder->orderBy('matriculas.id_matricula', 'DESC');

        $resultado = $builder->get()->getRowArray();

        if (!$resultado) {
            return redirect()->to('financeiro/lista_por_turma')
                             ->with('erro', 'Dados não encontrados.');
        }

        // RUPE: sempre usa o valor da BD; parâmetro URL mantido apenas como fallback de compatibilidade
        $rupe_final = !empty($resultado['referencia_pagamento'])
                      ? $resultado['referencia_pagamento']
                      : ($numero_rupe ? urldecode($numero_rupe) : null);

        $data = [
            'aluno'        => $resultado,
            'rupe'         => $rupe_final ?? '---',
            'data_emissao' => date('d/m/Y H:i'),
            'titulo'       => 'GUIA DE PAGAMENTO - RUPE',
            'servico'      => 'Taxa de Matrícula / Propina',
            'valor'        => self::VALOR_PROPINA,
        ];

        return view('financeiro/guia_pdf', $data);
    }

    /**
     * Guia em Lote (Toda a Turma)
     */
    public function imprimir_lote($id_turma)
    {
        $builder = $this->db->table('matriculas');
        $builder->select('
            alunos.nome,
            turmas.nome_turma,
            turmas.classe,
            matriculas.referencia_pagamento as rupe,
            matriculas.data_inscricao
        ');
        $builder->join('alunos', 'alunos.id_aluno = matriculas.id_aluno');
        $builder->join('turmas', 'turmas.id_turma = matriculas.id_turma');
        $builder->where('matriculas.id_turma', $id_turma);
        $builder->orderBy('alunos.nome', 'ASC');

        $alunos = $builder->get()->getResultArray();

        if (empty($alunos)) {
            return redirect()->back()->with('erro', 'Nenhum aluno nesta turma.');
        }

        $data = [
            'lista_alunos' => $alunos,
            'data_emissao' => date('d/m/Y H:i'),
            'titulo'       => 'GUIAS EM LOTE — ' . $alunos[0]['nome_turma'],
            'servico'      => 'Taxa de Matrícula / Propina',
            'valor'        => self::VALOR_PROPINA,
        ];

        return view('financeiro/guia_lote_pdf', $data);
    }
}
