<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
?>

<div class="banner banner-dictionary">
    <h1>Dicionário Interativo</h1>
</div>

<div class="container">
    <div class="row artigo-container justify-content-center">
        <div class="col-md-8 text-center">
            <p>Se houver algum termo que queira adicionar ao dicionário fale comigo no formulário de contato ou nas redes sociais.</p>
        </div>
    </div>
</div>
<br><br><br><br><br>
<div class="container">
    <?php
    $sql = "SELECT * FROM dictionary ORDER BY term ASC;";
    $dictionary_array = $dbConn->query($sql)->fetchAll();

    //Paginando
    $adapter = new ArrayAdapter($dictionary_array);
    $pagerfanta = new Pagerfanta($adapter);

    //setando página atual
    $pagina_atual = NULL;
    if(isset($_GET['pagina'])){
        $pagina_atual = $_GET['pagina'];
    }else{
        $pagina_atual = 1;
    }

    $pagerfanta->setMaxPerPage(28); // 10 by default

    try {
        $pagerfanta->setCurrentPage($pagina_atual); // 1 by default

        $currentPageResults = $pagerfanta->getCurrentPageResults();
        
        foreach ($currentPageResults as $entry) {
            extract($entry);
            ?>
            <div class="row justify-content-center keyword-box">
                <div class="col-md-5 text-left">
                    <h2><span><?= $term ?></span></h2>
                </div>
                <div class="col-md-4">
                    <p><?= $meaning ?></p>
                </div>
                <div class="col-md-8">
                    <hr>
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
        echo "<li class='page-item width-47'><a class='page-link' href='?pagina=$previousPage$url_get'>
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
            echo "<li class='page-item'><a class='page-link' href='?pagina=$pagina$url_get'>$pagina</a></li>";
        }    
    }

    if ($pagerfanta->hasNextPage()) {
        $nextPage = $pagerfanta->getNextPage();
        echo "<li class='page-item width-47'><a class='page-link' href='?pagina=$nextPage$url_get'>
        <span aria-hidden=\"true\">&raquo;</span>
        <span class=\"sr-only\">Próximo</span>
        </a></li>";
    }

    ?>
</ul>


<br><br><br>


<?php 
//incluindo sessão de compartilhamento
include('share-box.php');
require_once("footer.php"); //rodapé do site
?>