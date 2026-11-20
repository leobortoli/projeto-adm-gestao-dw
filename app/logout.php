<?php
// Projeto Final - Painel ENADE - Grupo 02
// Logout: encerra a sessão e volta ao login (Aula 12, slide 22).
// Murilo Alves

session_start();
session_unset();
session_destroy();
header('Location: login.php?saiu=1');
exit;
