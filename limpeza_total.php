<?php
// Arquivo: limpeza_total.php
echo "<h1>🚀 LIMPEZA TOTAL DO CACHE - CodeIgniter 4</h1>";

function limparPasta($pasta) {
    if (!is_dir($pasta)) {
        echo "❌ Pasta não encontrada: $pasta<br>";
        return;
    }
    
    $arquivos = glob($pasta . '/*');
    $contador = 0;
    
    foreach ($arquivos as $arquivo) {
        if (is_file($arquivo)) {
            if (unlink($arquivo)) {
                $contador++;
                echo "✅ Removido: " . basename($arquivo) . "<br>";
            }
        }
    }
    
    echo "<strong>📊 Total de $contador arquivos removidos de $pasta</strong><br><br>";
}

// Pastas para limpar
$pastas = [
    'writable/cache',
    'writable/session',
    'writable/logs',
    'writable/debugbar'
];

foreach ($pastas as $pasta) {
    limparPasta($pasta);
}

// Limpar cache de configuração específico do CodeIgniter
$configCache = 'writable/cache/Config/';
if (is_dir($configCache)) {
    limparPasta($configCache);
}

echo "<h2 style='color:green;'>✅ LIMPEZA CONCLUÍDA!</h2>";

echo "<h3>Próximos passos:</h3>";
echo "<ol>";
echo "<li><a href='/projeto-escola/'>Ir para o sistema</a></li>";
echo "<li><a href='/projeto-escola/teste-auth'>Testar rota pública</a></li>";
echo "<li><a href='/projeto-escola/login'>Fazer login</a></li>";
echo "</ol>";

// Mostrar configuração atual
echo "<h3>Configuração Atual dos Filtros:</h3>";
require_once 'app/Config/Filters.php';
$filters = new Config\Filters();

echo "<pre>";
echo "Aliases disponíveis:\n";
print_r(array_keys($filters->aliases));
echo "</pre>";

if (isset($filters->aliases['auth'])) {
    echo "<p style='color:green; font-size:18px;'>✅ ALIAS 'auth' ENCONTRADO!</p>";
    echo "<p>Classe: " . $filters->aliases['auth'] . "</p>";
    
    // Verifica se o arquivo existe
    $arquivoFiltro = 'app/Filters/AuthFilter.php';
    if (file_exists($arquivoFiltro)) {
        echo "<p style='color:green;'>✅ Arquivo do filtro encontrado!</p>";
    } else {
        echo "<p style='color:red;'>❌ Arquivo do filtro NÃO encontrado!</p>";
    }
} else {
    echo "<p style='color:red; font-size:18px;'>❌ ALIAS 'auth' NÃO ENCONTRADO!</p>";
}
?>