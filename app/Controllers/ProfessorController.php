<?php

namespace App\Controllers;

use App\Models\ProfessorModel; // Certifique-se de ter este Model criado

class ProfessorController extends BaseController
{
    private $professor_model;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->professor_model = new ProfessorModel();
        
        // Mantendo sua lógica de proteção
        // Certifique-se de que o método 'proteger' está definido no seu BaseController
        $this->proteger(['admin', 'professor']); 
    }

    public function index()
    {
        // Esta é a lista que será exibida antes de exportar
        $data['professores']   = $this->professor_model->findAll();
        $data['titulo_pagina'] = 'Lista de Professores';

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('professores/index', $data); // Certifique-se de que a view existe neste caminho
        echo view('templates/footer');
    }

    public function dashboard()
    {
        $data['titulo_pagina'] = 'Painel do Professor';
        
        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('professor/dashboard');
        echo view('templates/footer');
    }
}