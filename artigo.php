<?php 
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php");

if(isset($_GET['slug'])) {
    //Preparando consulta a banco de dados
    $slug = $_GET['slug'];
    $sql = "SELECT * FROM articles WHERE slug LIKE '$slug';";
    $artigo_array = $dbConn->query($sql)->fetchAll();

    foreach ($artigo_array as $artigo) {
        extract($artigo);
        $titulo_share = $title;
        $imagem_share = "uploads/blog-thumbs/$id";
        ?>

        <script type="text/javascript">
            // Mudando o title
            var title_topo_atual = document.title;
            document.title = "<?= $title ?> - " + title_topo_atual;
        </script>

        <div class="banner banner-carta" style="background-image: url('uploads/blog-thumbs/<?= $id ?>.jpg');">
            <br><br>
            <h1><?= $title ?></h1>
        </div>

        <br><br>
        <?php 
        //incluindo sessão de compartilhamento
        include('share-box.php');
        ?>

        <div class="container artigo-container container-padrao">
            <div class="row justify-content-center">
                <div class="col-md-12 text-left">
                    <small><?= $timestamp ?></small>
                    <small><?= $category ?></small>
                    <?= $content ?>
                </div>

                <div class="col-md-6 box-tags">
                    <h2>Autor</h2>
                    <?php 
                    $sql_autor = "SELECT * FROM user WHERE id LIKE '" . $owner_id . "';";
                    $autor_array = $dbConn->query($sql_autor)->fetchAll();
                    foreach ($autor_array as $autor) {
                    ?>
                        <b><i><?= $autor['name'] ?></i></b>
                    <?php 
                    } 
                    ?>
                </div>

                <div class="col-md-6 box-tags">
                    <h2>Tags</h2>
                    <?php 
                    $tags = explode(",", $tags);
                    
                    foreach ($tags as $tag) {
                        if ($tag != "") {
                            echo "<div class='tag'>" . $tag . "</div>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>

        <br><br>

        <?php 
        //incluindo sessão de compartilhamento
        include('share-box.php');
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="fb-root"></div>
                    <meta property="fb:app_id" content="183960886382685" />
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=183960886382685&autoLogAppEvents=1" nonce="HptluutG"></script>
                    <div class="fb-comments" data-order-by="reverse_time" data-href="<?= $url_atual ?>" data-colorscheme="dark" data-numposts="5" data-width="100%"></div>
                </div>
            </div>
        </div>

        <?php
    }
}else{
    //redirecionar para home
    ?>
    <script type="text/javascript">
        window.location.href = "blog.php";
    </script>
    <?php
}

require_once("footer.php");
?>