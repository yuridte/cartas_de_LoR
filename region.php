<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site

if (isset($_GET['region'])) {
    $regionRef = $_GET['region'];
    $sql = "SELECT * FROM regions WHERE regionRef LIKE '$regionRef';";
    $region_array = $dbConn->query($sql)->fetchAll();

    foreach ($region_array as $region) {
        extract($region);
        ?>

        <video autoplay muted loop class="regions-video" id="regions-video">
            <source src="video/<?= $regionRef ?>-splashvideo.webm" type="video/webm">
        </video>

        <div class="banner banner-region">
            <h1><?= $name ?></h1>
        </div>

        <div class="container-fluid container-regions-msg container-region-data">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <img src="img/regions/hd/<?= $regionRef ?>.png" alt="<?= $name ?>">
                </div>
                <div class="col-md-7 text-center">
                    <?= $description ?>
                </div>
            </div>
        </div>

        <br><br><br>

        <div class="container cosmeticos-regiao">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Tabuleiro</h2><br>
                    <img src="img/board/board_<?= $regionRef ?>.jpg" alt="Tabuleiro <?= $name ?>">
                </div>
                <div class="col-md-4">
                    <h2>Cardback</h2><br>
                    <img src="img/cardback/cardback_<?= $regionRef ?>.jpg" alt="Cardback <?= $name ?>">
                </div>
            </div>
        </div>

        <br><br><br><br><br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2>Campeões</h2>
                </div>
                <?php 
                //finalizando SQL
                $sql_champs = "SELECT * FROM cards WHERE regionRef LIKE '$regionRef' AND supertype LIKE 'Campeão' AND collectible LIKE '1' ORDER BY cost ASC";
                //colocando em array
                $cards_by_cost = $dbConn->query($sql_champs)->fetchAll();

                foreach ($cards_by_cost as $card) {
                    echo "<div class='col-md-3 carta-link'>";
                    echo "<a href=card.php?cardCode=" . $card['cardCode'] . ">";
                    echo "<img src='img/cards_medium_size/" . $card['cardCode'] ."-medium.png'/>";
                    echo "</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <?php
    }
}else{
    //redirecionar para home
    ?>
    <script type="text/javascript">
        window.location.href = "regions.php";
    </script>
    <?php
}

require_once("footer.php"); //rodapé do site
?>