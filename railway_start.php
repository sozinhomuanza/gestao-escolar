<?php
/**
 * Railway Startup Fix - CodeIgniter 4
 * Este arquivo resolve o problema do proxyIPs antes de carregar o framework
 */

// Definir que estamos em ambiente de produção
define('ENVIRONMENT', 'production');

// Caminhos
 = __DIR__ . '/system';
 = __DIR__ . '/app';
 = __DIR__ . '/writable';

// Verificar se a pasta writable tem permissão
if (!is_writable()) {
    chmod(, 0777);
}

// ============================================
// HOTFIX: Corrigir a classe App antes de tudo
// ============================================
 =  . '/Config/App.php';
 = file_get_contents();

// Verificar se já tem a propriedade proxyIPs
if (strpos(, 'public ') === false) {
    // Adicionar a propriedade antes do último }
     = preg_replace(
        '/\n\}/',
        "\n    public \ = '';\n}",
        
    );
    file_put_contents(, );
    echo "✓ Hotfix aplicado no App.php: propriedade proxyIPs adicionada\n";
}

// ============================================
// HOTFIX: Corrigir o Request.php em tempo real
// ============================================
 =  . '/HTTP/Request.php';
 = file_get_contents();

// Substituir a linha problemática
 = str_replace(
    '->proxyIPs = ->proxyIPs;',
    '->proxyIPs = isset(->proxyIPs) ? ->proxyIPs : \'\';',
    
);

// Backup do arquivo original
copy(,  . '.bak');

// Salvar o arquivo modificado
file_put_contents(, );
echo "✓ Hotfix aplicado no Request.php: linha 58 modificada\n";

// ============================================
// Iniciar o servidor PHP
// ============================================
echo "\n🚀 Iniciando servidor PHP na porta: " . getenv('PORT') . "\n";
echo "📁 Diretório público: " . __DIR__ . "/public\n";
echo "========================================\n\n";

// Executar o servidor PHP
passthru('php -S 0.0.0.0:' . getenv('PORT') . ' -t public');
