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
    <title>Editar Turma - MesoMinds</title>
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
                <span>Editar Turma</span>
            </div>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($turma)): ?>
            <div class="form-container">
                <form method="post" action="/mesominds/turmas/atualizar" class="turma-form">
                    <h1>Editar Turma</h1>

                    <input type="hidden" name="id" value="<?php echo $turma->getId(); ?>">

                    <div class="form-group">
                        <label for="nome">Nome da Turma *</label>
                        <input type="text" id="nome" name="nome" required maxlength="255"
                            value="<?php echo htmlspecialchars($turma->getNome()); ?>">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao"
                            rows="4"><?php echo htmlspecialchars($turma->getDescricao() ?: ''); ?></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Atualizar Turma</button>
                        <a href="/mesominds/turmas" class="btn btn-outline">Cancelar</a>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="error-state">
                <h2>Turma não encontrada</h2>
                <p>A turma que você está tentando editar não existe.</p>
                <a href="/mesominds/turmas" class="btn btn-primary">Voltar para Turmas</a>
            </div>
        <?php endif; ?>
    </main>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>