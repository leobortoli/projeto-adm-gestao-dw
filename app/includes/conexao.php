<?php
// Projeto Final - Painel ENADE - Grupo 02
// Conexão com o banco (incluída no topo das páginas com require __DIR__ . '/includes/conexao.php').
// Murilo Alves

//Dados do banco (padrão do XAMPP: root sem senha; troque se o seu for diferente):
$servidor = 'localhost';
$usuarioBanco = 'root';
$senhaBanco = '';
$nomeBanco = 'painel_enade';

//Conexão:
session_start();
$conexao = new mysqli($servidor, $usuarioBanco, $senhaBanco, $nomeBanco);
$conexao->set_charset('utf8mb4');
