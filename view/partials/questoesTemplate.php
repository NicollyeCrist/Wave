<div class="questContainer">
    <h2><?php echo htmlspecialchars($tituloPrincipal); ?></h2>
    <div class="cardQuestoesContainer">
        <div class="cardQuestoesAssuntoSimples">
            <h3><?php echo htmlspecialchars($tituloGrupo1); ?></h3>
            <?php if (isset($linksGrupo1) && is_array($linksGrupo1)): ?>
                <?php foreach ($linksGrupo1 as $link): ?>
                    <a href="<?php echo htmlspecialchars($link['href']); ?>"><?php echo htmlspecialchars($link['texto']); ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="cardQuestoesAssuntoEnem">
            <h3><?php echo htmlspecialchars($tituloGrupo2); ?></h3>
            <?php if (isset($linksGrupo2) && is_array($linksGrupo2)): ?>
                <?php foreach ($linksGrupo2 as $link): ?>
                    <a href="<?php echo htmlspecialchars($link['href']); ?>"><?php echo htmlspecialchars($link['texto']); ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>