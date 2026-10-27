<?php
require 'inicio.php';

// 1. Só aceita o envio do formulário com o token correto.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    voltar('Abra o formulário de cadastro.', 'cadastro');
}
if (!hash_equals($_SESSION['token'], $_POST['token'] ?? '')) {
    voltar('Recarregue a página e tente novamente.', 'cadastro');
}

// 2. Recebe os dados digitados no HTML.
$nome = trim($_POST['nome'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$senha = $_POST['senha'] ?? '';
$confirmacao = $_POST['confirmacao'] ?? '';

// 3. Confere os dados antes de salvar.
if (!preg_match('/^[A-Za-z0-9_]{3,24}$/', $nome)) {
    voltar('Use de 3 a 24 letras, números ou _ no nome.', 'cadastro');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
    voltar('Digite um e-mail válido.', 'cadastro');
}
if (strlen($senha) < 8 || strlen($senha) > 72 || str_contains($senha, "\0")) {
    voltar('A senha deve ter de 8 a 72 bytes.', 'cadastro');
}
if ($senha !== $confirmacao) {
    voltar('As senhas não coincidem.', 'cadastro');
}

require 'conexao.php';

// 4. Transforma a senha em um hash. A senha original não fica no banco.
$senhaProtegida = password_hash($senha, PASSWORD_DEFAULT);

// 5. CREATE: o INSERT cadastra uma nova linha na tabela.
try {
    $sql = 'INSERT INTO public.usuarios_escola (nome, email, senha) VALUES (:nome, :email, :senha)';
    $comando = $pdo->prepare($sql);
    $comando->execute(['nome' => $nome, 'email' => $email, 'senha' => $senhaProtegida]);
} catch (PDOException $erro) {
    if ($erro->getCode() === '23505') {
        voltar('Este nome ou e-mail já está cadastrado.', 'cadastro');
    }
    voltar('Não foi possível cadastrar. Confira se importou o arquivo banco/database.sql.', 'cadastro');
}

voltar('Cadastro realizado! Agora entre com seu e-mail e sua senha.');
