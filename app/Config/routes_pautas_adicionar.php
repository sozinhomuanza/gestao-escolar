/*
|--------------------------------------------------------------------------
| MINI PAUTAS / NOTAS  ←  adicionar ao Config/Routes.php existente
|--------------------------------------------------------------------------
*/
$routes->group('pautas', function ($routes) {
    $routes->get('/',               'Pautas::index');
    $routes->get('index',           'Pautas::index');
    $routes->get('lancar/(:num)',   'Pautas::lancar/$1');
    $routes->post('salvar',         'Pautas::salvar');
    $routes->get('ver/(:num)',      'Pautas::ver/$1');
    $routes->get('imprimir/(:num)', 'Pautas::imprimir/$1');
});
