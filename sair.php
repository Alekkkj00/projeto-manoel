<?php
require 'inicio.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['token'], $_POST['token'] ?? '')) {
    voltar('Recarregue a página antes de sair.');
}

// Apaga os dados da sessão e volta para a tela de login.
$_SESSION = [];
session_destroy();
header('Location: index.php');
exit;
