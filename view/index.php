<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MesoMinds</title>
    <link rel="stylesheet" type="text/css" href="/mesominds/CSS/global.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/css/index.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/footer.css">
    <link rel="stylesheet" type="text/css" href="/mesominds/view/partials/header.css">
    <link rel="icon" href="/mesominds/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/header.php'; ?>

    <div class="heroSection">
        <div class="bannerArea">
        </div>
        <div class="ComeceAgoraArea">
            <h1>Comece a aprender matemática agora! Grátis!</h1>
            <a href="#">Comece a aprender agora mesmo!</a>
        </div>
    </div>
    <div class="profArea">
        <h1>
            Conheça seus professores!
        </h1>
        <div class="profImgsContainer">
            <a href="#" class="profItem">
                <div class="profImg">
                    <img src="/mesominds/imgs/CLEIDIMENO.png" alt="Prof. Cleidi">
                </div>
                <span class="profName">Prof. Cleidi</span>
            </a>

            <a href="#" class="profItem">
                <div class="profImg">
                    <img src="/mesominds/imgs/JACKSUMENOR.png" alt="Prof. Jackson">
                </div>
                <span class="profName">Prof. Jackson</span>
            </a>

            <a href="#" class="profItem">
                <div class="profImg">
                </div>
                <span class="profName">Em breve!</span>
            </a>
        </div>
    </div>

    <div class="questoesContainer">
        <h1>Teste seu conhecimento</h1>
        <h4>Principais conteúdos ENEM</h4>
        <div class="questoesContent">
            <div class="questContArea">
                <a href="#">Matemática básica</a>
                <a href="#">Estatística</a>
                <a href="#">Geometria Espacial</a>
                <a href="#">Funções</a>
                <a href="#">Geometria Plana</a>
                <a href="#">Aritmética</a>
            </div>
            <div class="questEnemeArea">
                <a href="#">Questões ENEM 2024</a>
                <a href="#">Questões ENEM 2023</a>
                <a href="#">Questões ENEM 2022</a>
                <a href="#">Questões ENEM 2021</a>
            </div>
        </div>
    </div>
    <div class="CadasAgoraArea">
        <h1>
            Comece a aprender agora!
        </h1>
        <a href="#">Comece a aprender!</a>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/mesominds/view/partials/footer.php'; ?>
</body>

</html>