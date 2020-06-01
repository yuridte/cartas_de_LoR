<?php
require_once("check_sessao.php"); //check login
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("vendor/autoload.php");
use MikeReinders\RuneTerraPHP\DeckEncoding;

extract($_POST);

// sql identificando regiões
$sql_regions = "SELECT DISTINCT regionRef FROM cards WHERE ";

// decodificando...
try{
    $list_json = DeckEncoding::decode($code);
} catch (Exception $e) {
    ?>
    <script type="text/javascript">
        window.location.href = "cadastro_deck.php?msg=error_code";
    </script>
    <?php
    die("Código Inválido");
}

$list = "";
foreach ($list_json as $list_item) {
    $list .= $list_item['0'] . "_" . $list_item[1] . "|";
    $sql_regions .= " cardCode LIKE '$list_item[0]' OR ";
}

$sql_regions .= "cardCode LIKE '9999999999' ORDER BY name ASC;";
//colocando em array as regiões
$regions = "";
$array_regions = $dbConn->query($sql_regions)->fetchAll();
foreach ($array_regions as $region_individual) {
    $regions .= "$region_individual[0]|";
}
//tirando última |
$regions = substr($regions, 0, -1);

//substituir caracteres especiais
$chars_velhos = array("'", '"', "?");
$chars_novos = array("&#39;", "&quot;", "&#63;");
$name  = str_replace($chars_velhos, $chars_novos, $name);
$description  = str_replace($chars_velhos, $chars_novos, $description);

$sql = "INSERT INTO decks (id, name, owner_id, code, description, tags, rating, list, regions, timestamp, last_update, archetype) VALUES (NULL, '$name', '$owner_id', '$code', '$description', '$tags', '0', '$list', '$regions', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$archetype');";
echo $sql;
try {
	//cadastrando deck
    $dbConn->beginTransaction();
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $dbConn->commit();
    header("Location:my-decks.php?msg=deck_created");
} catch (Exception $e) {
    //Roll back and show error
    $sql .=  "Error: " . $e->getMessage();
    $dbConn->rollBack();
}
