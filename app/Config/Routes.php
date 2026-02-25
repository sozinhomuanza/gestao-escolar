<?php

namespace Config;

// Cria uma nova instância da classe RouteCollection para gerenciar as rotas.
$routes = Services::routes();

/**
 * ─────────────────────────────────────────────────────────────
 * CONFIGURAÇÕES GERAIS DO SISTEMA DE ROTAS
 * ─────────────────────────────────────────────────────────────
 */

// Carrega o arquivo de rotas do sistema padrão do CodeIgniter se ele existir.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Define o Namespace padrão onde os Controllers estão localizados.
$routes->setDefaultNamespace('App\Controllers');

// Define qual Controller e Método carregar quando a URL estiver vazia.
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');

// Se definido como false, não converte hífens em CamelCase automaticamente (ex: lancar-notas -> lancarNotas).
$routes->setTranslateURIDashes(false);

// Define o comportamento para erro 404 (Página não encontrada).
$routes->set404Override();

// Segurança: Se false, o sistema só acessa URLs explicitamente declaradas neste arquivo.
$routes->setAutoRoute(false);

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: AUTENTICAÇÃO E ACESSO
 * ─────────────────────────────────────────────────────────────
 */
$routes->get('/',                 'Login::index');       // Página inicial (Redireciona para Login)
$routes->get('login',             'Login::index');       // Tela de login
$routes->post('login/autenticar', 'Login::autenticar');  // Processamento do formulário de login
$routes->get('login/logout',      'Login::logout');      // Encerramento de sessão
$routes->get('login/trocarsenha', 'Login::trocarSenha'); // Tela de alteração de senha
$routes->post('login/store',      'Login::storeSenha');  // Gravação da nova senha

// Página principal após login bem-sucedido.
$routes->get('inicio', 'Inicio::index');

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: LOCALIZAÇÃO (Requisições AJAX)
 * ─────────────────────────────────────────────────────────────
 */
