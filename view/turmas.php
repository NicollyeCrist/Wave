<?php
require_once __DIR__ . '/../model/UsuarioDao.php';

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
    <title>Turmas - MesoMinds</title>
    <link rel="stylesheet" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" href="/mesominds/CSS/turmas.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <main class="container">
        <div class="page-header">
            <h1>Turmas</h1> <?php if ($isProfessor): ?>
                <a href="/mesominds/turmas/criar" class="btn btn-primary">Nova Turma</a>
            <?php endif; ?>
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

        <div class="turmas-grid">
            <?php if (isset($turmas) && !empty($turmas)): ?>
                <?php foreach ($turmas as $turma): ?>
                    <div class="turma-card">
                        <div class="turma-header">
                            <h3><?php echo htmlspecialchars($turma->getNome()); ?></h3>
                            <div class="turma-actions">
                                <?php if ($isProfessor): ?>
                                    <a href="/mesominds/turmas/editar?id=<?php echo $turma->getId(); ?>"
                                        class="btn btn-sm btn-secondary">
                                        Editar
                                    </a>
                                    <form method="post" action="/mesominds/turmas/deletar" style="display: inline;"
                                        onsubmit="return confirm('Tem certeza que deseja deletar esta turma?')">
                                        <input type="hidden" name="id" value="<?php echo $turma->getId(); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                    </form>
                                <?php else: ?>
                                    <?php
                                    $isUserInTurma = false;
                                    if (isset($userTurmas)) {
                                        foreach ($userTurmas as $userTurma) {
                                            if ($userTurma->getId() == $turma->getId()) {
                                                $isUserInTurma = true;
                                                break;
                                            }
                                        }
                                    }
                                    ?>             <?php if ($isUserInTurma): ?>
                                        <form method="post" action="/mesominds/turmas/sair" style="display: inline;">
                                            <input type="hidden" name="turma_id" value="<?php echo $turma->getId(); ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Sair</button>
                                        </form>
                                    <?php else: ?>
                                        <form method="post" action="/mesominds/turmas/entrar" style="display: inline;">
                                            <input type="hidden" name="turma_id" value="<?php echo $turma->getId(); ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Entrar</button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="turma-content">
                            <p class="turma-description">
                                <?php echo htmlspecialchars($turma->getDescricao() ?: 'Sem descrição'); ?>
                            </p>
                            <div class="turma-meta">
                                <span class="turma-date">
                                    Criada em: <?php echo date('d/m/Y', strtotime($turma->getCreatedAt())); ?>
                                </span>
                            </div>
                        </div>
                        <div class="turma-footer">
                            <a href="/mesominds/turmas/detalhes?id=<?php echo $turma->getId(); ?>" class="btn btn-outline">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <h3>Nenhuma turma encontrada</h3>
                    <p>
                        <?php if ($isProfessor): ?>
                            Que tal criar a primeira turma?
                        <?php else: ?>
                            Aguarde novas turmas serem criadas pelos professores.
                        <?php endif; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </main> 
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>