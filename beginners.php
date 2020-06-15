<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site

if (isset($_GET['parte'])) {
    switch ($_GET['parte']) {
        case '1':
            ?>

            <div class="banner banner-beginners">
                <h1>Parte I</h1>
            </div>

            <div class="container container-padrao container-blog">

                <?php 
                $sql = "SELECT * FROM articles WHERE category LIKE 'beginners-1';";
                $artigos_array = $dbConn->query($sql)->fetchAll();

                foreach ($artigos_array as $artigo) {
                    extract($artigo);
                    ?>

                    <div class="row justify-content-center artigo-container">
                        <div class="col-md-4">
                            <a href="artigo.php?slug=<?= $slug ?>">
                                <img width="100%" src="uploads/blog-thumbs/<?= $id ?>">
                            </a>
                        </div>
                        <div class="col-md-8 text-left">
                            <a href="artigo.php?slug=<?= $slug ?>"><h2><?= $title ?></h2></a>
                            <small><?= $timestamp ?></small>
                            <small><?= $category ?></small>
                            <?php 
                            $sql_autor = "SELECT * FROM user WHERE id LIKE '" . $owner_id . "';";
                            $autor_array = $dbConn->query($sql_autor)->fetchAll();
                            foreach ($autor_array as $autor) {
                            ?>
                                <span>Autor: <b><i><?= $autor['name'] ?></i></b></span>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>


            <?php
            break;

        case '2':
            ?>

            <div class="banner banner-beginners" style="background-image: url('img/beginners-2.jpg');">
                <h1>Parte II</h1>
            </div>

            <div class="container container-padrao container-blog">

                <?php 
                $sql = "SELECT * FROM articles WHERE category LIKE 'beginners-2';";
                $artigos_array = $dbConn->query($sql)->fetchAll();

                foreach ($artigos_array as $artigo) {
                    extract($artigo);
                    ?>

                    <div class="row justify-content-center artigo-container">
                        <div class="col-md-4">
                            <a href="artigo.php?slug=<?= $slug ?>">
                                <img width="100%" src="uploads/blog-thumbs/<?= $id ?>">
                            </a>
                        </div>
                        <div class="col-md-8 text-left">
                            <a href="artigo.php?slug=<?= $slug ?>"><h2><?= $title ?></h2></a>
                            <small><?= $timestamp ?></small>
                            <small><?= $category ?></small>
                            <?php 
                            $sql_autor = "SELECT * FROM user WHERE id LIKE '" . $owner_id . "';";
                            $autor_array = $dbConn->query($sql_autor)->fetchAll();
                            foreach ($autor_array as $autor) {
                            ?>
                                <span>Autor: <b><i><?= $autor['name'] ?></i></b></span>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>

            <?php
            break;

        case '3':
            ?>

            <div class="banner banner-beginners" style="background-image: url('img/beginners-3.jpg');">
                <h1>Parte III</h1>
            </div>

            <div class="container container-padrao container-blog">

                <?php 
                $sql = "SELECT * FROM articles WHERE category LIKE 'beginners-3';";
                $artigos_array = $dbConn->query($sql)->fetchAll();

                foreach ($artigos_array as $artigo) {
                    extract($artigo);
                    ?>

                    <div class="row justify-content-center artigo-container">
                        <div class="col-md-4">
                            <a href="artigo.php?slug=<?= $slug ?>">
                                <img width="100%" src="uploads/blog-thumbs/<?= $id ?>">
                            </a>
                        </div>
                        <div class="col-md-8 text-left">
                            <a href="artigo.php?slug=<?= $slug ?>"><h2><?= $title ?></h2></a>
                            <small><?= $timestamp ?></small>
                            <small><?= $category ?></small>
                            <?php 
                            $sql_autor = "SELECT * FROM user WHERE id LIKE '" . $owner_id . "';";
                            $autor_array = $dbConn->query($sql_autor)->fetchAll();
                            foreach ($autor_array as $autor) {
                            ?>
                                <span>Autor: <b><i><?= $autor['name'] ?></i></b></span>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>

            <?php
            break;
        
        default:
            ?>
            <script type="text/javascript">
                window.location.href = "beginners.php";
            </script>
            <?php
            break;
    }
}else{
    ?>

    <div class="banner banner-beginners">
        <h1>Área de Iniciantes</h1>
    </div>

    <div class="container-fluid container-beginners-msg">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>Sejam bem-vindos novos jogadores de Legends of Runeterra! </h2>
                <p>Eu sou o Eniac e tenho como missão ajudá-lo(a) a progredir no LoR. Eu sei que no começo pode parecer complicado entrar num jogo com tantas cartas e mecânicas, mas se você tiver paciência e me acompanhar no tutorial eu prometo que seu aprendizado será bem divertido! Clique na <b>Parte I</b> e veja os artigos relacionados. Se pelos títulos dos artigos você achar que já sabe tudo então partiu <b>Parte II</b> e depois <b>Parte III</b>. </p>
                <p>Ah! Não se esqueça de me dizer o que achou dos artigos e o que posso melhorar lá nas minhas redes sociais ou no formulário de <a href='contact.php'>contato</a> aqui no site. Um forte abraço e até mais!</p>
            </div>
        </div>
    </div>

    <div class="container container-beginners">
        <div class="row">
            <div class="col-md-4 text-center">
                <a href="?parte=1">
                    <img src="img/beginners-p1.jpg" alt="Parte I">
                </a>
            </div>
            <div class="col-md-4 text-center">
                <a href="?parte=2">
                    <img src="img/beginners-p2.jpg" alt="Parte II">
                </a>
            </div>
            <div class="col-md-4 text-center">
                <a href="?parte=3">
                    <img src="img/beginners-p3.jpg" alt="Parte III">
                </a>
            </div>
        </div>
    </div>
<?php
}

require_once("footer.php"); //rodapé do site
?>