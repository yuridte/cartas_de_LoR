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
                    <h1>Veja os decks do Meta!</h1>
                    <h2>Veja os melhores decks com a curadoria<br>dos grandes Gwentar, Serket, Teta do Urso e Sudrakon. <a href="meta.php">Ver meta!</a></h2>
                    <h2>Atualizado em 16/07/2020</h2>
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
                <h2>Decks da comunidade</h2>
                <hr>

                <div class="container deck-list">
                    <div class="row">

                        <!-- LISTA DE DECKS -->
                        <?php
                        $sql = "SELECT * FROM decks ORDER BY last_update DESC LIMIT 12;";
                        
                        //colocando em array
                        $decks_by_time = $dbConn->query($sql)->fetchAll();

                        foreach ($decks_by_time as $deck) {

                            $regions = explode("|", $deck['regions']);
                            ?>

                            <div class='col-md-2 text-center deck-link'>
                                <div class="deck-box-container">
                                    <a href='deck.php?id=<?= $deck['id']; ?>'>
                                        <div class="deck-box">
                                            <div class="regions">
                                                <?php 
                                                foreach ($regions as $region) {
                                                    echo '<img height="40px" title="' . $region . '" src="img/regions/vanilla/icon-' . $region . '.png">';
                                                }
                                                ?>
                                            </div>

                                            <div class="letreiro">
                                                <span><?= $deck['name']; ?></span>

                                                <?php 
                                                $sql_user = "SELECT name FROM user WHERE id LIKE '" . $deck['owner_id'] . "';";
                                                //colocando em array
                                                $user_array = $dbConn->query($sql_user)->fetchAll();

                                                //escrevendo os decks individualmente
                                                foreach ($user_array as $user) {
                                                    ?>
                                                    <h3><i><?= $user['name']; ?></i></h3>
                                                    <?php
                                                }
                                                $data_ultima_atualizacao = date('d/m/Y H:i',strtotime($deck['last_update']));
                                                ?>
                                                <h3><i><?= $data_ultima_atualizacao; ?></i></h3>

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

<div class="container-fluid meta-box-home">
    <div class="col-sm-12 creators">
        <h2>Meta Game</h2>
        <hr>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <h3>O metagame funciona para explicar as estratégias populares em determinado momento.</h3>
                <h3>O meta não é uma lista mágica dos decks que vão fazer você pegar mestre. É uma opinião sobre os decks mais usados na atualidade e a força deles comparados entre si.</h3>
                <h3>O Mestres de Runeterra usa a classificação de Tier S, A e B.</h3>

                <a href="meta.php" class="btn btn-primary">Ver Decks do Meta &rarr;</a>
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
        $sql_blog_home = "SELECT * FROM `articles` WHERE highlighted LIKE '1' AND status NOT LIKE 'deletado' ORDER BY id DESC LIMIT 1";
        $artigos_destaque = $dbConn->query($sql_blog_home)->fetchAll();

        foreach ($artigos_destaque as $artigo) {
            extract($artigo);
        ?>
        <div class="col-md-6 artigo-destaque text-center">
            <a href="artigo.php?slug=<?= $slug ?>">
                <img src="uploads/blog-thumbs/<?= $id ?>.jpg">
                <span><?= $title ?></span>
            </a>
        </div>
        <?php
        }
        ?>
        <div class="col-md-6">
            <?php 
            $sql_blog_home = "SELECT * FROM `articles` WHERE highlighted LIKE '1' AND status NOT LIKE 'deletado' ORDER BY id DESC LIMIT 1,4";
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

<?php
require_once("footer.php");
?>