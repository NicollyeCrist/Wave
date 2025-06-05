<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questões</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/css/questoes.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>
    <main>
        <h1>
            Questões por assunto
        </h1>
        <?php
        $tituloPrincipal = "Funções";
        $tituloGrupo1 = "Questões por nível";
        $linksGrupo1 = [
            ['texto' => 'Questões nível 1', 'href' => '/mesominds/questoes/assunto?assunto=Função&nivel=1'],
            ['texto' => 'Questões nível 2', 'href' => '/mesominds/questoes/assunto?assunto=Função&nivel=2'],
            ['texto' => 'Questões nível 3', 'href' => '/mesominds/questoes/assunto?assunto=Função&nivel=3']
        ];
        $tituloGrupo2 = "Questões ENEM";
        $linksGrupo2 = [
            ['texto' => 'ENEM 2024', 'href' => '/mesominds/questoes/assunto?assunto=Função&enem=2024'],
            ['texto' => 'ENEM 2023', 'href' => '/mesominds/questoes/assunto?assunto=Função&enem=2023'],
            ['texto' => 'ENEM 2022', 'href' => '/mesominds/questoes/assunto?assunto=Função&enem=2022']
        ];

        include $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/questoesTemplate.php';
        ?> <?php
         $tituloPrincipal = "Conjuntos";
         $tituloGrupo1 = "Questões por nível";
         $linksGrupo1 = [
             ['texto' => 'Questões nível 1', 'href' => '/mesominds/questoes/assunto?assunto=Conjuntos&nivel=1'],
             ['texto' => 'Questões nível 2', 'href' => '/mesominds/questoes/assunto?assunto=Conjuntos&nivel=2'],
             ['texto' => 'Questões nível 3', 'href' => '/mesominds/questoes/assunto?assunto=Conjuntos&nivel=3']
         ];
         $tituloGrupo2 = "Questões ENEM";
         $linksGrupo2 = [
             ['texto' => 'ENEM 2024', 'href' => '/mesominds/questoes/assunto?assunto=Conjuntos&enem=2024'],
             ['texto' => 'ENEM 2023', 'href' => '/mesominds/questoes/assunto?assunto=Conjuntos&enem=2023'],
             ['texto' => 'ENEM 2022', 'href' => '/mesominds/questoes/assunto?assunto=Conjuntos&enem=2022']
         ];

         include $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/questoesTemplate.php';
         ?> <?php
          $tituloPrincipal = "Frações";
          $tituloGrupo1 = "Questões por nível";
          $linksGrupo1 = [
              ['texto' => 'Questões nível 1', 'href' => '/mesominds/questoes/assunto?assunto=Frações&nivel=1'],
              ['texto' => 'Questões nível 2', 'href' => '/mesominds/questoes/assunto?assunto=Frações&nivel=2'],
              ['texto' => 'Questões nível 3', 'href' => '/mesominds/questoes/assunto?assunto=Frações&nivel=3']
          ];
          $tituloGrupo2 = "Questões ENEM";
          $linksGrupo2 = [
              ['texto' => 'ENEM 2024', 'href' => '/mesominds/questoes/assunto?assunto=Frações&enem=2024'],
              ['texto' => 'ENEM 2023', 'href' => '/mesominds/questoes/assunto?assunto=Frações&enem=2023'],
              ['texto' => 'ENEM 2022', 'href' => '/mesominds/questoes/assunto?assunto=Frações&enem=2022']
          ];

          include $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/questoesTemplate.php';
          ?> <?php
           $tituloPrincipal = "Porcentagem";
           $tituloGrupo1 = "Questões por nível";
           $linksGrupo1 = [
               ['texto' => 'Questões nível 1', 'href' => '/mesominds/questoes/assunto?assunto=Porcentagem&nivel=1'],
               ['texto' => 'Questões nível 2', 'href' => '/mesominds/questoes/assunto?assunto=Porcentagem&nivel=2'],
               ['texto' => 'Questões nível 3', 'href' => '/mesominds/questoes/assunto?assunto=Porcentagem&nivel=3']
           ];
           $tituloGrupo2 = "Questões ENEM";
           $linksGrupo2 = [
               ['texto' => 'ENEM 2024', 'href' => '/mesominds/questoes/assunto?assunto=Porcentagem&enem=2024'],
               ['texto' => 'ENEM 2023', 'href' => '/mesominds/questoes/assunto?assunto=Porcentagem&enem=2023'],
               ['texto' => 'ENEM 2022', 'href' => '/mesominds/questoes/assunto?assunto=Porcentagem&enem=2022']
           ];

           include $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/questoesTemplate.php';
           ?> <?php
            $tituloPrincipal = "Probabilidade";
            $tituloGrupo1 = "Questões por nível";
            $linksGrupo1 = [
                ['texto' => 'Questões nível 1', 'href' => '/mesominds/questoes/assunto?assunto=Probabilidade&nivel=1'],
                ['texto' => 'Questões nível 2', 'href' => '/mesominds/questoes/assunto?assunto=Probabilidade&nivel=2'],
                ['texto' => 'Questões nível 3', 'href' => '/mesominds/questoes/assunto?assunto=Probabilidade&nivel=3']
            ];
            $tituloGrupo2 = "Questões ENEM";
            $linksGrupo2 = [
                ['texto' => 'ENEM 2024', 'href' => '/mesominds/questoes/assunto?assunto=Probabilidade&enem=2024'],
                ['texto' => 'ENEM 2023', 'href' => '/mesominds/questoes/assunto?assunto=Probabilidade&enem=2023'],
                ['texto' => 'ENEM 2022', 'href' => '/mesominds/questoes/assunto?assunto=Probabilidade&enem=2022']
            ];

            include $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/questoesTemplate.php';
            ?>
    </main>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>