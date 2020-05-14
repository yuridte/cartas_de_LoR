<?php
if(isset($_GET['id'])){
    require_once("initBD.php"); //iniciando conexão com base de dados
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM decks WHERE id LIKE '$id';";
    $deck = $dbConn->query($sql)->fetchAll();
    
    $contador = count($deck);
    if ($contador == 1) {
        require_once("header.php"); //cabeçalho do site

        //iniciando variáveis para armazenar as unidades e spell separadamente
        $units_array = array();
        $spell_array = array();
        
        foreach ($deck as $deck_info) {
            //extraindo dados do deck
            extract($deck_info);

            $list_array = explode("|", $list);
            foreach ($list_array as $item) {
                //separando os dados
                $item_array = explode("_", $item);
                ///Vamos procurar as cartas e separar por tipo
                $cardCode = $item_array[0];
                $sql_card = "SELECT name, regionRef, type, supertype FROM cards WHERE cardCode LIKE '$cardCode'";
                $card_array = $dbConn->query($sql_card)->fetchAll();
                
                foreach ($card_array as $card_info) {
                    if ($card_info['type'] == "Unidade") {
                        array_push($units_array, $card_info);
                    }elseif ($card_info['type'] == "Feitiço") {
                        array_push($spell_array, $card_info);
                    }
                }

            }
    
        }

        //continuar daqui
        var_dump($units_array[0]);
        var_dump($spell_array[0]);
    
        require_once("footer.php"); //rodapé do site
    }else{
        header("Location: deck-gallery.php");
    }
}else{
    header("Location: deck-gallery.php");
}
?>
