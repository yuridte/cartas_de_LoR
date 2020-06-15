<?php 
require_once("cfg.php");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-36323975-8"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-36323975-8');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon-mestres-de-runeterra-32.jpg" sizes="32x32">
    <link rel="shortcut icon" href="img/favicon-mestres-de-runeterra.jpg" sizes="57x57">
    <title>Mestres de Runeterra</title>

    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" data-auto-replace-svg="nest"></script>
    
    <!-- CSS Styles -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

    <!-- MENU -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav">
        <a class="navbar-brand" href="home.php"><img src="img/logo-mestres-de-runeterra-small.png" alt="Mestres de Runeterra"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">HOME</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    O JOGO
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="regions.php">REGIÕES</a>
                        <a class="dropdown-item" href="keywords.php">Palavras-Chave</a>
                        <a class="dropdown-item" href="#">Cosméticos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">GUIAS</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="card-gallery.php">CARTAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deck-library.php">DECKS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">BLOG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="beginners.php">INICIANTES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="embreve.php">Dicionário</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTATO</a>
                </li>
                <li class="nav-item dropdown">
                    <?php 
                    if(isset($_COOKIE['login']) && $_COOKIE['login'] == "true"){
                        ?>

                        <a class="nav-link dropdown-toggle" href="#" id="login-drop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Olá, <?= $_COOKIE['name'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="login-drop">
                            <a class="dropdown-item" href="my-profile.php">Ver Perfil</a>
                            <a class="dropdown-item" href="my-decks.php">Meus Decks</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="encerrar_sessao.php">SAIR</a>
                        </div>
                        <?php
                    }else{
                        echo '<a class="nav-link" href="entrar.php">ENTRAR</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- FIM menu -->