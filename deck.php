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
            ?>

            <div class="banner banner-deck-creator">
                <h1><?= $deck_info['name'] ?></h1>
            </div>

            <?php

            //extraindo dados do deck
            extract($deck_info);

            $list_array = explode("|", $list);
            foreach ($list_array as $item) {
                //separando os dados
                $item_array = explode("_", $item);
                ///Vamos procurar as cartas e separar por tipo
                if(isset($item_array[0])) : $cardCode = $item_array[0]; endif;
                if(isset($item_array[1])) : $qt = $item_array[1]; endif;
                $sql_card = "SELECT name, regionRef, type, supertype FROM cards WHERE cardCode LIKE '$cardCode'";
                $card_array = $dbConn->query($sql_card)->fetchAll();
                
                foreach ($card_array as $card_info) {

                    //incluindo o cardCode e a quantidade
                    $card_info['cardCode'] = $cardCode;
                    $card_info['qt'] = $qt;

                    if ($card_info['type'] == "Unidade") {
                        //alimentando array
                        array_push($units_array, $card_info);
                    }elseif ($card_info['type'] == "Feitiço") {
                        //alimentando array
                        array_push($spell_array, $card_info);
                    }

                }

            }
    
        }

        //EXIBINDO O DECK
        echo '<h1>Unidades</h1>';
        foreach ($units_array as $card) {
            echo $card['name'] . " - " . $card['qt'] . "<br>";
        }

        echo '<h1>Feitiços</h1>';
        foreach ($spell_array as $card) {
            echo $card['name'] . " - " . $card['qt'] . "<br>";
        }
    
        require_once("footer.php"); //rodapé do site
    }else{
        header("Location: deck-gallery.php");
    }
}else{
    header("Location: deck-gallery.php");
}
?>
