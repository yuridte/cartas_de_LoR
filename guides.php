<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>

<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Guias - " + title_topo_atual;
</script>

<div class="banner banner-guias">
    <h1>Guias</h1>
</div>

<div class="container">
    <div class="row artigo-container justify-content-center">
        <div class="col-md-8 text-center">
            <p>Os Guias são artigos atualizados de tempos em tempos para ajudar você a conhecer o LoR e melhorar no jogo.</p>
        </div>
    </div>
</div>
<br><br><br><br><br>
<div class="container">
    <?php
    $sql = "SELECT * FROM articles WHERE category LIKE 'guides' ORDER BY title ASC;";
    $guides_array = $dbConn->query($sql)->fetchAll();

    foreach ($guides_array as $guides) {
        extract($guides);
        ?>
        <div class="row justify-content-center guias-box">
            <div class="col-md-12 text-center">
                <h1><a href="artigo.php?slug=<?= $slug ?>"><?= $title ?></a></h1>
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