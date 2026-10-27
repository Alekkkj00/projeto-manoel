<?php
require 'inicio.php';

// Protege a página: sem login, o visitante volta para a tela inicial.
if (!isset($_SESSION['id'])) {
    voltar('Faça login para acessar a área do jogador.');
}

$tela = 'painel';
$mensagem = '';
require 'tela.php';
