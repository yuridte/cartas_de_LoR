<?php
require "vendor/autoload.php";
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

$cards= json_decode(file_get_contents("lor-01.json"), true);

$adapter = new ArrayAdapter($cards);
$pagerfanta = new Pagerfanta($adapter);

$pagerfanta->setMaxPerPage(10); // 10 by default
$pagerfanta->setCurrentPage(1); // 1 by default

$nbResults = $pagerfanta->getNbResults();
$currentPageResults = $pagerfanta->getCurrentPageResults();

foreach ($currentPageResults as $card) {
    echo $card['name'] . "<br/>";
    echo "<img width='150px' src='img/cards/" . $card['cardCode'] ."'/>";
    echo "<br/>";
}

?>