<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); 

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

/**
 * MÓDULO: AUTENTICAÇÃO
 */
$routes->get('/',                 'Login::index');
$routes->get('login',             'Login::index');
$routes->post('login/autenticar', 'Login::autenticar');
$routes->get('login/logout',      'Login::logout');
$routes->get('login/trocarsenha', 'Login::trocarSenha');
$routes->post('login/store',      'Login::storeSenha');
$routes->get('inicio',            'Inicio::index');


/**
 * MÓDULO: FINANCEIRO
 */
$routes->get('financeiro/lista_por_turma',             'Financeiro::lista_por_turma');
$routes->get('financeiro/lista_por_turma/(:num)',      'Financeiro::lista_por_turma/$1');
$routes->get('financeiro/imprimir_guia/(:num)',        'Financeiro::imprimir_guia/$1');
$routes->get('financeiro/imprimir_guia/(:num)/(:any)', 'Financeiro::imprimir_guia/$1/$2');
$routes->get('financeiro/imprimir_lote/(:num)',        'Financeiro::imprimir_lote/$1');

/**
 * MÓDULO: GESTÃO ACADÊMICA E LOCALIZAÇÃO (AJAX)
 */
$routes->group('alunos', function ($routes) {
    $routes->get('/',                   'Alunos::index');
    $routes->get('index',               'Alunos::index');
    $routes->get('novo',                'Alunos::novo');
    $routes->post('store',              'Alunos::store');
    $routes->get('editar/(:num)',       'Alunos::editar/$1');
    $routes->post('update',             'Alunos::update');
    $routes->post('excluir',            'Alunos::excluir');
    
    $routes->get('getMunicipios/(:num)', 'Alunos::getMunicipios/$1');
    $routes->get('getComunas/(:num)',    'Alunos::getComunas/$1');
});

$routes->group('turmas', function ($routes) {
    $routes->get('/',                  'Turmas::index');
    $routes->get('novo',               'Turmas::novo');
    $routes->post('store',             'Turmas::store');
    $routes->get('editar/(:num)',      'Turmas::editar/$1');
    $routes->post('update',            'Turmas::update');
    $routes->get('detalhes/(:num)',    'Turmas::detalhes/$1');
    $routes->get('matricular',         'Turmas::matricular');
    $routes->post('salvar_matricula',  'Turmas::salvarMatricula');
    $routes->get('confirmar/(:num)',   'Turmas::confirmar/$1');
    $routes->post('excluir',           'Turmas::excluir');
});

/**
 * MÓDULO: INFRAESTRUTURA / SALAS
 */
$routes->group('salas', function ($routes) {
    $routes->get('/',             'Salas::index');
    $routes->get('novo',          'Salas::novo');
    $routes->post('store',        'Salas::store');
    $routes->get('editar/(:num)', 'Salas::editar/$1');
    $routes->post('update',       'Salas::update');
    $routes->post('excluir',      'Salas::excluir');
});

/**
 * MÓDULO: CURRÍCULO / DISCIPLINAS
 */
$routes->group('disciplinas', function ($routes) {
    $routes->get('/',             'Disciplinas::index');
    $routes->get('novo',          'Disciplinas::novo');
    $routes->post('store',        'Disciplinas::store');
    $routes->get('editar/(:num)', 'Disciplinas::editar/$1');
    $routes->post('update',       'Disciplinas::update');
    $routes->post('excluir',      'Disciplinas::excluir');
});

/**
 * MÓDULO: IMPORTAÇÃO DE DADOS
 */
$routes->group('importacao', function ($routes) {
    $routes->get('/',                 'Importacao::index');
    $routes->get('template/(:any)',   'Importacao::template/$1');
    $routes->post('estoqueRupe',      'Importacao::estoqueRupe');
    $routes->post('alunos',           'Importacao::alunos');
    $routes->post('staff',            'Importacao::staff');
});

/**
 * MÓDULO: TRABALHADORES / STAFF
 */
$routes->group('trabalhadores', function ($routes) {
    $routes->get('/',               'Trabalhadores::index');
    $routes->get('professores',     'Trabalhadores::professores');
    $routes->get('novo',            'Trabalhadores::novo');
    $routes->post('store',          'Trabalhadores::store');
    $routes->get('editar/(:num)',   'Trabalhadores::editar/$1');
    $routes->post('update',         'Trabalhadores::update');
    $routes->post('excluir',        'Trabalhadores::excluir');
});

/**
 * MÓDULO: PEDAGÓGICO E DOCUMENTOS
 */
$routes->group('pautas', function ($routes) {
    $routes->get('/',                    'Pautas::index');
    $routes->get('lancar/(:num)',        'Pautas::lancar/$1');
    $routes->get('lancar-notas/(:num)', 'Pautas::lancar/$1'); // ✅ alias com hífen
    $routes->post('salvar',              'Pautas::salvar');
    $routes->get('imprimir/(:num)',      'Pautas::imprimir/$1');
});

$routes->group('documentos', function ($routes) {
    $routes->get('/',                           'Documentos::index');
    $routes->get('boletim/(:num)',              'Documentos::boletim/$1');
    $routes->get('declaracaoComNotas/(:num)',   'Documentos::declaracaoComNotas/$1');
    $routes->get('declaracao-com-notas/(:num)', 'Documentos::declaracaoComNotas/$1');
    $routes->get('declaracaoSemNotas/(:num)',   'Documentos::declaracaoSemNotas/$1');
    $routes->get('declaracao-sem-notas/(:num)', 'Documentos::declaracaoSemNotas/$1');
    $routes->get('lancar-notas/(:num)',         'Pautas::lancar/$1'); // ✅ rota corrigida
});

/**
 * MÓDULO: CONFIGURAÇÕES
 */
$routes->group('usuarios', function ($routes) {
    $routes->get('/',               'Usuarios::index');
    $routes->post('store',          'Usuarios::store');
    $routes->get('editar/(:num)',   'Usuarios::editar/$1');
    $routes->post('update',         'Usuarios::update');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}