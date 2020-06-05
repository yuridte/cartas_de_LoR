<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php");
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
?>

<script type="text/javascript" src="js/filtro_front.js"></script>

<div class="banner banner-galeria-cartas">
    <h1>Galeria de Cartas</h1>
</div>
<div class="container container-padrao">
    <div class="row">
        <div class="col-md-12 filter-button">
            <button data-toggle="collapse" href="#filter-box" class="btn btn-primary"><i class="fas fa-filter"></i>&nbsp;FILTRAR</button>
        </div>
        <div class="col-md-12 collapse" id="filter-box">
            <form method="GET">
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nome da carta">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="type">
                            <option selected value="">Tipo</option>
                            <option value="">Todos</option>
                            <option value="Unidade">Unidade</option>
                            <option value="Feitiço">Feitiço</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="subtype">
                            <option selected value="">Tribo</option>
                            <option value="ARANHA">Aranha</option>
                            <option value="ELITE">Elite</option>
                            <option value="PORO">Poro</option>
                            <option value="YETI">Yeti</option>
                            <option value="ELNUK">Elnuk</option>
                            <option value="MONSTRO MARINHO">Monstro Marinho</option>
                            <!-- <option value="TESOURO">Tesouro</option>
                            <option value="Tecnológico">Tecnológico</option> -->
                        </select>
                    </div>
                    <div class="col-md-6 filtro_regioes_galeria text-center">
                        <h2>Regiões</h2>
                        <span><img class="filtro_regiao inativo" id="Bilgewater" title="Águas de Sentina" src="img/regions/icon/bilgewater_crest_icon.png"></span>
                        <span><img class="filtro_regiao inativo" id="Demacia" title="Demacia" src="img/regions/icon/demacia_crest_icon.png"></span>
                        <span><img class="filtro_regiao inativo" id="Freljord" title="Freljord" src="img/regions/icon/freljord_crest_icon.png"></span>
                        <span><img class="filtro_regiao inativo" id="Ionia" title="Ionia" src="img/regions/icon/ionia_crest_icon.png"></span>
                        <span><img class="filtro_regiao inativo" id="Noxus" title="Noxus" src="img/regions/icon/noxus_crest_icon.png"></span>
                        <span><img class="filtro_regiao inativo" id="PiltoverZaun" title="Piltover & Zaun" src="img/regions/icon/piltover_crest_icon.png"></span>
                        <span><img class="filtro_regiao inativo" id="ShadowIsles" title="Ilhas das Sombras" src="img/regions/icon/shadow_isles_crest_icon.png"></span>

                        <input type="hidden" name="regionRef" id="regionRef" value="">
                    </div>
                    <div class="col-md-6 filtro_raridades_galeria text-center">
                        <h2>Raridade</h2>
                        <!-- <span><img class="filtro_raridade inativo" id="All" title="Todas" src="img/rarity/all.png"></span> -->
                        <span><img class="filtro_raridade inativo" id="Common" title="Comum" src="img/rarity/common.png"></span>
                        <span><img class="filtro_raridade inativo" id="Rare" title="Rara" src="img/rarity/rare.png"></span>
                        <span><img class="filtro_raridade inativo" id="Epic" title="Épica" src="img/rarity/epic.png"></span>
                        <span><img class="filtro_raridade inativo" id="Champion" title="Campeão" src="img/rarity/champion.png"></span>

                        <input type="hidden" name="rarityRef" id="rarityRef" value="">
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </div>
            </form>
        </div>
        <?php
        //Preparando consulta a banco de dados
        $sql = "SELECT name, cardCode FROM cards WHERE ";
        //Preparando paginação com os filtros
        $url_get = "&";
        //colocar os filtros
        //
        if(isset($_GET['name']) && $_GET['name'] != ""){
            $sql .= "name LIKE '%" . $_GET['name'] . "%' AND ";
            $url_get .= "name=".$_GET['name'] . "&";
        }
        if(isset($_GET['regionRef']) && $_GET['regionRef'] != ""){
            //separando regiões selecionadas
            $regioes = explode("_", $_GET['regionRef']);
            $regiao_url = ""; // vamos armazenar as regioes separadas por underline para a paginação
            $sql .= "(";
            foreach ($regioes as $regiao) {
                $sql .= " regionRef = '" . $regiao . "' OR";
                $regiao_url .= $regiao . "_";
            }
            $sql = substr($sql, 0, -2); //retirando o último OR
            $sql .= ") AND ";
            $regiao_url = substr($regiao_url, 0, -1); //retirando o último underline
            $url_get .= "regionRef=" . $regiao_url . "&";
        }
        if(isset($_GET['type']) && $_GET['type'] != ""){
            $sql .= "type LIKE '%" . $_GET['type'] . "%' AND ";
            $url_get .= "type=".$_GET['type'] . "&";
        }
        if(isset($_GET['rarityRef']) && $_GET['rarityRef'] != ""){
            $raridades = explode("_", $_GET['rarityRef']);
            $raridade_url = ""; // vamos armazenar as raridades separadas por underline para a paginação
            $sql .= "(";
            foreach ($raridades as $raridade) {
                $sql .= " rarityRef = '" . $raridade . "' OR";
                $raridade_url .= $raridade . "_";
            }
            $sql = substr($sql, 0, -2); //retirando o último OR
            $sql .= ") AND ";
            $raridade_url = substr($raridade_url, 0, -1); //retirando o último underline
            $url_get .= "rarityRef=" . $raridade_url . "&";
        }
        if(isset($_GET['subtype']) && $_GET['subtype'] != ""){
            $sql .= "subtype LIKE '%" . $_GET['subtype'] . "%' AND ";
            $url_get .= "subtype=".$_GET['subtype'] . "&";
        }
        if(isset($_GET['keywordRefs']) && $_GET['keywordRefs'] != ""){
            $sql .= "keywordRefs LIKE '%" . $_GET['keywordRefs'] . "%' AND ";
            $url_get .= "keywordRefs=".$_GET['keywordRefs'] . "&";
        }
        if(isset($_GET['cost']) && $_GET['cost'] != ""){
            $sql .= "cost LIKE '" . $_GET['cost'] . "' AND ";
            $url_get .= "cost=".$_GET['cost'] . "&";
        }
        if(isset($_GET['attack']) && $_GET['attack'] != ""){
            $sql .= "attack LIKE '" . $_GET['attack'] . "' AND ";
            $url_get .= "attack=".$_GET['attack'] . "&";
        }
        if(isset($_GET['health']) && $_GET['health'] != ""){
            $sql .= "health LIKE '" . $_GET['health'] . "' AND ";
            $url_get .= "health=".$_GET['health'] . "&";
        }

        //finalizando SQL
        $sql .= " collectible LIKE 1 ORDER BY cost ASC, name ASC;";
        //colocando em array
        $cards_by_name = $dbConn->query($sql)->fetchAll();

        //Paginando
        $adapter = new ArrayAdapter($cards_by_name);
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
            
            foreach ($currentPageResults as $card) {
                echo "<div class='col-md-3 carta-link'>";
                echo "<a href=card.php?cardCode=" . $card['cardCode'] . ">";
                echo "<img src='img/cards_medium_size/" . $card['cardCode'] ."-medium.png'/>";
                echo "</a>";
                echo "</div>";
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
require_once("footer.php");
?>