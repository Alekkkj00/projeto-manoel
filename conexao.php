<?php
// Preencha estes dados usando Supabase > Connect > Session pooler.
$host = 'aws-1-us-west-2.pooler.supabase.com';
$porta = '5432';
$banco = 'postgres';
$usuario = 'postgres.zqjhxobjizcjwzuyykgc';
$senhaBanco = 'Akulate1089!';
$ssl = 'require';

// PDO é a ferramenta do PHP que faz a conexão com o banco de dados.
try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$porta;dbname=$banco;sslmode=$ssl;connect_timeout=5",
        $usuario,
        $senhaBanco,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
    );
} catch (PDOException $erro) {
    http_response_code(503);
    exit('Não foi possível conectar ao banco. Confira os dados em conexao.php.');
}
