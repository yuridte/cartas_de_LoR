<?php 
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); 
?>

<div id="background-video">
    <video autoplay loop autobuffer muted playsinline src="video/<?= $splash_video ?>" id="bg-video"></video>
</div>

<div id="carouselHome" class="carousel slide banner-home" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
    <li data-target="#carouselHome" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active banner-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Seja bem-vindo!</h1>
                    <h2>Leia a minha <a href="artigo.php?slug=mensagem-de-boas-vindas">mensagem</a> de boas-vindas!</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item iniciantes-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 text-center">
                    <a href="beginners.php">
                        <img src="img/beginners.png" alt="Iniciantes">
                    </a>
                </div>
                <div class="col-md-5">
                    <a href="beginners.php">
                        <h1>Área de Iniciantes</h1>
                        <h2>veja a seção para iniciantes e comece bem no Legends of Runeterra</h2>
                    </a>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
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
            <div class="col-sm-12 home-box">
                <h2>Decks em destaque</h2>
                <hr>

                <div class="container deck-list">
                    <div class="row">

                        <!-- LISTA DE DECKS -->
                        <?php
                        $sql = "SELECT * FROM decks WHERE starred LIKE '1' ORDER BY last_update DESC LIMIT 4;";
                        
                        //colocando em array
                        $decks_by_time = $dbConn->query($sql)->fetchAll();

                        foreach ($decks_by_time as $deck) {

                            $regions = explode("|", $deck['regions']);
                            ?>

                            <div class='col-md-3 text-center '>
                                <div class="deck-box-container">
                                    <a href='deck.php?id=<?= $deck['id']; ?>'>
                                        <div class="deck-box">
                                            <div class="regions">
                                                <?php 
                                                foreach ($regions as $region) {
                                                    echo '<img height="70px" title="' . $region . '" src="img/regions/hd/' . $region . '.png">';
                                                }
                                                ?>
                                                
                                            </div>
                                            <div class="letreiro">
                                                <span><?= $deck['name']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                        <div class="col-md-12 text-center">
                            <a href="deck-library.php" class="btn btn-primary">Ver mais decks &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 gotometa">
                <div class="container">
                    <a href="meta.php">
                        <img src="img/decks-meta-link.jpg" width="100%" alt="Decks do Meta">
                    </a>
                </div>
            </div>

            <div class="col-sm-12 home-box">
                <h2>Decks mais novos</h2>
                <hr>

                <div class="container deck-list">
                    <div class="row">

                        <!-- LISTA DE DECKS -->
                        <?php
                        $sql = "SELECT * FROM decks ORDER BY last_update DESC LIMIT 4;";
                        
                        //colocando em array
                        $decks_by_time = $dbConn->query($sql)->fetchAll();

                        foreach ($decks_by_time as $deck) {

                            $regions = explode("|", $deck['regions']);
                            ?>

                            <div class='col-md-3 text-center '>
                                <div class="deck-box-container">
                                    <a href='deck.php?id=<?= $deck['id']; ?>'>
                                        <div class="deck-box">
                                            <div class="regions">
                                                <?php 
                                                foreach ($regions as $region) {
                                                    echo '<img height="70px" title="' . $region . '" src="img/regions/hd/' . $region . '.png">';
                                                }
                                                ?>
                                                
                                            </div>
                                            <div class="letreiro">
                                                <span><?= $deck['name']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                        <div class="col-md-12 text-center">
                            <a href="deck-library.php" class="btn btn-primary">Ver mais decks &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid creators-box">
    <div class="col-sm-12 creators">
        <h2>Criadores de Conteúdo</h2>
        <hr>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <h3>Uma das coisas mais legais do LoR é a comunidade que existe em torno do jogo. E muito disso se dá por conta do incrível trabalho dos criadores de conteúdo. Com certeza acompanhar um produtor de conteúdo é a melhor forma de aprender sobre o jogo e progredir nele. Além do mais, o jogo vai se tornar muito mais divertido!</h3>

                <a href="creators.php" class="btn btn-primary">Ver Criadores &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="container blog-box-home">
    <div class="row">
        <div class="col-sm-12">
            <h2>Últimos artigos</h2>
            <hr>
        </div>
        <?php 
        $sql_blog_home = "SELECT * FROM `articles` WHERE highlighted LIKE '1' ORDER BY title ASC LIMIT 1";
        $artigos_destaque = $dbConn->query($sql_blog_home)->fetchAll();

        foreach ($artigos_destaque as $artigo) {
            extract($artigo);
        ?>
        <div class="col-md-5 text-center">
            <a href="artigo.php?slug=<?= $slug ?>">
                <img src="uploads/blog-thumbs/<?= $id ?>.jpg">
                <span><?= $title ?></span>
            </a>
        </div>
        <?php
        }
        ?>
        <div class="col-md-7">
            <?php 
            $sql_blog_home = "SELECT * FROM `articles` WHERE highlighted LIKE '1' ORDER BY title ASC LIMIT 1,3";
            $artigos_destaque = $dbConn->query($sql_blog_home)->fetchAll();

            foreach ($artigos_destaque as $artigo) {
                extract($artigo);
            ?>
            <div class="text-left small-list-blog">
                <a href="artigo.php?slug=<?= $slug ?>">
                    <table>
                        <tr>
                            <td>
                                <img src="uploads/blog-thumbs/<?= $id ?>.jpg">
                            </td>
                            <td>
                                <span><?= $title ?></span>
                            </td>
                        </tr>
                    </table>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-md-12 text-center">
            <br><br>
            <a href="blog.php" class="btn btn-primary">Ver mais artigos &rarr;</a>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>