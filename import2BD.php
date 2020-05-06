<?php
$cards= json_decode(file_get_contents("lor-01.json"), true);

$i = 1;

foreach ($cards as $card) {
    echo $card['name'] . "<br/>";
    echo "<br/>";
    if ($i == 2) {
        break;  
    }
    $i++;
}
?>