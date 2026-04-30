<?php

namespace App\Controllers;

use App\Models\AlunoModel;
use App\Models\ProfessorModel;
use App\Models\TurmaModel;
use App\Models\TrabalhadorModel;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // 1. PRIMEIRO PASSO: Validar a sessão. 
        // Se falhar, o método proteger() faz o exit e o código abaixo não executa.
        $this->proteger(['admin']); 

        // 2. Instanciar os Models
        $alunosModel      = new AlunoModel();
        $professoresModel = new ProfessorModel();
        $turmasModel      = new TurmaModel();
        $trabalhadorModel = new TrabalhadorModel();

        // 3. Preparar os dados para a view
        $data = [
            'total_de_alunos'      => $alunosModel->countAll(),
            'total_de_professores' => $professoresModel->countAll(),
            'total_de_turmas'      => $turmasModel->countAll(),
            'total_trabalhadores'  => $trabalhadorModel->countAll(),
            'primeiro_nome'        => session()->get('primeiro_nome') ?? 'Administrador'
        ];

        // 4. Carregar a view única (os templates serão chamados dentro dela)
        return view('admin/dashboard', $data);
    }
}