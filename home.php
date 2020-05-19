<?php 
require_once("header.php"); 
?>


<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark bg-nav">
    <a class="navbar-brand" href="/">Mestres de Runeterra</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">HOME</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                REGIÕES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">REGIÕES</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">ÁGUAS DE SENTINA</a>
                    <a class="dropdown-item" href="#">DEMACIA</a>
                    <a class="dropdown-item" href="#">FRELJORD</a>
                    <a class="dropdown-item" href="#">ILHAS DAS SOMBRAS</a>
                    <a class="dropdown-item" href="#">IONIA</a>
                    <a class="dropdown-item" href="#">NOXUS</a>
                    <a class="dropdown-item" href="#">PILTOVER & ZAUN</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">CARTAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">DECKS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">BLOG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">INICIANTES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">CONTATO</a>
            </li>
        </ul>
    </div>
</nav>
<!-- FIM menu -->

<div id="background-video">
    <video autoplay loop autobuffer muted playsinline src="video/bilgewater-splashvideo.webm" id="bg-video"></video>
</div>

<div id="carouselHome" class="carousel slide banner" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
    <li data-target="#carouselHome" data-slide-to="1"></li>
    <li data-target="#carouselHome" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Seja bem-vindo!</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="container-fluid fade-separator"></div>

<div class="container-fluid conteudo-home">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Decks em alta</h2>
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>Decks em alta</h2>
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>Decks em alta</h2>
                <hr>
            </div>
            <div class="col-sm-12">
                <h2>Decks em alta</h2>
                <hr>
            </div>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>