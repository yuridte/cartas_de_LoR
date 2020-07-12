<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
?>

<script type="text/javascript" src="js/filtro_front.js"></script>
<script type="text/javascript">
    // Mudando o title
    var title_topo_atual = document.title;
    document.title = "Decks - " + title_topo_atual;
</script>

<div class="banner banner-deck-creator">
    <h1>Biblioteca de Decks</h1>
</div>

<div class="container container-padrao">
    <div class="row">

        <div class="col-md-12">
            <button data-toggle="collapse" href="#filter-box" class="btn btn-primary"><i class="fas fa-filter"></i>&nbsp;FILTRAR</button>
        </div>
        <div class="col-md-12 collapse" id="filter-box">
            <form method="GET">
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="word" id="word" placeholder="Procurar na descrição ou nas tags">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="archetype">
                            <option selected value="">Arquétipo</option>
                            <option value="">Todos</option>
                            <option value="agressivo">Agressivo</option>
                            <option value="combo">Combo</option>
                            <option value="controle">Controle</option>
                            <option value="midrange">Midrange</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="champion">
                            <option selected value="">Escolha um Campeão</option>
                            <option value="">Todos</option>
                            <?php
                            $sql_champions = "SELECT name, cardCode FROM cards WHERE supertype LIKE 'Campeão' AND collectible LIKE '1' ORDER BY name ASC;";
                            $champions = $dbConn->query($sql_champions)->fetchAll();
                            foreach ($champions as $champion) {
                                echo "<option value='" . $champion['cardCode'] . "'>" . $champion['name'] . "</option>";
                            }
                            ?>
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

                        <input type="hidden" name="region" id="regionRef" value="">
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="container deck-list">
	<div class="row">

		<!-- LISTA DE DECKS -->
		<?php
        $sql = "SELECT * FROM decks WHERE ";

        if(isset($_GET['champion']) && $_GET['champion'] != ''){
            $sql .= " list LIKE '%" . $_GET['champion'] . "%' AND ";
        }
        if(isset($_GET['archetype']) && $_GET['archetype'] != ''){
            $sql .= " archetype LIKE '%" . $_GET['archetype'] . "%' AND ";
        }
        if(isset($_GET['region']) && $_GET['region'] != ''){
            $regioes = explode("_", $_GET['region']);
            foreach ($regioes as $regiao) {
                if ($regiao != ""){
                    $sql .= " regions LIKE '%" . $regiao . "%' AND ";
                }
            }
        }
        if(isset($_GET['word']) && $_GET['word'] != ''){
            $sql .= " description LIKE '%" . $_GET['word'] . "%' OR tags LIKE '%" . $_GET['word'] . "%' OR name LIKE '%" . $_GET['word'] . "%' AND ";
        }

        $sql .= " id NOT LIKE '0' ORDER BY last_update DESC;";
        
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
                                        echo '<img height="60px" title="' . $region . '" src="img/regions/vanilla/icon-' . $region . '.png">';
                                    }
                                    ?>
                                    
                                </div>

                                <div class="letreiro">
                                    <span><?= $deck['name']; ?></span>

                                    <?php 
                                    $sql_user = "SELECT name FROM user WHERE id LIKE '" . $deck['owner_id'] . "';";
                                    //colocando em array
                                    $user_array = $dbConn->query($sql_user)->fetchAll();

                                    //escrevendo os decks individualmente
                                    foreach ($user_array as $user) {
                                        ?>
                                        <h3><i><?= $user['name']; ?></i></h3>
                                        <?php
                                    }
                                    $data_ultima_atualizacao = date('d/m/Y H:i',strtotime($deck['last_update']));
                                    ?>
                                    <h3><i><?= $data_ultima_atualizacao; ?></i></h3>
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