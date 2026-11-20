<?php
// Projeto Final - Painel ENADE - Grupo 02
// Login: formulário de login com usuário e senha guardados no banco (senha com hash).
// Murilo Alves

require __DIR__ . '/includes/conexao.php';

//Quem já entrou vai direto para o painel:
if (isset($_SESSION['usuario_id'])) {
    header('Location: painel.php');
    exit;
}

//Avisos vindos de outras páginas:
$mensagemAviso = '';
if (isset($_GET['saiu'])) {
    $mensagemAviso = 'Você saiu do sistema.';
}
if (isset($_GET['bloqueado'])) {
    $mensagemAviso = 'Entre com seu login para acessar o painel.';
}

//Conferência do login:
$mensagemErro = '';
$login = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($login == '' || $senha == '') {
        $mensagemErro = 'Informe o login e a senha.';
    } else {
        //Busca o usuário (prepared statement para evitar SQL injection):
        $consulta = $conexao->prepare('SELECT id, nome, senha FROM usuarios WHERE login = ?');
        $consulta->bind_param('s', $login);
        $consulta->execute();
        $usuario = $consulta->get_result()->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header('Location: painel.php');
            exit;
        }
        $mensagemErro = 'Login ou senha inválidos.';
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrar - Painel ENADE</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
</head>
<body class="bg-light">
    <main class="container mt-5" style="max-width: 420px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3">Painel ENADE</h1>
                <p class="text-secondary">Grupo 02 - Administração e Gestão Comercial</p>

                <?php if ($mensagemAviso != ''): ?>
                    <div class="alert alert-info"><?= $mensagemAviso ?></div>
                <?php endif; ?>
                <?php if ($mensagemErro != ''): ?>
                    <div class="alert alert-danger"><?= $mensagemErro ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label" for="login">Login</label>
                        <input class="form-control" id="login" name="login" value="<?= htmlspecialchars($login) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="senha">Senha</label>
                        <input class="form-control" id="senha" name="senha" type="password" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Entrar</button>
                </form>
                <p class="text-secondary small mt-3 mb-0">Demonstração: login <strong>demo</strong>, senha <strong>enade2026</strong>.</p>
            </div>
        </div>
    </main>
</body>
</html>
