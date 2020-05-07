<?php 
require_once("cfg.php");
require_once("class/db-class.php");

$db = new DB($cfgHost, $cfgPort, $cfgDbName, $cfgUser, $cfgPassword);
$dbConn = $db->getConnection();


if(isset($_GET['cardCode'])) {

    $cards = json_decode(file_get_contents("lor-01.json"), true);

    $results = array_filter($cards, function($filter) {
        return $filter['cardCode'] == $_GET['cardCode'];
    });

    foreach ($results as $key => $value) {
        echo $value['name'] . "<br/>";
        foreach($value['assets'] as $assets){
            echo $assets['gameAbsolutePath'] . "<br/>";
        }
        echo "<img width='200px' src='img/cards/" . $value['cardCode'] ."'/>";
    }

}else{

    //redirecionar para home
    
}
?>