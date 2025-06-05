<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questões - <?= htmlspecialchars($assuntoAtual ?? 'Todos os Assuntos') ?></title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/questoes.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
    <style>
        .filtros-container {
            background: var(--color-background-contrast);
            padding: 1.5rem;
            border-radius: 1rem;
            margin: 2rem auto;
            max-width: 800px;
            color: white;
        }
        
        .filtros-row {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .filtro-grupo {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filtro-grupo label {
            font-weight: bold;
            color: var(--color-sucess);
        }
        
        .filtro-grupo select {
            padding: 0.5rem;
            border-radius: 0.5rem;
            border: none;
            background: white;
            color: var(--color-background);
            min-width: 150px;
        }
        
        .btn-filtrar {
            background: var(--color-sucess);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: bold;
            margin-top: 1.5rem;
        }
        
        .btn-filtrar:hover {
            background: var(--color-Second);
        }
        
        .questoes-section {
            margin: 2rem 0;
        }
        
        .questoes-nivel {
            background: var(--color-background-contrast);
            padding: 1.5rem;
            margin: 1rem auto;
            border-radius: 1rem;
            max-width: 900px;
        }
        
        .questoes-nivel h3 {
            color: var(--color-sucess);
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .questao-item {
            background: rgba(255,255,255,0.1);
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            color: white;
        }
        
        .questao-enunciado {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }
        
        .questao-alternativas {
            margin-top: 1rem;
        }
        
        .alternativa {
            padding: 0.5rem;
            margin: 0.3rem 0;
            background: rgba(255,255,255,0.05);
            border-radius: 0.3rem;
            border-left: 3px solid transparent;
        }
          .alternativa.correta {
            border-left-color: var(--color-sucess);
            background: rgba(76, 175, 80, 0.1);
        }
        
        .alternativa.selected {
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--color-primary);
        }
        
        .alternativa.revealed.correta {
            border-left-color: var(--color-sucess);
            background: rgba(76, 175, 80, 0.1);
        }
        
        .alternativa.revealed.incorreta {
            border-left-color: #f44336;
            background: rgba(244, 67, 54, 0.1);
        }
        
        .btn-mostrar-alternativas,
        .btn-mostrar-correcao {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.3rem;
            cursor: pointer;
            font-size: 0.9rem;
            margin: 0.5rem 0;
            transition: background 0.3s;
        }
        
        .btn-mostrar-alternativas:hover,
        .btn-mostrar-correcao:hover {
            background: var(--color-primary-dark);
        }
          .sem-questoes {
            text-align: center;
            color: white;
            padding: 2rem;
            background: var(--color-background-contrast);
            border-radius: 1rem;
            margin: 2rem auto;
            max-width: 600px;
        }
        
        .conteudos-section {
            margin: 3rem 0 2rem 0;
            padding-top: 2rem;
            border-top: 2px solid var(--color-background-contrast);
        }
        
        .conteudos-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background: var(--color-background-contrast);
            border-radius: 1rem;
            color: white;
        }
        
        .conteudos-container h2 {
            color: var(--color-sucess);
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }
        
        .conteudos-subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            font-style: italic;
        }
        
        .conteudos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .conteudo-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 0.8rem;
            border-left: 4px solid var(--color-sucess);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .conteudo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
          .conteudo-header {
            margin-bottom: 1rem;
        }
        
        .conteudo-header h3 {
            color: white;
            margin: 0;
            font-size: 1.2rem;
            line-height: 1.3;
        }
        
        .conteudo-descricao {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .conteudo-actions {
            text-align: center;
        }
        
        .btn-estudar {
            background: var(--color-sucess);
            color: white;
            padding: 0.8rem 1.5rem;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: bold;
            display: inline-block;
            transition: background 0.3s ease;
            font-size: 0.95rem;
        }
        
        .btn-estudar:hover {
            background: var(--color-Second);
            transform: scale(1.05);
        }
        
        .conteudos-footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            background: rgba(76, 175, 80, 0.1);
            border-radius: 0.5rem;
            border-left: 4px solid var(--color-sucess);
        }
        
        .conteudos-footer p {
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
        }
          /* Responsividade para mobile */
        @media (max-width: 768px) {
            .conteudos-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>
    
    <main>
        <h1 style="color: white; text-align: center; margin: 2rem 0;">
            Questões<?= !empty($assuntoAtual) ? ' - ' . htmlspecialchars($assuntoAtual) : '' ?>
        </h1>

        <div class="filtros-container">
            <form method="GET" action="/mesominds/questoes/assunto">
                <div class="filtros-row">
                    <div class="filtro-grupo">
                        <label for="assunto">Assunto:</label>
                        <select name="assunto" id="assunto">
                            <option value="">Selecione um assunto</option>
                            <?php if (isset($assuntos)): ?>
                                <?php foreach ($assuntos as $nomeAssunto => $conteudosAssunto): ?>
                                    <option value="<?= htmlspecialchars($nomeAssunto) ?>" 
                                        <?= ($assuntoAtual ?? '') === $nomeAssunto ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($nomeAssunto) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="filtro-grupo">
                        <label for="nivel">Nível:</label>
                        <select name="nivel" id="nivel">
                            <option value="">Todos os níveis</option>
                            <option value="1" <?= ($nivelAtual ?? '') === '1' ? 'selected' : '' ?>>Nível 1</option>
                            <option value="2" <?= ($nivelAtual ?? '') === '2' ? 'selected' : '' ?>>Nível 2</option>
                            <option value="3" <?= ($nivelAtual ?? '') === '3' ? 'selected' : '' ?>>Nível 3</option>
                        </select>
                    </div>
                </div>
                
                <div style="text-align: center;">
                    <button type="submit" class="btn-filtrar">Filtrar Questões</button>
                </div>
            </form>
        </div>

        <div class="questoes-section">
            <?php if (isset($questoesAgrupadas) && !empty($questoesAgrupadas)): ?>
                <?php foreach ($questoesAgrupadas as $nivel => $questoesNivel): ?>
                    <?php if (!empty($questoesNivel)): ?>
                        <div class="questoes-nivel">
                            <h3>Questões Nível <?= htmlspecialchars($nivel) ?></h3>
                            
                            <?php foreach ($questoesNivel as $questao): ?>
                                <div class="questao-item">
                                    <div class="questao-enunciado">
                                        <strong>Questão <?= $questao->getId() ?>:</strong>
                                        <?= nl2br(htmlspecialchars($questao->getEnunciado())) ?>
                                    </div>
                                      <?php if ($questao->getAlternativas() && !empty($questao->getAlternativas())): ?>
                                        <div class="questao-alternativas">
                                            <button class="btn-mostrar-alternativas" onclick="mostrarAlternativas(<?= $questao->getId() ?>)">
                                                Mostrar Alternativas
                                            </button>
                                            <div class="alternativas-container" id="alternativas-<?= $questao->getId() ?>" style="display: none;">
                                                <?php 
                                                $letras = ['A', 'B', 'C', 'D', 'E'];
                                                foreach ($questao->getAlternativas() as $index => $alternativa): 
                                                ?>
                                                    <div class="alternativa" data-questao="<?= $questao->getId() ?>" data-correta="<?= $alternativa['correta'] ? '1' : '0' ?>">
                                                        <strong><?= $letras[$index] ?? ($index + 1) ?>)</strong>
                                                        <?= htmlspecialchars($alternativa['texto']) ?>
                                                    </div>
                                                <?php endforeach; ?>
                                                
                                                <div class="questao-acoes" style="margin-top: 1rem; display: none;" id="acoes-<?= $questao->getId() ?>">
                                                    <button class="btn-mostrar-correcao" onclick="mostrarCorrecao(<?= $questao->getId() ?>)">
                                                        Ver Correção
                                                    </button>
                                                </div>
                                                
                                                <?php if (!empty($questao->getCorrecao())): ?>
                                                    <div class="correcao-container" id="correcao-<?= $questao->getId() ?>" style="display: none; margin-top: 1rem; padding: 0.5rem; background: rgba(76, 175, 80, 0.1); border-radius: 0.3rem; border-left: 3px solid var(--color-sucess);">
                                                        <strong>Correção:</strong>
                                                        <?= nl2br(htmlspecialchars($questao->getCorrecao())) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="sem-questoes">
                    <h3>Nenhuma questão encontrada</h3>
                    <p>
                        <?php if (!empty($assuntoAtual)): ?>
                            Não foram encontradas questões para o assunto "<?= htmlspecialchars($assuntoAtual) ?>"
                            <?= !empty($nivelAtual) ? "no nível " . htmlspecialchars($nivelAtual) : "" ?>.
                        <?php else: ?>
                            Selecione um assunto para ver as questões disponíveis.
                        <?php endif; ?>
                    </p>
                </div>
            <?php endif; ?>        </div>
        
        <?php if (isset($conteudos) && !empty($conteudos) && !empty($assuntoAtual)): ?>
        <div class="conteudos-section">
            <div class="conteudos-container">
                <h2>📚 Conteúdos para Estudo - <?= htmlspecialchars($assuntoAtual) ?></h2>
                <p class="conteudos-subtitle">
                    Aprenda mais sobre <?= htmlspecialchars($assuntoAtual) ?> com nossos materiais de estudo
                </p>
                
                <div class="conteudos-grid">
                    <?php foreach ($conteudos as $conteudo): ?>                    <div class="conteudo-card">
                        <div class="conteudo-header">
                            <h3><?= htmlspecialchars($conteudo->getTitulo()) ?></h3>
                        </div>
                        
                        <?php if (!empty($conteudo->getDescricao())): ?>
                        <div class="conteudo-descricao">
                            <?= nl2br(htmlspecialchars($conteudo->getDescricao())) ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="conteudo-actions">
                            <a href="/mesominds/conteudo?id=<?= $conteudo->getId() ?>" class="btn-estudar">
                                📖 Estudar Agora
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="conteudos-footer">
                    <p>💡 <strong>Dica:</strong> Recomendamos estudar o conteúdo antes de resolver as questões para melhor aproveitamento!</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        

    </main>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const assuntoSelect = document.getElementById('assunto');
            const nivelSelect = document.getElementById('nivel');
            
            assuntoSelect.addEventListener('change', function() {
                if (this.value) {
                    form.submit();
                }
            });
            
            nivelSelect.addEventListener('change', function() {
                if (assuntoSelect.value) {
                    form.submit();
                }
            });
        });
        
        function mostrarAlternativas(questaoId) {
            const container = document.getElementById('alternativas-' + questaoId);
            const btn = container.previousElementSibling;
            
            if (container.style.display === 'none') {
                container.style.display = 'block';
                btn.textContent = 'Ocultar Alternativas';
                
                const alternativas = container.querySelectorAll('.alternativa');
                alternativas.forEach(alt => {
                    alt.style.cursor = 'pointer';
                    alt.addEventListener('click', function() {
                        selecionarAlternativa(questaoId, this);
                    });
                });
            } else {
                container.style.display = 'none';
                btn.textContent = 'Mostrar Alternativas';
            }
        }
        
        function selecionarAlternativa(questaoId, alternativaSelecionada) {
            const container = document.getElementById('alternativas-' + questaoId);
            const alternativas = container.querySelectorAll('.alternativa');
            const acoes = document.getElementById('acoes-' + questaoId);
            
            alternativas.forEach(alt => alt.classList.remove('selected'));
            
            alternativaSelecionada.classList.add('selected');
            
            acoes.style.display = 'block';
        }
        
        function mostrarCorrecao(questaoId) {
            const container = document.getElementById('alternativas-' + questaoId);
            const alternativas = container.querySelectorAll('.alternativa');
            const correcao = document.getElementById('correcao-' + questaoId);
            const btnCorrecao = document.querySelector(`#acoes-${questaoId} .btn-mostrar-correcao`);
            
            alternativas.forEach(alt => {
                alt.classList.add('revealed');
                const isCorreta = alt.dataset.correta === '1';
                
                if (isCorreta) {
                    alt.classList.add('correta');
                    if (!alt.querySelector('.check-icon')) {
                        const checkIcon = document.createElement('span');
                        checkIcon.className = 'check-icon';
                        checkIcon.innerHTML = ' ✓';
                        checkIcon.style.color = 'var(--color-sucess)';
                        checkIcon.style.fontWeight = 'bold';
                        alt.appendChild(checkIcon);
                    }
                } else {
                    alt.classList.add('incorreta');
                }
                
                alt.style.cursor = 'default';
                alt.onclick = null;
            });
            
            if (correcao) {
                correcao.style.display = 'block';
            }
            
            btnCorrecao.textContent = 'Correção Exibida';
            btnCorrecao.disabled = true;
            btnCorrecao.style.opacity = '0.6';
        }
    </script>
</body>
</html>
