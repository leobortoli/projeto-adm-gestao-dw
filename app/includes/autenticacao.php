<?php
// Projeto Final - Painel ENADE - Grupo 02
// Guarda das páginas internas (Aula 12, slide 21): quem não fez login volta para o login.
// Incluir no topo de cada página protegida, depois do conexao.php (que abre a sessão):
//   require __DIR__ . '/includes/conexao.php';        (páginas em app/)
//   require __DIR__ . '/includes/autenticacao.php';
//   require __DIR__ . '/../includes/conexao.php';     (páginas em app/acoes/)
//   require __DIR__ . '/../includes/autenticacao.php';
// Murilo Alves

if (!isset($_SESSION['usuario_id'])) {
    //Endereço do login (funciona em app/ e em app/acoes/):
    $pastaDaPagina = dirname($_SERVER['SCRIPT_NAME']);
    if (basename($pastaDaPagina) == 'acoes') {
        $pastaDaPagina = dirname($pastaDaPagina);
    }
    header('Location: ' . rtrim($pastaDaPagina, '/') . '/login.php?bloqueado=1');
    exit;
}
