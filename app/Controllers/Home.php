<?php

namespace App\Controllers;

use App\Models\AlunoModel;
use App\Models\ProfessorModel;

class Home extends BaseController
{
    public function index()
    {
        $alunoModel = new AlunoModel();
        $professorModel = new ProfessorModel();

        // Criamos o array de dados para a View
        $data = [
            'total_de_alunos'      => $alunoModel->countAll(),
            'total_de_professores' => $professorModel->countAll(),
            
            // Se tiveres uma tabela para funcionários/staff, substitui o 4 por: 
            // $staffModel->countAll()
            'total_staff'          => 4, 
            'total_de_turmas'      => 2,
            'total_de_disciplinas' => 2,
            
            // Dados para a tabela de alunos recentes
            'ultimos_alunos'       => $alunoModel->getRecentes(5),
            
            // Dados para o Gráfico (passando os totais para o JavaScript)
            'dados_grafico'        => [
                $alunoModel->countAll(), 
                $professorModel->countAll(), 
                2, // Turmas
                2  // Disciplinas
            ]
        ];

        // IMPORTANTE: Se o teu arquivo se chama 'inicio.php', usa 'inicio'
        return view('inicio', $data); 
    }
}