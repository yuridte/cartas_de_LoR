<?php 
require_once("header.php"); 
?>

<div id="background-video">
    <video autoplay loop autobuffer muted playsinline src="video/<?= $splash_video ?>" id="bg-video"></video>
</div>

<div id="carouselHome" class="carousel slide banner-home" data-ride="carousel">
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

<div class="container-fluid conteudo">
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