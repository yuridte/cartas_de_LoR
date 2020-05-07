<?php 
require_once("initBD.php"); //iniciando conexão com base de dados

if(isset($_GET['cardCode'])) {
    //Preparando consulta a banco de dados
    $cardCode = $_GET['cardCode'];
    $sql = "SELECT * FROM cards WHERE cardCode LIKE '$cardCode';";
    $card = $dbConn->query($sql)->fetchAll();

    foreach ($card as $card_info) {
        extract($card_info);
        echo $name . "<br/>";
        echo "<img src='img/cards_medium_size/" . $cardCode ."-medium.png'/>";
    }

}else{

    //redirecionar para home
    //Erro 404
    
}
?>