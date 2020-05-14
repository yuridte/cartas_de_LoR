<?php
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("vendor/autoload.php");
use MikeReinders\RuneTerraPHP\DeckEncoding;

extract($_POST);

// decodificando...
$list_json = DeckEncoding::decode($code);
$list = "";
foreach ($list_json as $list_item) {
    $list .= $list_item['0'] . "_" . $list_item[1] . "|";
}

//substituir caracteres especiais
$chars_velhos = array("'", '"', "?");
$chars_novos = array("&#39;", "&quot;", "&#63;");
$name  = str_replace($chars_velhos, $chars_novos, $name);
$description  = str_replace($chars_velhos, $chars_novos, $description);

$sql = "INSERT INTO decks (id, name, owner_id, code, description, tags, rating, list, timestamp) VALUES (NULL, '$name', '$owner_id', '$code', '$description', '$tags', '0', '$list', CURRENT_TIMESTAMP);";
echo $sql;
try {
    $dbConn->beginTransaction();
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $dbConn->commit();
    echo "ok";
} catch (Exception $e) {
    //Roll back and show error
    $sql .=  "Error: " . $e->getMessage();
    $dbConn->rollBack();
}