<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("vendor/autoload.php");
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

$cards= json_decode(file_get_contents("lor-01.json"), true);

$adapter = new ArrayAdapter($cards);
$pagerfanta = new Pagerfanta($adapter);

$pagerfanta->setMaxPerPage(10); // 10 by default

if(isset($_GET['pagina'])){
    $pagerfanta->setCurrentPage($_GET['pagina']); // 1 by default
}

$nbResults = $pagerfanta->getNbResults();
$currentPageResults = $pagerfanta->getCurrentPageResults();

foreach ($currentPageResults as $card) {
    echo $card['name'] . "<br/>";
    echo "<img width='150px' src='img/cards/" . $card['cardCode'] ."'/>";
    echo "<br/>";
}

?>