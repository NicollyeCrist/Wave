<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Questão - MesoMinds Admin</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/admin.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-header">
                <h1>📝 Cadastrar Questões</h1>
                <p>Adicione questões ao banco de dados</p>
                <div class="header-controls">
                    <button type="button" id="addQuestaoBtn" class="btn-success">➕ Adicionar Questão</button>
                    <span class="questao-counter">Questões: <span id="questaoCount">1</span></span>
                </div>
            </div>

            <?php if (isset($_SESSION['admin_mensagem'])): ?>
                <div class="mensagem <?= $_SESSION['admin_tipo_mensagem'] ?>">
                    <?= htmlspecialchars($_SESSION['admin_mensagem']) ?>
                </div>
                <?php
                unset($_SESSION['admin_mensagem']);
                unset($_SESSION['admin_tipo_mensagem']);
                ?>
            <?php endif; ?>
            <form action="/mesominds/admin/questoes/cadastrar" method="post" class="admin-form" id="questoesForm">
                <div id="questoesContainer">
                    <div class="questao-item" data-questao="1">
                        <div class="questao-header">
                            <h3>📝 Questão 1</h3>
                            <button type="button" class="btn-remove" onclick="removeQuestao(1)"
                                style="display: none;">🗑️ Remover</button>
                        </div>

                        <div class="form-group">
                            <label for="enunciado_1">Enunciado da Questão: *</label>
                            <textarea id="enunciado_1" name="questoes[1][enunciado]" required rows="4"
                                placeholder="Digite o enunciado da questão..."></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="id_conteudo_1">Conteúdo: *</label>
                                <select id="id_conteudo_1" name="questoes[1][id_conteudo]" required>
                                    <option value="">Selecione um conteúdo</option>
                                    <?php if (isset($conteudos) && !empty($conteudos)): ?>
                                        <?php foreach ($conteudos as $conteudo): ?>
                                            <option value="<?= $conteudo->getId() ?>">
                                                <?= htmlspecialchars($conteudo->getTitulo()) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nivel_dificuldade_1">Nível de Dificuldade: *</label>
                                <select id="nivel_dificuldade_1" name="questoes[1][nivel_dificuldade]" required>
                                    <option value="">Selecione o nível</option>
                                    <option value="1">Nível 1 - Básico</option>
                                    <option value="2">Nível 2 - Intermediário</option>
                                    <option value="3">Nível 3 - Avançado</option>
                                </select>
                            </div>
                        </div>
                        <div class="alternativas-section">
                            <div class="alternativas-header">
                                <h4>Alternativas</h4>
                                <button type="button" class="btn-add-alternativa" onclick="addAlternativa(1)">➕
                                    Adicionar Alternativa</button>
                            </div>
                            <p class="help-text">Adicione pelo menos 2 alternativas e marque a correta</p>

                            <div class="alternativas-container" id="alternativas_1">
                                <div class="alternativa-group" data-index="0">
                                    <label for="alternativa_1_0">Alternativa A: *</label>
                                    <div class="alternativa-input">
                                        <input type="text" id="alternativa_1_0" name="questoes[1][alternativas][]"
                                            required placeholder="Digite a alternativa A">
                                        <input type="radio" id="correta_1_0" name="questoes[1][correta]" value="0"
                                            required>
                                        <label for="correta_1_0" class="radio-label">Correta</label>
                                        <button type="button" class="btn-remove-alternativa"
                                            onclick="removeAlternativa(1, 0)" style="display: none;">🗑️</button>
                                    </div>
                                </div>
                                <div class="alternativa-group" data-index="1">
                                    <label for="alternativa_1_1">Alternativa B: *</label>
                                    <div class="alternativa-input">
                                        <input type="text" id="alternativa_1_1" name="questoes[1][alternativas][]"
                                            required placeholder="Digite a alternativa B">
                                        <input type="radio" id="correta_1_1" name="questoes[1][correta]" value="1"
                                            required>
                                        <label for="correta_1_1" class="radio-label">Correta</label>
                                        <button type="button" class="btn-remove-alternativa"
                                            onclick="removeAlternativa(1, 1)" style="display: none;">🗑️</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="correcao_1">Correção/Explicação:</label>
                            <textarea id="correcao_1" name="questoes[1][correcao]" rows="3"
                                placeholder="Explicação detalhada da resposta (opcional)"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Cadastrar Questões</button>
                    <a href="/mesominds/admin/questoes" class="btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
    <style>
        .header-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-top: 1rem;
        }

        .questao-counter {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            font-weight: bold;
        }

        .questao-item {
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .questao-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .questao-header h3 {
            margin: 0;
            color: var(--color-primary);
        }

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-remove:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        .btn-success {
            background: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-1px);
        }

        .alternativas-section {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }

        .alternativas-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .alternativas-header h4 {
            margin: 0;
        }

        .btn-add-alternativa {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .btn-add-alternativa:hover {
            background: #138496;
            transform: translateY(-1px);
        }

        .btn-remove-alternativa {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.3rem 0.6rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.2s;
            margin-left: 0.5rem;
        }

        .btn-remove-alternativa:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        .alternativas-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .alternativa-group {
            margin-bottom: 1rem;
        }

        .alternativa-input {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.3rem;
        }

        .alternativa-input input[type="text"] {
            flex: 1;
        }

        .alternativa-input input[type="radio"] {
            margin: 0;
        }

        .radio-label {
            font-size: 0.9rem;
            color: var(--color-success);
            font-weight: bold;
            margin: 0;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .help-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .questao-separator {
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--color-primary), transparent);
            margin: 2rem 0;
        }

        @media (max-width: 768px) {
            .header-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .alternativa-input {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.3rem;
            }
        }
    </style>

    <script>
        let questaoCount = 1;
        document.addEventListener('DOMContentLoaded', function () {
            const addBtn = document.getElementById('addQuestaoBtn');
            const container = document.getElementById('questoesContainer');

            addBtn.addEventListener('click', addQuestao);

            updateRemoveButtons();
            updateAlternativaRemoveButtons(1);
        });

        function addQuestao() {
            questaoCount++;
            const container = document.getElementById('questoesContainer');

            const newQuestao = createQuestaoTemplate(questaoCount);
            container.appendChild(newQuestao);

            updateQuestaoCounter();
            updateRemoveButtons();

            newQuestao.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function createQuestaoTemplate(number) {
            const div = document.createElement('div');
            div.className = 'questao-item';
            div.setAttribute('data-questao', number);

            div.innerHTML = `
                <div class="questao-separator"></div>
                <div class="questao-header">
                    <h3>📝 Questão ${number}</h3>
                    <button type="button" class="btn-remove" onclick="removeQuestao(${number})">🗑️ Remover</button>
                </div>

                <div class="form-group">
                    <label for="enunciado_${number}">Enunciado da Questão: *</label>
                    <textarea id="enunciado_${number}" name="questoes[${number}][enunciado]" required rows="4"
                        placeholder="Digite o enunciado da questão..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_conteudo_${number}">Conteúdo: *</label>
                        <select id="id_conteudo_${number}" name="questoes[${number}][id_conteudo]" required>
                            <option value="">Selecione um conteúdo</option>
                            ${getConteudosOptions()}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nivel_dificuldade_${number}">Nível de Dificuldade: *</label>
                        <select id="nivel_dificuldade_${number}" name="questoes[${number}][nivel_dificuldade]" required>
                            <option value="">Selecione o nível</option>
                            <option value="1">Nível 1 - Básico</option>
                            <option value="2">Nível 2 - Intermediário</option>
                            <option value="3">Nível 3 - Avançado</option>
                        </select>
                    </div>
                </div>                <div class="alternativas-section">
                    <div class="alternativas-header">
                        <h4>Alternativas</h4>
                        <button type="button" class="btn-add-alternativa" onclick="addAlternativa(${number})">➕ Adicionar Alternativa</button>
                    </div>
                    <p class="help-text">Adicione pelo menos 2 alternativas e marque a correta</p>

                    ${createAlternativas(number)}
                </div>

                <div class="form-group">
                    <label for="correcao_${number}">Correção/Explicação:</label>
                    <textarea id="correcao_${number}" name="questoes[${number}][correcao]" rows="3"
                        placeholder="Explicação detalhada da resposta (opcional)"></textarea>
                </div>
            `;

            return div;
        }
        function createAlternativas(questaoNumber) {
            return `
                <div class="alternativas-container" id="alternativas_${questaoNumber}">
                    <div class="alternativa-group" data-index="0">
                        <label for="alternativa_${questaoNumber}_0">Alternativa A: *</label>
                        <div class="alternativa-input">
                            <input type="text" id="alternativa_${questaoNumber}_0" name="questoes[${questaoNumber}][alternativas][]" required
                                placeholder="Digite a alternativa A">
                            <input type="radio" id="correta_${questaoNumber}_0" name="questoes[${questaoNumber}][correta]" value="0" required>
                            <label for="correta_${questaoNumber}_0" class="radio-label">Correta</label>
                            <button type="button" class="btn-remove-alternativa" onclick="removeAlternativa(${questaoNumber}, 0)" style="display: none;">🗑️</button>
                        </div>
                    </div>
                    <div class="alternativa-group" data-index="1">
                        <label for="alternativa_${questaoNumber}_1">Alternativa B: *</label>
                        <div class="alternativa-input">
                            <input type="text" id="alternativa_${questaoNumber}_1" name="questoes[${questaoNumber}][alternativas][]" required
                                placeholder="Digite a alternativa B">
                            <input type="radio" id="correta_${questaoNumber}_1" name="questoes[${questaoNumber}][correta]" value="1" required>
                            <label for="correta_${questaoNumber}_1" class="radio-label">Correta</label>
                            <button type="button" class="btn-remove-alternativa" onclick="removeAlternativa(${questaoNumber}, 1)" style="display: none;">🗑️</button>
                        </div>
                    </div>
                </div>
            `;
        }

        function getConteudosOptions() {
            const select = document.getElementById('id_conteudo_1');
            let options = '';

            for (let i = 1; i < select.options.length; i++) {
                const option = select.options[i];
                options += `<option value="${option.value}">${option.text}</option>`;
            }

            return options;
        }

        function removeQuestao(number) {
            if (questaoCount <= 1) {
                alert('Não é possível remover a última questão!');
                return;
            }

            const questao = document.querySelector(`[data-questao="${number}"]`);
            if (questao) {
                questao.remove();
                questaoCount--;
                updateQuestaoCounter();
                updateRemoveButtons();
                renumberQuestoes();
            }
        }

        function renumberQuestoes() {
            const questoes = document.querySelectorAll('.questao-item');
            questoes.forEach((questao, index) => {
                const newNumber = index + 1;
                questao.setAttribute('data-questao', newNumber);

                const title = questao.querySelector('.questao-header h3');
                if (title) title.textContent = `📝 Questão ${newNumber}`;

                updateQuestaoFields(questao, newNumber);
            });

            questaoCount = questoes.length;
            updateQuestaoCounter();
        }

        function updateQuestaoFields(questao, newNumber) {
            const elements = questao.querySelectorAll('[id], [name], [for]');

            elements.forEach(element => {
                if (element.id) {
                    element.id = element.id.replace(/_\d+_/, `_${newNumber}_`).replace(/_\d+$/, `_${newNumber}`);
                }
                if (element.name) {
                    element.name = element.name.replace(/\[\d+\]/, `[${newNumber}]`);
                }
                if (element.getAttribute('for')) {
                    const forAttr = element.getAttribute('for');
                    element.setAttribute('for', forAttr.replace(/_\d+_/, `_${newNumber}_`).replace(/_\d+$/, `_${newNumber}`));
                }
                if (element.onclick) {
                    element.setAttribute('onclick', `removeQuestao(${newNumber})`);
                }
            });
        }

        function updateQuestaoCounter() {
            document.getElementById('questaoCount').textContent = questaoCount;
        }
        function updateRemoveButtons() {
            const removeButtons = document.querySelectorAll('.btn-remove');
            removeButtons.forEach(button => {
                button.style.display = questaoCount > 1 ? 'block' : 'none';
            });
        }

        function addAlternativa(questaoNumber) {
            const container = document.getElementById(`alternativas_${questaoNumber}`);
            const alternativas = container.querySelectorAll('.alternativa-group');
            const nextIndex = alternativas.length;
            const letter = String.fromCharCode(65 + nextIndex);

            const newAlternativa = document.createElement('div');
            newAlternativa.className = 'alternativa-group';
            newAlternativa.setAttribute('data-index', nextIndex);

            newAlternativa.innerHTML = `
                <label for="alternativa_${questaoNumber}_${nextIndex}">Alternativa ${letter}: *</label>
                <div class="alternativa-input">
                    <input type="text" id="alternativa_${questaoNumber}_${nextIndex}" name="questoes[${questaoNumber}][alternativas][]" required
                        placeholder="Digite a alternativa ${letter}">
                    <input type="radio" id="correta_${questaoNumber}_${nextIndex}" name="questoes[${questaoNumber}][correta]" value="${nextIndex}" required>
                    <label for="correta_${questaoNumber}_${nextIndex}" class="radio-label">Correta</label>
                    <button type="button" class="btn-remove-alternativa" onclick="removeAlternativa(${questaoNumber}, ${nextIndex})">🗑️</button>
                </div>
            `;

            container.appendChild(newAlternativa);
            updateAlternativaRemoveButtons(questaoNumber);
        }

        function removeAlternativa(questaoNumber, index) {
            const container = document.getElementById(`alternativas_${questaoNumber}`);
            const alternativas = container.querySelectorAll('.alternativa-group');

            if (alternativas.length <= 2) {
                alert('É necessário ter pelo menos 2 alternativas!');
                return;
            }

            const alternativa = container.querySelector(`[data-index="${index}"]`);
            if (alternativa) {
                alternativa.remove();
                renumberAlternativas(questaoNumber);
                updateAlternativaRemoveButtons(questaoNumber);
            }
        }

        function renumberAlternativas(questaoNumber) {
            const container = document.getElementById(`alternativas_${questaoNumber}`);
            const alternativas = container.querySelectorAll('.alternativa-group');

            alternativas.forEach((alternativa, index) => {
                const letter = String.fromCharCode(65 + index);
                alternativa.setAttribute('data-index', index);

                const label = alternativa.querySelector('label:first-child');
                if (label) {
                    label.textContent = `Alternativa ${letter}: *`;
                    label.setAttribute('for', `alternativa_${questaoNumber}_${index}`);
                }

                const textInput = alternativa.querySelector('input[type="text"]');
                if (textInput) {
                    textInput.id = `alternativa_${questaoNumber}_${index}`;
                    textInput.placeholder = `Digite a alternativa ${letter}`;
                }

                const radioInput = alternativa.querySelector('input[type="radio"]');
                if (radioInput) {
                    radioInput.id = `correta_${questaoNumber}_${index}`;
                    radioInput.value = index;
                }

                const radioLabel = alternativa.querySelector('.radio-label');
                if (radioLabel) {
                    radioLabel.setAttribute('for', `correta_${questaoNumber}_${index}`);
                }

                const removeBtn = alternativa.querySelector('.btn-remove-alternativa');
                if (removeBtn) {
                    removeBtn.setAttribute('onclick', `removeAlternativa(${questaoNumber}, ${index})`);
                }
            });
        }

        function updateAlternativaRemoveButtons(questaoNumber) {
            const container = document.getElementById(`alternativas_${questaoNumber}`);
            const alternativas = container.querySelectorAll('.alternativa-group');
            const removeButtons = container.querySelectorAll('.btn-remove-alternativa');

            removeButtons.forEach(button => {
                button.style.display = alternativas.length > 2 ? 'inline-block' : 'none';
            });
        }

        function updateQuestaoFields(questao, newNumber) {
            const elements = questao.querySelectorAll('[id], [name], [for]');

            elements.forEach(element => {
                if (element.id) {
                    element.id = element.id.replace(/_\d+_/, `_${newNumber}_`).replace(/_\d+$/, `_${newNumber}`);
                }
                if (element.name) {
                    element.name = element.name.replace(/\[\d+\]/, `[${newNumber}]`);
                }
                if (element.getAttribute('for')) {
                    const forAttr = element.getAttribute('for');
                    element.setAttribute('for', forAttr.replace(/_\d+_/, `_${newNumber}_`).replace(/_\d+$/, `_${newNumber}`));
                }
                if (element.onclick) {
                    const onclickStr = element.getAttribute('onclick');
                    if (onclickStr.includes('removeQuestao')) {
                        element.setAttribute('onclick', `removeQuestao(${newNumber})`);
                    } else if (onclickStr.includes('addAlternativa')) {
                        element.setAttribute('onclick', `addAlternativa(${newNumber})`);
                    } else if (onclickStr.includes('removeAlternativa')) {
                        const matches = onclickStr.match(/removeAlternativa\(\d+,\s*(\d+)\)/);
                        if (matches) {
                            const altIndex = matches[1];
                            element.setAttribute('onclick', `removeAlternativa(${newNumber}, ${altIndex})`);
                        }
                    }
                }
            });

            const alternativasContainer = questao.querySelector('.alternativas-container');
            if (alternativasContainer) {
                alternativasContainer.id = `alternativas_${newNumber}`;
            }
        }
    </script>
</body>

</html>