<?php
// Projeto Final - Painel ENADE - Grupo 02
// Logout: encerra a sessão.
// Murilo Alves

session_start();

//Apaga a sessão e o cookie:
$_SESSION = [];
$cookie = session_get_cookie_params();
setcookie(session_name(), '', time() - 3600, $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
session_destroy();

header('Location: login.php?saiu=1');
exit;
