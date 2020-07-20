<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>

<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Decks do Meta - " + title_topo_atual;
</script>

<div class="banner banner-palavras-chave">
    <h1>Meta</h1>
</div>

<div class="container">
    <div class="row artigo-container justify-content-center">
        <div class="col-md-12 text-center">
            <p>Quer saber o que é meta? Quer entender a classificação dos decks? Veja esse artigo: <i><b><a href="artigo.php?slug=o-que-e-meta">O que é meta?</a></b></i></p>
            <p>Os decks obtiveram a curadoria incrível do <a href="https://www.twitch.tv/gwentartv" role='link'><b>Gwentar</b></a>, <a href="https://www.twitch.tv/capitaoserket" role='link'><b>Serket</b></a>, <a href="https://www.twitch.tv/tetadourso" role='link'><b>Teta do Urso</b></a> e <a href="https://www.twitch.tv/sudrakon" role='link'><b>Sudrakon</b></a>. Acesse as redes sociais dos Pro Players clicando nos links abaixo para conferir todo o processo de análise dos decks.</p>
            <div class="social-box-footer">
                <table class="hidden-sd" width="100%">
                    <tr>
                        <td>
                            <h4>Gwentar TV</h4>
                            <a href="https://www.facebook.com/gwentartv" target="blank" class="facebook-link"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://twitter.com/GwentarTV" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                            <a href="https://www.youtube.com/c/GwentarTV2" target="blank" class="youtube-link"><i class="fab fa-youtube-square"></i></a>
                            <a href="https://www.twitch.tv/gwentartv" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                        </td>
                        <td>
                            <h4>Serket</h4>
                            <a href="https://www.facebook.com/felipeserket" target="blank" class="facebook-link"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://twitter.com/TheSerket" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                            <a href="https://www.youtube.com/channel/UCZWRX759RWdHQs9tSoA4JFg/featured" target="blank" class="youtube-link"><i class="fab fa-youtube-square"></i></a>
                            <a href="https://www.twitch.tv/capitaoserket" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                        </td>
                        <td>
                            <h4>Teta do Urso</h4>
                            <a href="https://www.facebook.com/tetadourso" target="blank" class="facebook-link"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://twitter.com/TetadoUrso" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                            <a href="https://www.youtube.com/c/TetadoUrso/featured" target="blank" class="youtube-link"><i class="fab fa-youtube-square"></i></a>
                            <a href="https://www.twitch.tv/tetadourso" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                        </td>
                        <td>
                            <h4>Sudrakon</h4>
                            <a href="https://twitter.com/SudrakonLoR" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                            <a href="https://www.twitch.tv/sudrakon" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                        </td>
                    </tr>
                </table>
                <div class="hidden-md">
                    <div>
                        <h4>Gwentar TV</h4>
                        <a href="https://www.facebook.com/gwentartv" target="blank" class="facebook-link"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://twitter.com/GwentarTV" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                        <a href="https://www.youtube.com/c/GwentarTV2" target="blank" class="youtube-link"><i class="fab fa-youtube-square"></i></a>
                        <a href="https://www.twitch.tv/gwentartv" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                    </div>
                    <div>
                        <h4>Serket</h4>
                        <a href="https://www.facebook.com/felipeserket" target="blank" class="facebook-link"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://twitter.com/TheSerket" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                        <a href="https://www.youtube.com/channel/UCZWRX759RWdHQs9tSoA4JFg/featured" target="blank" class="youtube-link"><i class="fab fa-youtube-square"></i></a>
                        <a href="https://www.twitch.tv/capitaoserket" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                    </div>
                    <div>
                        <h4>Teta do Urso</h4>
                        <a href="https://www.facebook.com/tetadourso" target="blank" class="facebook-link"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://twitter.com/TetadoUrso" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                        <a href="https://www.youtube.com/c/TetadoUrso/featured" target="blank" class="youtube-link"><i class="fab fa-youtube-square"></i></a>
                        <a href="https://www.twitch.tv/tetadourso" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                    </div>
                    <div>
                        <h4>Sudrakon</h4>
                        <a href="https://twitter.com/SudrakonLoR" target="blank" class="twitter-link"><i class="fab fa-twitter-square"></i></a>
                        <a href="https://www.twitch.tv/sudrakon" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a>
                    </div>
                </div>
            </div>
            <br>
            <p><b>Atualizado em 16/07/2020</b></p>
        </div>
    </div>
</div>
<br><br><br><br><br>
<div class="container meta-box">
    <div class="col-md-12">
        <h1>Tier S</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'S' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="col-md-12">
        <h1>Tier S-</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'S-' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>


    <div class="col-md-12">
        <h1>Tier A+</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'A+' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>


    <div class="col-md-12">
        <h1>Tier A</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'A' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="col-md-12">
        <h1>Tier A-</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'A-' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="col-md-12">
        <h1>Tier B+</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'B+' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="col-md-12">
        <h1>Tier B</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'B' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?>


<?php /* 
    <div class="col-md-12">
        <h1>Tier B-</h1>
    </div>
    <?php
    $sql = "SELECT * FROM decks WHERE tier LIKE 'B-' ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <a href="deck.php?id=<?= $id ?>"><h2><span><?= $name ?></span></h2></a>
                <br>
                <a href="deck.php?id=<?= $id ?>"><button class="btn btn-success">Ver deck</button></a>
            </div>
            <div class="col-md-4">
                <p><?= $description ?></p>
            </div>
            <div class="col-md-8">
                <hr>
            </div>
        </div>
    <?php
    }
    ?> */ ?>
</div>

<br><br><br>
<?php 
//incluindo sessão de compartilhamento
include('share-box.php');
require_once("footer.php"); //rodapé do site
?>