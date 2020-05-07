<?php
require_once("vendor/autoload.php");

use MikeReinders\RuneTerraPHP\DeckEncoding;
// decodificando...
$deck = DeckEncoding::decode("CEBAIAICAMGRWMIHAECQOCQVC4RC6MICAEAQKKQBAEBASAQBAECQ6AQBAIDSA");
var_dump($deck);
//codificando de volta
$code = DeckEncoding::encode($deck);
echo var_dump($code);


// TESTE
// pegar string e gerar o código

$string_code = "01SI007_3,01IO013_3,01IO003_3,01IO027_3,01IO049_3,01SI010_3,01SI021_3,01SI023_3,01SI034_3,01SI047_3,01SI049_3,01SI042_2,01IO009_2,01SI015_1,01IO007_1,01IO032_1";
//dividindo por carta
$line = explode(",", $string_code);

//array onde o deck inteiro ficará armazenado
$array_deck = array();

foreach($line as $card){

    //dividindo por informação da carta
    $line_data = explode("_", $card);
    
    //criando array de cada item do deck
    $card = $line_data[0];
    $qt = (integer) $line_data[1];
    $array_line = array(0 => $card, 1 => $qt);

    //junto na variavel $array_deck
    array_push($array_deck, $array_line);
}
//mostrando resultado
var_dump($array_deck);

//codificando deck
$code = DeckEncoding::encode($array_deck);
echo var_dump($code);
