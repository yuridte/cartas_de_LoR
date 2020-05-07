<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

$cards= json_decode(file_get_contents("lor-01.json"), true);

$adapter = new ArrayAdapter($cards);
$pagerfanta = new Pagerfanta($adapter);

$pagerfanta->setMaxPerPage(20); // 10 by default

try {
    //code...
    if(isset($_GET['pagina'])){
        $pagerfanta->setCurrentPage($_GET['pagina']); // 1 by default
    }

    $nbResults = $pagerfanta->getNbResults();
    $currentPageResults = $pagerfanta->getCurrentPageResults();
    
    foreach ($currentPageResults as $card) {
        echo $card['name'] . "<br/>";
        echo "<img src='img/cards_medium_size/" . $card['cardCode'] ."-medium.png'/>";
        echo "<br/>";
    }
} catch (\Throwable $th) {
    //throw $th;
    echo "Erro 404";
}


?>