<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questões</title>
    <link rel="stylesheet" type="text/css" href="../CSS/global.css">
    <link rel="stylesheet" type="text/css" href="../css/questoes.css">
    <link rel="stylesheet" type="text/css" href="../components/header.css">
    <link rel="stylesheet" type="text/css" href="../components/footer.css">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once '../components/header.php' ?>
    <main>
        <h1>
            Questões por assunto
        </h1>
        <?php
        $tituloPrincipal = "Funções";
        $tituloGrupo1 = "Quetões por nível";
        $linksGrupo1 = [
            ['texto' => 'Questões nível 1', 'href' => 'questoesFuncoesNivel1.php'],
            ['texto' => 'Questões nível 2', 'href' => '#nivel2'],
            ['texto' => 'Questões nível 3', 'href' => '#nivel3']
        ];
        $tituloGrupo2 = "Questões ENEM";
        $linksGrupo2 = [
            ['texto' => 'ENEM 2024', 'href' => '#enem2024'],
            ['texto' => 'ENEM 2023', 'href' => '#enem2023'],
            ['texto' => 'ENEM 2022', 'href' => '#enem2022']
        ];

        include '../components/questoesTemplate.php';
        ?>
        <?php
        $tituloPrincipal = "Conjuntos";
        $tituloGrupo1 = "Quetões por nível";
        $linksGrupo1 = [
            ['texto' => 'Questões nível 1', 'href' => '#nivel1'],
            ['texto' => 'Questões nível 2', 'href' => '#nivel2'],
            ['texto' => 'Questões nível 3', 'href' => '#nivel3']
        ];
        $tituloGrupo2 = "Questões ENEM";
        $linksGrupo2 = [
            ['texto' => 'ENEM 2024', 'href' => '#enem2024'],
            ['texto' => 'ENEM 2023', 'href' => '#enem2023'],
            ['texto' => 'ENEM 2022', 'href' => '#enem2022']
        ];

        include '../components/questoesTemplate.php';
        ?>
        <?php
        $tituloPrincipal = "Frações";
        $tituloGrupo1 = "Quetões por nível";
        $linksGrupo1 = [
            ['texto' => 'Questões nível 1', 'href' => '#nivel1'],
            ['texto' => 'Questões nível 2', 'href' => '#nivel2'],
            ['texto' => 'Questões nível 3', 'href' => '#nivel3']
        ];
        $tituloGrupo2 = "Questões ENEM";
        $linksGrupo2 = [
            ['texto' => 'ENEM 2024', 'href' => '#enem2024'],
            ['texto' => 'ENEM 2023', 'href' => '#enem2023'],
            ['texto' => 'ENEM 2022', 'href' => '#enem2022']
        ];

        include '../components/questoesTemplate.php';
        ?>
        <?php
        $tituloPrincipal = "Porcentagem";
        $tituloGrupo1 = "Quetões por nível";
        $linksGrupo1 = [
            ['texto' => 'Questões nível 1', 'href' => '#nivel1'],
            ['texto' => 'Questões nível 2', 'href' => '#nivel2'],
            ['texto' => 'Questões nível 3', 'href' => '#nivel3']
        ];
        $tituloGrupo2 = "Questões ENEM";
        $linksGrupo2 = [
            ['texto' => 'ENEM 2024', 'href' => '#enem2024'],
            ['texto' => 'ENEM 2023', 'href' => '#enem2023'],
            ['texto' => 'ENEM 2022', 'href' => '#enem2022']
        ];

        include '../components/questoesTemplate.php';
        ?>
        <?php
        $tituloPrincipal = "Probabilidade";
        $tituloGrupo1 = "Quetões por nível";
        $linksGrupo1 = [
            ['texto' => 'Questões nível 1', 'href' => '#nivel1'],
            ['texto' => 'Questões nível 2', 'href' => '#nivel2'],
            ['texto' => 'Questões nível 3', 'href' => '#nivel3']
        ];
        $tituloGrupo2 = "Questões ENEM";
        $linksGrupo2 = [
            ['texto' => 'ENEM 2024', 'href' => '#enem2024'],
            ['texto' => 'ENEM 2023', 'href' => '#enem2023'],
            ['texto' => 'ENEM 2022', 'href' => '#enem2022']
        ];

        include '../components/questoesTemplate.php';
        ?>
    </main>
    <?php include_once '..\components\footer.php'; ?>
</body>

</html>