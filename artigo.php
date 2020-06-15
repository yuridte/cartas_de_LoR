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
        ?>

        <div class="banner banner-carta" style="background-image: url('uploads/blog-thumbs/<?= $id ?>');">
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