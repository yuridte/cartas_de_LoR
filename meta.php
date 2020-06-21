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
        <div class="col-md-8 text-center">
            <p>Quer saber o que é meta? Veja esse artigo: <i><b><a href="artigo?slug=o-que-e-meta">O que é meta?</a></b></i></p>
            <p>O meta está prestes a sofrer uma mudança no patch 1.4. Após o patch vamos aguardar o meta estabilizar e postar aqui.</p>
            <p><b>Atualizado em 19/06/2020</b></p>
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
</div>

<br><br><br>
<?php 
//incluindo sessão de compartilhamento
include('share-box.php');
require_once("footer.php"); //rodapé do site
?>