<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Testar ligação à base de dados
$host = getenv('database.default.hostname') ?: 'não definido';
$db   = getenv('database.default.database') ?: 'não definido';
$user = getenv('database.default.username') ?: 'não definido';
$pass = getenv('database.default.password') ?: 'não definido';
$port = getenv('database.default.port') ?: '3306';

echo "<h2>Variáveis de ambiente:</h2>";
echo "Host: $host<br>";
echo "DB: $db<br>";
echo "User: $user<br>";
echo "Port: $port<br>";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    echo "<h2 style='color:green'>Ligação à BD OK!</h2>";
} catch (Exception $e) {
    echo "<h2 style='color:red'>Erro BD: " . $e->getMessage() . "</h2>";
}
