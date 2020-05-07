<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

//Preparando consulta a banco de dados
$sql = "SELECT name, cardCode FROM cards WHERE collectible LIKE 1 ORDER BY name ASC;";
$cards_by_name = $dbConn->query($sql)->fetchAll();

//Paginando
$adapter = new ArrayAdapter($cards_by_name);
$pagerfanta = new Pagerfanta($adapter);

$pagerfanta->setMaxPerPage(20); // 10 by default

try {
    if(isset($_GET['pagina'])){
        $pagerfanta->setCurrentPage($_GET['pagina']); // 1 by default
    }

    $currentPageResults = $pagerfanta->getCurrentPageResults();
    
    foreach ($currentPageResults as $card) {
        echo $card['name'] . "<br/>";
        echo "<a href=card.php?cardCode=" . $card['cardCode'] . ">";
        echo "<img src='img/cards_medium_size/" . $card['cardCode'] ."-medium.png'/>";
        echo "</a>";
        echo "<br/>";
    }
} catch (\Throwable $th) {
    echo "Erro 404";
}


//links para cada página
if ($pagerfanta->hasPreviousPage()) {
    $previousPage = $pagerfanta->getPreviousPage();
    echo "<a href='?pagina=$previousPage'>Página anterior</a>";
}

$nbPages = $pagerfanta->getNbPages();
for ($pagina=1; $pagina <= $nbPages; $pagina++) { 
    if ($pagina == $_GET['pagina']) {
        echo $pagina;
    } else {
        echo "<a href='?pagina=$pagina'>$pagina</a>";
    }    
}

if ($pagerfanta->hasNextPage()) {
    $nextPage = $pagerfanta->getNextPage();
    echo "<a href='?pagina=$nextPage'>Próxima página</a>";
}

?>