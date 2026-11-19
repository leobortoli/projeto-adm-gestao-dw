<?php
// Projeto Final - Painel ENADE - Grupo 02
// Página inicial: manda para o painel se já entrou, senão para o login.
// Murilo Alves

session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: painel.php');
} else {
    header('Location: login.php');
}
exit;
