<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
?>

<div class="banner banner-deck-creator">
    <h1>Biblioteca de Decks</h1>
</div>

<div class="container margem-top-80 deck-list">
	<div class="row">

		<!-- LISTA DE DECKS -->
		<?php
        $sql = "SELECT * FROM decks ORDER BY last_update DESC;";
        //colocando em array
        $decks_by_time = $dbConn->query($sql)->fetchAll();

        //Paginando
        $adapter = new ArrayAdapter($decks_by_time);
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
            
            foreach ($currentPageResults as $deck) {

                $regions = explode("|", $deck['regions']);
                ?>

                <div class='col-md-3 text-center '>
                    <div class="deck-box-container">
                        <a href='deck.php?id=<?= $deck['id']; ?>'>
                            <div class="deck-box">
                                <div class="regions">
                                    <?php 
                                    foreach ($regions as $region) {
                                        echo '<img height="70px" title="' . $region . '" src="img/regions/hd/' . $region . '.png">';
                                    }
                                    ?>
                                    
                                </div>
                                <div class="letreiro">
                                    <span><?= $deck['name']; ?></span>
                                </div>
                            </div>
                        </a>
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

<?php
require_once("footer.php"); //rodapé do site
?>