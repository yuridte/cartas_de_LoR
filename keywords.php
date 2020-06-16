<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>

<div class="banner banner-palavras-chave">
    <h1>Palavras-chave</h1>
</div>

<div class="container">
    <div class="row artigo-container justify-content-center">
        <div class="col-md-8 text-center">
            <p>Conhecer as palavras-chave é essencial para extrair o melhor das cartas de <i>Legends of Runeterra</i>. Mas uma palavra de alerta... Ler é importante para entender as cartas, mas somente a prática vai fazer você decorar o que cada palavra-chave faz. Então se você viu alguma palavra-chave que achou interessante entre no jogo e crie uma partida contra a IA (Inteligência Artificial) para ver o que realmente aquilo faz. Todas essas palavras-chave estão no kit para desenvolvedores disponibilizado pela própria Riot.</p>
        </div>
    </div>
</div>
<br><br><br><br><br>
<div class="container">
    <?php
    $sql = "SELECT * FROM keywords ORDER BY name ASC;";
    $keywords_array = $dbConn->query($sql)->fetchAll();

    foreach ($keywords_array as $keyword) {
        extract($keyword);  
        ?>
        <div class="row justify-content-center keyword-box">
            <div class="col-md-5 text-left">
                <h2><img src="img/keywords/Keyword_<?= $ref ?>" alt="<?= $name ?>" onerror="this.style.display='none'"> <span><?= $name ?></span></h2>
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