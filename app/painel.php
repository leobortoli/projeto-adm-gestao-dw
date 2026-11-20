<?php
// Projeto Final - Painel ENADE - Grupo 02
// Painel: filtro de oferta e edição, mostrando o resultado ENADE que está no banco.
// Murilo Alves (base). Falta: cards, barras, histórico e ações (resto do grupo).

//Só entra quem fez login:
require __DIR__ . '/includes/conexao.php';
require __DIR__ . '/includes/autenticacao.php';

const ORIGEM_OFICIAL = 'OFICIAL_INEP';

//Ofertas do recorte (se a oferta da URL não existir, usa a primeira):
$ofertas = $conexao->query('SELECT id, curso, grau_academico, modalidade FROM ofertas ORDER BY id')->fetch_all(MYSQLI_ASSOC);
$idOferta = $_GET['oferta'] ?? '';
if (!in_array($idOferta, array_column($ofertas, 'id'))) {
    $idOferta = $ofertas[0]['id'];
}

//Edições (anos) da oferta, da mais nova para a mais antiga:
$consulta = $conexao->prepare('SELECT ano FROM resultados WHERE oferta_id = ? ORDER BY ano DESC');
$consulta->bind_param('s', $idOferta);
$consulta->execute();
$anos = array_column($consulta->get_result()->fetch_all(MYSQLI_ASSOC), 'ano');

//Sem ano na URL, mostra a edição mais nova:
$anoEscolhido = (int) ($_GET['ano'] ?? $anos[0]);

//Resultado da oferta e da edição escolhidas:
$consulta = $conexao->prepare('SELECT * FROM resultados WHERE oferta_id = ? AND ano = ?');
$consulta->bind_param('si', $idOferta, $anoEscolhido);
$consulta->execute();
$resultado = $consulta->get_result()->fetch_assoc();

//Participação = participantes / inscritos * 100:
$participacao = 'Não disponível';
if ($resultado && $resultado['inscritos'] > 0) {
    $participacao = number_format($resultado['participantes'] / $resultado['inscritos'] * 100, 2, ',', '.') . '%';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel ENADE</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="painel.php">Painel ENADE</a>
            <span class="navbar-text ms-auto me-3">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
            <a class="btn btn-outline-light btn-sm" href="logout.php">Sair</a>
        </div>
    </nav>

    <main class="container pb-5">
        <h1 class="h3 mb-3">Painel de indicadores ENADE</h1>

        <!-- Filtros: -->
        <form class="card card-body mb-4" method="get">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-6">
                    <label class="form-label" for="oferta">Oferta</label>
                    <select class="form-select" id="oferta" name="oferta">
                        <?php foreach ($ofertas as $oferta): ?>
                            <option value="<?= htmlspecialchars($oferta['id']) ?>" <?= $oferta['id'] == $idOferta ? 'selected' : '' ?>>
                                <?= htmlspecialchars($oferta['curso'] . ' - ' . $oferta['grau_academico'] . ' - ' . $oferta['modalidade']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label" for="ano">Edição</label>
                    <select class="form-select" id="ano" name="ano">
                        <?php foreach ($anos as $ano): ?>
                            <option value="<?= $ano ?>" <?= $ano == $anoEscolhido ? 'selected' : '' ?>><?= $ano ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <button class="btn btn-primary w-100" type="submit">Consultar</button>
                </div>
            </div>
        </form>

        <!-- Resultado: -->
        <?php if (!$resultado): ?>
            <div class="alert alert-secondary">Sem dados para esta oferta/edição.</div>
        <?php else: ?>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <strong><?= htmlspecialchars($idOferta) ?> - <?= $resultado['ano'] ?></strong>
                    <?php if ($resultado['origem_dado'] == ORIGEM_OFICIAL): ?>
                        <span class="badge text-bg-success">Oficial (Inep)</span>
                    <?php else: ?>
                        <span class="badge text-bg-warning">Simulado didático</span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr><th>Conceito ENADE contínuo</th><td><?= number_format($resultado['conceito_continuo'], 4, ',', '.') ?></td></tr>
                        <tr><th>Conceito ENADE faixa</th><td><?= htmlspecialchars($resultado['conceito_faixa']) ?></td></tr>
                        <tr><th>Participação</th><td><?= $participacao ?> (<?= $resultado['participantes'] ?> de <?= $resultado['inscritos'] ?>)</td></tr>
                        <tr><th>Formação Geral</th><td><?= number_format($resultado['nota_formacao_geral'], 2, ',', '.') ?></td></tr>
                        <tr><th>Componente Específico</th><td><?= number_format($resultado['nota_componente_especifico'], 2, ',', '.') ?></td></tr>
                        <tr><th>Ponto forte</th><td><?= htmlspecialchars($resultado['ponto_forte']) ?></td></tr>
                        <tr><th>Ponto de atenção</th><td><?= htmlspecialchars($resultado['ponto_atencao']) ?></td></tr>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
