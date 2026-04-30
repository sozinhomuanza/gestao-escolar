<?php

namespace App\Controllers;

// Importante: use o nome exato do arquivo que está em App/Models
use App\Models\AlunosModel; 
use App\Models\TrabalhadorModel;
use App\Models\TurmaModel;
use App\Models\DisciplinaModel;
use App\Models\NotaModel;

class Inicio extends BaseController
{
    public function index()
    {
        if (!session()->get('logado')) {
            return redirect()->to(base_url('login'));
        }

        $perfil = strtolower(session()->get('perfil') ?? '');

        if (in_array($perfil, ['professor', 'professora'])) {
            return $this->painelProfessor();
        }

        if (in_array($perfil, ['director', 'directora', 'diretor', 'diretora'])) {
            return $this->painelDirector();
        }

        return $this->dashboardGeral();
    }

    // ── DASHBOARD GERAL (Admin, Secretário) ──────────────────
    private function dashboardGeral()
    {
        $db = db_connect();
        
        // Ajustado para AlunosModel (plural)
        $alunoModel = new AlunosModel();

        $data['total_de_alunos'] = $alunoModel->countAllResults();

        $data['total_de_professores'] = (new TrabalhadorModel())
            ->groupStart()
                ->where('funcao','Professor')
                ->orWhere('funcao','Professora')
            ->groupEnd()
            ->countAllResults();

        $data['total_trabalhadores']  = (new TrabalhadorModel())->countAllResults();
        $data['total_de_turmas']      = (new TurmaModel())->countAllResults();
        $data['total_de_disciplinas'] = (new DisciplinaModel())->countAllResults();
        $data['matriculas_pendentes'] = $db->table('matriculas')->where('status','Pendente')->countAllResults();

        return view('templates/header')
             . view('templates/sidebar')
             . view('inicio/index', $data)
             . view('templates/footer');
    }

    // ── PAINEL DO DIRECTOR ───────────────────────────────────
    private function painelDirector()
    {
        $db = db_connect();
        $alunoModel = new AlunosModel();

        $total_de_professores = (new TrabalhadorModel())
            ->groupStart()
                ->where('funcao','Professor')
                ->orWhere('funcao','Professora')
            ->groupEnd()
            ->countAllResults();

        $data = [
            'total_de_alunos'      => $alunoModel->countAllResults(),
            'total_de_professores' => $total_de_professores,
            'total_trabalhadores'  => (new TrabalhadorModel())->countAllResults(),
            'total_de_turmas'      => (new TurmaModel())->countAllResults(),
            'total_de_disciplinas' => (new DisciplinaModel())->countAllResults(),
            'matriculas_pendentes' => $db->table('matriculas')->where('status','Pendente')->countAllResults(),
        ];

        return view('templates/header')
             . view('templates/sidebar')
             . view('inicio/director', $data)
             . view('templates/footer');
    }

    // ── PAINEL DO PROFESSOR ──────────────────────────────────
    private function painelProfessor()
    {
        $notaModel        = new NotaModel();
        $trabalhadorModel = new TrabalhadorModel();

        $trabalhador = $trabalhadorModel
            ->where('email', session()->get('email_usuario'))
            ->first();

        $turmas  = [];
        $alertas = [];
        $trimestre_atual = $this->trimestreAtual();

        if ($trabalhador) {
            $turmas = $notaModel->getTurmasProfessor($trabalhador['id_trabalhador']);

            foreach ($turmas as &$t) {
                $s = $notaModel->getEstatisticas($t['id_turma'], $t['id_disciplina'], $trimestre_atual);
                $t['stats']     = $s;
                $t['trimestre'] = $trimestre_atual;

                if ($s['nao_avaliados'] > 0) {
                    $alertas[] = [
                        'turma' => $t['nome_turma'],
                        'sem'   => $s['nao_avaliados'],
                        'total' => $s['total_alunos'],
                        'url'   => base_url("pautas/lancar/{$t['id_turma']}?trimestre={$trimestre_atual}"),
                    ];
                }
            }
            unset($t);
        }

        $data = [
            'trabalhador'     => $trabalhador,
            'turmas'          => $turmas,
            'alertas'         => $alertas,
            'trimestre_atual' => $trimestre_atual,
        ];

        return view('templates/header')
             . view('templates/sidebar')
             . view('inicio/professor', $data)
             . view('templates/footer');
    }

    private function trimestreAtual(): int
    {
        $mes = (int)date('n');
        if ($mes <= 4) return 1;
        if ($mes <= 8) return 2;
        return 3;
    }
}