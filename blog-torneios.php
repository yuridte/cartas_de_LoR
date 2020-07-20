<?php 
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php");
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
?>

<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Artigos - " + title_topo_atual;
</script>

<div class="banner banner-blog">
    <h1>Artigos de Torneios</h1>
</div>

<div class="container container-padrao container-blog">

    <?php 
    $sql = "SELECT * FROM articles WHERE category LIKE 'torneios' AND category NOT LIKE 'beginners-2' AND category NOT LIKE 'beginners-3' AND category NOT LIKE 'guides' ORDER BY id DESC;";
    $artigos_array = $dbConn->query($sql)->fetchAll();

    //Paginando
    $adapter = new ArrayAdapter($artigos_array);
    $pagerfanta = new Pagerfanta($adapter);

    //setando página atual
    $pagina_atual = NULL;
    if(isset($_GET['pagina'])){
        $pagina_atual = $_GET['pagina'];
    }else{
        $pagina_atual = 1;
    }

    $pagerfanta->setMaxPerPage(10); // 10 by default

    try {
        $pagerfanta->setCurrentPage($pagina_atual); // 1 by default

        $currentPageResults = $pagerfanta->getCurrentPageResults();
        
        foreach ($currentPageResults as $artigo) {
            extract($artigo);
        ?>

            <div class="row justify-content-center artigo-container">
                <div class="col-md-4">
                    <a href="artigo.php?slug=<?= $slug ?>">
                        <img width="100%" src="uploads/blog-thumbs/<?= $id ?>.jpg">
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
    } catch (\Throwable $th) {
        require_once("404.php");
        exit();
    }
    ?>

</div>


<ul class="pagination justify-content-center flex-wrap">
    <?php
    //links para cada página
    if ($pagerfanta->hasPreviousPage()) {
        $previousPage = $pagerfanta->getPreviousPage();
        echo "<li class='page-item width-47'><a class='page-link' href='?pagina=$previousPage'>
        <span aria-hidden=\"true\">&laquo;</span>
        <span class=\"sr-only\">Anterior</span>
        </a></li>";
    }

    //só quero exibir a quantidade do range de links
    $range = 5;
    $primeira_pagina = $pagina_atual - $range;
    $ultima_pagina = $pagina_atual + $range;
    $nbPages = $pagerfanta->getNbPages();
    for ($pagina=1; $pagina <= $nbPages; $pagina++) {
        if ($pagina == $pagina_atual) {
            if($pagina < 10) {
                $pagina = "0".$pagina;
            }
            echo "<li class='page-item active'><a class='page-link'>$pagina</a></li>";
        } else {
            if($pagina < 10) {
                $pagina = "0".$pagina;
            }
            echo "<li class='page-item'><a class='page-link' href='?pagina=$pagina'>$pagina</a></li>";
        }    
    }

    if ($pagerfanta->hasNextPage()) {
        $nextPage = $pagerfanta->getNextPage();
        echo "<li class='page-item width-47'><a class='page-link' href='?pagina=$nextPage'>
        <span aria-hidden=\"true\">&raquo;</span>
        <span class=\"sr-only\">Próximo</span>
        </a></li>";
    }

    ?>
</ul>



<?php
require_once("footer.php");
?>