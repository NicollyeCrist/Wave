<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo_usuario'] !== 'professor') {
    header('Location: /login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Turma - MesoMinds</title>
    <link rel="stylesheet" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" href="/mesominds/CSS/turmas.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
</head>

<body> <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <main class="container">
        <div class="page-header">
            <div class="breadcrumb">
                <a href="/mesominds/turmas">Turmas</a> /
                <span>Nova Turma</span>
            </div>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="post" action="/mesominds/turmas/criar" class="turma-form">
                <h1>Criar Nova Turma</h1>

                <div class="form-group">
                    <label for="nome">Nome da Turma *</label>
                    <input type="text" id="nome" name="nome" required maxlength="255"
                        placeholder="Ex: Matemática - 1º Ano"
                        value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4"
                        placeholder="Descreva o conteúdo e objetivos desta turma..."><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ''; ?></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Criar Turma</button>
                    <a href="/mesominds/turmas" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </main> <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>