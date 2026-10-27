<?php
require 'inicio.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    voltar('Abra o formulário de login.');
}
if (!hash_equals($_SESSION['token'], $_POST['token'] ?? '')) {
    voltar('Recarregue a página e tente novamente.');
}

$email = strtolower(trim($_POST['email'] ?? ''));
$senha = $_POST['senha'] ?? '';
require 'conexao.php';

// SELECT procura o usuário pelo e-mail. O valor é enviado separadamente do SQL.
try {
    $comando = $pdo->prepare('SELECT id, nome, senha FROM public.usuarios_escola WHERE email = :email');
    $comando->execute(['email' => $email]);
    $jogador = $comando->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    voltar('Não foi possível consultar o banco. Confira a conexão e a tabela.');
}

// password_verify compara a senha digitada com o hash salvo no cadastro.
if (!$jogador || !password_verify($senha, $jogador['senha'])) {
    voltar('E-mail ou senha incorretos.');
}

// A sessão lembra qual jogador está conectado entre uma página e outra.
session_regenerate_id(true);
$_SESSION['id'] = $jogador['id'];
$_SESSION['nome'] = $jogador['nome'];
header('Location: painel.php');
exit;
