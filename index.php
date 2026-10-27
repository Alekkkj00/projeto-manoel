<?php
require 'inicio.php';

// Quem já entrou vai direto para a área do jogador.
if (isset($_SESSION['id'])) {
    header('Location: painel.php');
    exit;
}

// A mesma tela HTML pode mostrar login ou cadastro.
$tela = 'login';
if (isset($_GET['tela']) && $_GET['tela'] === 'cadastro') {
    $tela = 'cadastro';
}

$mensagem = $_SESSION['mensagem'] ?? '';
unset($_SESSION['mensagem']);
require 'tela.php';
