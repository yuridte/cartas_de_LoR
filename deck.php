<?php
if(isset($_GET['id'])){
    require_once("initBD.php"); //iniciando conexão com base de dados
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM decks WHERE id LIKE '$id';";
    $deck = $dbConn->query($sql)->fetchAll();
    
    $contador = count($deck);
    if ($contador == 1) {
        require_once("header.php"); //cabeçalho do site
        
        foreach ($deck as $deck_info) {
            //extraindo dados do deck
            extract($deck_info);

            $list_array = explode("|", $list);
            foreach ($list_array as $item) {
                $item_array = explode("_", $item);
                
                $sql_card = "SELECT * FROM cards"
                
                echo $item_array[0] . "<br>";
            }
    
        }
    
        require_once("footer.php"); //rodapé do site
    }else{
        header("Location: deck-gallery.php");
    }
}else{
    header("Location: deck-gallery.php");
}
?>