$routes->get('localizacao/municipios/(:num)', 'Localizacao::municipios/$1'); // Busca municípios por ID
$routes->get('localizacao/comunas/(:num)',    'Localizacao::comunas/$1');    // Busca comunas por ID

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: GESTÃO DE ALUNOS
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('alunos', function ($routes) {
    $routes->get('/',              'Alunos::index');      // Listagem geral
    $routes->get('index',          'Alunos::index');      // Listagem geral (alias)
    $routes->get('novo',           'Alunos::novo');       // Formulário de cadastro
    $routes->post('store',         'Alunos::store');      // Salvar novo aluno
    $routes->get('editar/(:num)',  'Alunos::editar/$1');  // Editar dados do aluno
    $routes->post('update',        'Alunos::update');     // Atualizar dados do aluno
    $routes->post('excluir',       'Alunos::excluir');    // Remover aluno
    $routes->get('excel',          'Alunos::excel');      // Exportação para Excel
    $routes->get('imprimir',       'Alunos::imprimir');   // Relatório de impressão
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: GESTÃO DE TRABALHADORES (Professores e Secretários)
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('trabalhadores', function ($routes) {
    $routes->get('/',              'Trabalhadores::index');       // Listagem geral
    $routes->get('index',          'Trabalhadores::index');
    $routes->get('professores',    'Trabalhadores::professores'); // Apenas professores
    $routes->get('secretarios',    'Trabalhadores::secretarios'); // Apenas secretários
    $routes->get('novo',           'Trabalhadores::novo');        // Novo cadastro
    $routes->post('store',         'Trabalhadores::store');       // Salvar no BD
    $routes->post('update',        'Trabalhadores::update');      // Atualizar no BD
    $routes->get('editar/(:num)',  'Trabalhadores::editar/$1');   // Tela de edição
    $routes->post('excluir',       'Trabalhadores::excluir');     // Excluir registro
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: DISCIPLINAS E CURRÍCULO
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('disciplinas', function ($routes) {
    $routes->get('/',              'Disciplinas::index');
    $routes->get('novo',           'Disciplinas::novo');
    $routes->post('store',         'Disciplinas::store');
    $routes->get('editar/(:num)',  'Disciplinas::editar/$1');
    $routes->post('update',        'Disciplinas::update');
    $routes->post('excluir',       'Disciplinas::excluir');
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: GESTÃO DE SALAS
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('salas', function ($routes) {
    $routes->get('/',              'Salas::index');
    $routes->get('novo',           'Salas::novo');
    $routes->post('store',         'Salas::store');
    $routes->get('editar/(:num)',  'Salas::editar/$1');
    $routes->post('update',        'Salas::update');
    $routes->post('excluir',       'Salas::excluir');
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: GESTÃO DE PAUTAS (Lançamento de notas por Turma)
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('pautas', function ($routes) {
    $routes->get('/',               'Pautas::index');       // Seleção de turmas
    $routes->get('lancar/(:num)',   'Pautas::lancar/$1');   // Tela de lançamento por ID da pauta
    $routes->post('salvar',         'Pautas::salvar');      // Salvar notas da pauta
    $routes->get('ver/(:num)',      'Pautas::ver/$1');      // Visualizar pauta pronta
    $routes->get('imprimir/(:num)', 'Pautas::imprimir/$1'); // Gerar PDF da pauta
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: GESTÃO DE TURMAS E MATRÍCULAS
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('turmas', function ($routes) {
    $routes->get('/',                   'Turmas::index');            // Listagem de turmas
    $routes->get('novo',                'Turmas::novo');             // Criar nova turma
    $routes->post('store',              'Turmas::store');            // Salvar turma
    $routes->get('editar/(:num)',       'Turmas::editar/$1');        // Editar turma
    $routes->post('update',             'Turmas::update');           // Atualizar turma
    $routes->get('detalhes/(:num)',     'Turmas::detalhes/$1');      // Ver alunos da turma
    $routes->get('matricular',          'Turmas::matricular');       // Tela de matrícula de aluno
    $routes->post('salvar_matricula',   'Turmas::salvarMatricula');  // Processar matrícula
    $routes->get('confirmar/(:num)',    'Turmas::confirmar/$1');     // Confirmar matrícula ativa
    $routes->post('excluir',            'Turmas::excluir');          // Remover turma
    // Adicione isto junto às suas outras rotas de relatórios
$routes->get('relatorios/presenca/(:num)', 'Relatorios::presenca/$1');
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: GESTÃO DE USUÁRIOS DO SISTEMA
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('usuarios', function ($routes) {
    $routes->get('/',              'Usuarios::index');
    $routes->get('novo',           'Usuarios::novo');
    $routes->post('store',         'Usuarios::store');
    $routes->get('editar/(:num)',  'Usuarios::editar/$1');
    $routes->post('update',        'Usuarios::update');
    $routes->post('excluir',       'Usuarios::excluir');
    $routes->post('toggle_ativo',  'Usuarios::toggleAtivo'); // Ativar/Desativar acesso
});

/**
 * ─────────────────────────────────────────────────────────────
 * MÓDULO: DOCUMENTOS (Boletins, Declarações e Notas Individuais)
 * ─────────────────────────────────────────────────────────────
 */
$routes->group('documentos', function ($routes) {
    $routes->get('/',                           'Documentos::index');      // Pesquisa de alunos para documentos
    $routes->get('index',                        'Documentos::index');
    $routes->get('boletim/(:num)',               'Documentos::boletim/$1'); // Gerar boletim individual
    
    // Declarações (Suporte a múltiplos formatos de URL)
    $routes->get('declaracaoComNotas/(:num)',    'Documentos::declaracaoComNotas/$1');
    $routes->get('declaracao-com-notas/(:num)', 'Documentos::declaracaoComNotas/$1');
    
    $routes->get('declaracaoSemNotas/(:num)',    'Documentos::declaracaoSemNotas/$1');
    $routes->get('declaracao-sem-notas/(:num)', 'Documentos::declaracaoSemNotas/$1');
    
    // Lançamento de notas individual por aluno
    $routes->get('lancar-notas/(:num)',         'Documentos::lancarNotas/$1');
    $routes->post('salvar-notas',               'Documentos::salvarNotas');
});

/**
 * ─────────────────────────────────────────────────────────────
 * CARREGAMENTO DE ROTAS POR AMBIENTE (Development/Production)
 * ─────────────────────────────────────────────────────────────
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}