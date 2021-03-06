<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php");
?>

<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Criadores de Conteúdo - " + title_topo_atual;
</script>

<div class="banner banner-criadores-conteudo">
    <h1>Criadores de Conteúdo</h1>
</div>

<div class="container creator-container">

    <div class="row artigo-container justify-content-center">
        <div class="col-md-12 text-center">
            <h2>Anuncie seu trabalho aqui!</h2>
            <hr>
            <p>Um dos objetivos do <b>Mestres de Runeterra</b> é fortalecer a comunidade brasileira de Legends of Runeterra. Para isso não estou sozinho, conto com você produtor de conteúdo! Anuncie sua stream, seu canal e suas redes sociais gratuitamente e tenha mais visibilidade. Juntos nós podemos fazer coisas incríveis!</p>
            <p>Mande um e-mail pela <a href="contact.php">página de contato</a> e anuncie conosco gratuitamente!</p>
            <a href="lives.php"><button class="btn btn-danger">Veja quem está em live &rarr;</button></a>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM creators ORDER BY id ASC;";
    
    //colocando em array
    $creators_array = $dbConn->query($sql)->fetchAll();

    foreach ($creators_array as $creator) {
    ?>
        <div class="row creator">
            <div class="col-md-4">
                <img src="uploads/creators/<?= $creator['id'] ?>.png" width="100%" alt="mestre">
            </div>
            <div class="col-md-8 text-center">
                <h2><?= $creator['name'] ?></h2>
                <hr>
                <p><?= $creator['description'] ?></p>
                <div class="social-box-footer">
                    <?php if($creator['facebook'] != ""){ ?><a href="<?= $creator['facebook'] ?>" target="blank" class="facebook-link"><i class="fab fa-facebook"></i></a><?php } ?>

                    <?php if($creator['twitter'] != ""){ ?><a href="<?= $creator['twitter'] ?>" target="blank" class="twitter-link"><i class="fab fa-twitter"></i></a><?php } ?>

                    <?php if($creator['youtube'] != ""){ ?><a href="<?= $creator['youtube'] ?>" target="blank" class="youtube-link"><i class="fab fa-youtube"></i></a><?php } ?>

                    <?php if($creator['instagram'] != ""){ ?><a href="<?= $creator['instagram'] ?>" target="blank" class="instagram-link"><i class="fab fa-instagram"></i></a><?php } ?>
                    
                    <?php if($creator['twitch'] != ""){ ?><a href="<?= $creator['twitch'] ?>" target="blank" class="twitch-link"><i class="fab fa-twitch"></i></a><?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<br><br><br>

<?php 
//incluindo sessão de compartilhamento
include('share-box.php');
?>

<?php
require_once("footer.php");
?>