<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: /login');
    exit;
}

$isProfessor = $_SESSION['usuario']['tipo_usuario'] === 'professor';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($turma) ? htmlspecialchars($turma->getNome()) : 'Turma'; ?></title>
    <link rel="stylesheet" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" href="/mesominds/CSS/turmas.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <main class="container">
        <div class="page-header">
            <div class="breadcrumb">
                <a href="/mesominds/turmas">Turmas</a> /
                <span><?php echo isset($turma) ? htmlspecialchars($turma->getNome()) : 'Detalhes'; ?></span>
            </div>
            <div class="header-actions">
                <?php if (isset($turma) && $isProfessor): ?>
                    <a href="/mesominds/turmas/editar?id=<?php echo $turma->getId(); ?>" class="btn btn-secondary">
                        Editar Turma
                    </a>
                <?php endif; ?>
                <a href="/mesominds/turmas" class="btn btn-outline">Voltar</a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($turma)): ?>
            <div class="turma-details">
                <div class="turma-info">
                    <h1><?php echo htmlspecialchars($turma->getNome()); ?></h1>
                    <p class="turma-description">
                        <?php echo htmlspecialchars($turma->getDescricao() ?: 'Sem descrição disponível'); ?>
                    </p>
                    <div class="turma-meta">
                        <span class="meta-item">
                            <strong>Criada em:</strong>
                            <?php echo date('d/m/Y H:i', strtotime($turma->getCreatedAt())); ?>
                        </span>
                        <span class="meta-item">
                            <strong>Participantes:</strong>
                            <?php echo isset($usuarios) ? count($usuarios) : 0; ?>
                        </span>
                    </div>
                </div>

                <div class="turma-actions-section"> <?php if (!$isProfessor): ?>
                        <?php if (isset($isUserInTurma) && $isUserInTurma): ?>
                            <form method="post" action="/mesominds/turmas/sair" class="inline-form">
                                <input type="hidden" name="turma_id" value="<?php echo $turma->getId(); ?>">
                                <button type="submit" class="btn btn-danger">Sair da Turma</button>
                            </form>
                        <?php else: ?>
                            <form method="post" action="/mesominds/turmas/entrar" class="inline-form">
                                <input type="hidden" name="turma_id" value="<?php echo $turma->getId(); ?>">
                                <button type="submit" class="btn btn-primary">Entrar na Turma</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="participantes-section">
                    <h2>Participantes</h2>
                    <?php if (isset($usuarios) && !empty($usuarios)): ?>
                        <div class="participantes-grid">
                            <?php foreach ($usuarios as $usuario): ?>
                                <div class="participante-card">
                                    <div class="participante-info">
                                        <h3><?php echo htmlspecialchars($usuario['nome']); ?></h3>
                                        <span class="participante-tipo <?php echo $usuario['tipo_usuario']; ?>">
                                            <?php echo ucfirst($usuario['tipo_usuario']); ?>
                                        </span>
                                    </div>
                                    <div class="participante-meta">
                                        <span class="participante-email">
                                            <?php echo htmlspecialchars($usuario['email']); ?>
                                        </span>
                                        <?php if (!empty($usuario['escola'])): ?>
                                            <span class="participante-escola">
                                                <?php echo htmlspecialchars($usuario['escola']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <h3>Nenhum participante ainda</h3>
                            <p>Esta turma ainda não possui participantes inscritos.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="error-state">
                <h2>Turma não encontrada</h2>
                <p>A turma solicitada não existe ou foi removida.</p>
                <a href="/mesominds/turmas" class="btn btn-primary">Voltar para Turmas</a>
            </div>
        <?php endif; ?>
    </main> <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>