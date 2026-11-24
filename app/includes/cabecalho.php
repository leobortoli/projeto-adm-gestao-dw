<?php
// Cabeçalho compartilhado: abre o HTML, carrega os estilos e mostra a barra de navegação.
// Antes de dar require, a página pode definir $tituloPagina.
$tituloPagina = $tituloPagina ?? 'Painel ENADE';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($tituloPagina) ?></title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="painel.php">Painel ENADE</a>
            <span class="navbar-text ms-auto me-3">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
            <a class="btn btn-outline-light btn-sm" href="logout.php">Sair</a>
        </div>
    </nav>