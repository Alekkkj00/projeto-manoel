<?php
// Este arquivo inicia a sessão e reúne duas tarefas pequenas usadas pelas páginas.
session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax', 'use_strict_mode' => true]);

// O token confirma que o formulário foi aberto neste navegador.
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Guarda uma mensagem e volta para o formulário de login ou cadastro.
function voltar($mensagem, $tela = 'login') {
    $_SESSION['mensagem'] = $mensagem;
    header('Location: index.php?tela=' . $tela);
    exit;
}
