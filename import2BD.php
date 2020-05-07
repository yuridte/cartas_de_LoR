<?php
require_once("initBD.php"); //iniciando conexão com base de dados

//Connecting DB
$db = new DB($cfgHost, $cfgPort, $cfgDbName, $cfgUser, $cfgPassword);
$dbConn = $db->getConnection();

//Getting json with cards
$cards= json_decode(file_get_contents("lor-01.json"), true);

//preparando SQL
$sql = "";

foreach ($cards as $card) {
    
    //transform into variables
    extract($card);
    $sql .= "INSERT INTO cards (
        id, 
        cardCode, 
        name, 
        associatedCardRefs, 
        regionRef, 
        cost, 
        attack, 
        health, 
        description, 
        descriptionRaw, 
        levelupDescription, 
        levelupDescriptionRaw, 
        flavorText, 
        artistName, 
        keywordRefs, 
        spellSpeed, 
        spellSpeedRef, 
        rarity, 
        rarityRef, 
        subtype, 
        subtypes, 
        supertype, 
        type, 
        collectible, 
        timestamp) VALUES ";

    $sql .= "(";
    $sql .= "NULL, ";
    $sql .=  "'" . $cardCode . "', ";
    $sql .=  "'" . $name . "', ";
    //unindo array em string separada por um pipe |
    $associatedCardRefs = implode("|", $associatedCardRefs);
    $sql .=  "'" . $associatedCardRefs . "', ";
    $sql .=  "'" . $regionRef . "', ";
    $sql .=  "'" . $cost . "', ";
    $sql .=  "'" . $attack . "', ";
    $sql .=  "'" . $health . "', ";
    $sql .=  "'" . $description . "', ";
    $sql .=  "'" . $descriptionRaw . "', ";
    $sql .=  "'" . $levelupDescription . "', ";
    $sql .=  "'" . $levelupDescriptionRaw . "', ";
    $sql .=  "'" . $flavorText . "', ";
    $sql .=  "'" . $artistName . "', ";
    //unindo array em string separada por um pipe |
    $keywordRefs = implode("|", $keywordRefs);
    $sql .=  "'" . $keywordRefs . "', ";
    $sql .=  "'" . $spellSpeed . "', ";
    $sql .=  "'" . $spellSpeedRef . "', ";
    $sql .=  "'" . $rarity . "', ";
    $sql .=  "'" . $rarityRef . "', ";
    $sql .=  "'" . $subtype . "', ";
    //unindo array em string separada por um pipe |
    $subtypes = implode("|", $subtypes);
    $sql .=  "'" . $subtypes . "', ";
    $sql .=  "'" . $supertype . "', ";
    $sql .=  "'" . $type . "', ";
    if($collectible==false){ $sql .=  "0"; } else { $sql .=  "1"; }
    $sql .= ", CURRENT_TIMESTAMP); ";

    try {
        $dbConn->beginTransaction();
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $dbConn->commit();
        echo $cardCode . " ok<br/>";
    } catch (Exception $e) {
        //Roll back and show error
        $sql .=  "Error: " . $e->getMessage();
        $dbConn->rollBack();
    }

    $sql = "";

}

?>