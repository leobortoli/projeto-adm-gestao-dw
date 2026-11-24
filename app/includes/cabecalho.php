<?php
// Cabeçalho compartilhado: abre o HTML, carrega os estilos e mostra a barra de navegação.
// Antes de dar require, a página pode definir $tituloPagina.
$tituloPagina = $tituloPagina ?? 'Painel ENADE';
$paginaAtual = basename($_SERVER['PHP_SELF']);
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
    <nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="painel.php">Painel ENADE</a>
            <ul class="navbar-nav me-auto">
                <!-- Para uma página nova, copie um <li> e troque o arquivo e o texto: -->
                <li class="nav-item">
                    <a class="nav-link <?= $paginaAtual == 'painel.php' ? 'active' : '' ?>" href="painel.php">Painel</a>
                </li>
            </ul>
            <span class="navbar-text me-3">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
            <a class="btn btn-outline-light btn-sm" href="logout.php">Sair</a>
        </div>
    </nav>