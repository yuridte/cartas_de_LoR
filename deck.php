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
        $champions_array = array();
        $units_array = array();
        $spell_array = array();
        
        foreach ($deck as $deck_info) {
            ?>

            <div class="banner banner-deck-creator">
                <h1><?= $deck_info['name'] ?></h1>
            </div>

            <script type="text/javascript">
                // Mudando o title
                var title_topo_atual = document.title;
                document.title = "Deck - <?= $deck_info['name'] ?> - " + title_topo_atual;
            </script>

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
                $sql_card = "SELECT name, cost, regionRef, type, supertype FROM cards WHERE cardCode LIKE '$cardCode'";
                $card_array = $dbConn->query($sql_card)->fetchAll();

                foreach ($card_array as $card_info) {

                    //incluindo o cardCode e a quantidade
                    $card_info['cardCode'] = $cardCode;
                    $card_info['qt'] = $qt;

                    if ($card_info['supertype'] == "Campeão") {
                        //alimentando array
                        array_push($champions_array, $card_info);
                    }elseif ($card_info['type'] == "Unidade") {
                        //alimentando array
                        array_push($units_array, $card_info);
                    }elseif ($card_info['type'] == "Feitiço") {
                        //alimentando array
                        array_push($spell_array, $card_info);
                    }

                    //curva de mana
                    $custo = $card_info['cost'];
                    for ($i=1; $i <= $qt ; $i++) { 
                        $curva[$custo] = $i;
                    }

                }

            }
    
        }

        // echo $curva[0] . "<br>";
        // echo $curva[1] . "<br>";
        // echo $curva[2] . "<br>";
        // echo $curva[3] . "<br>";
        // echo $curva[4] . "<br>";
        // echo $curva[5] . "<br>";
        // echo $curva[6] . "<br>";
        // echo $curva[7] . "<br>";
        // echo $curva[8] . "<br>";
        // echo $curva[9] . "<br>";
        // echo $curva[10] . "<br>";
        // echo $curva[11] . "<br>";
        // echo $curva[12] . "<br>";

        ?>

<div class="container margem-top-80 deck-lista">
    <div class="row deck_session">
        <?php 
        if(isset($_COOKIE['id']) && $deck_info['owner_id'] == $_COOKIE['id']){
        ?>
        
        <div class="col-md-12 text-center box-acao">
            <a href="action_deck.php?id_deck=<?= $id ?>&action=editar"><button class="btn btn-success">Editar</button></a>
            <a onclick="deleteDeck()"><button class="btn btn-danger">Remover</button></a>
        </div>

        <script type="text/javascript">
            function deleteDeck() {
                var ask = window.confirm("Tem certeza que quer apagar seu deck?");
                if (ask) {
                    window.location.href = "action_deck.php?id_deck=<?= $id ?>&action=remover";
                }
            }
        </script>

        <?php 
        }
        ?>

        <div class="col-md-4 text-center">
            <h2>REGIÕES</h2>

            <?php 
            $regions = explode("|", $deck_info['regions']);
            foreach ($regions as $region) {
                echo '<img height="130px" title="' . $region . '" src="img/regions/hd/' . $region . '.png">';
            }
            ?>
        </div>

        <div class="col-md-4">
            <h2>Descrição</h2>
            <?php 
            $data_criacao = date('d/m/Y H:i',strtotime($deck_info['timestamp']));
            $data_ultima_atualizacao = date('d/m/Y H:i',strtotime($deck_info['last_update']));
             ?>
            <div class="datas_criacao_atualizacao">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Criado em: <?= $data_criacao ?><br>
                Atualizado em: <?= $data_ultima_atualizacao ?>        
            </div>

            <?php 
            // Pesquisando nome do criador
            $sql_user = "SELECT name FROM user WHERE id LIKE '" . $deck_info['owner_id'] . "';";
            //colocando em array
            $user_array = $dbConn->query($sql_user)->fetchAll();

            //escrevendo os decks individualmente
            foreach ($user_array as $user) {
                ?>
                <h3><b>Criador: </b> <i><?= $user['name']; ?></i></h3>
                <?php
            }
            ?>

            <p><?= $deck_info['description'] ?></p>
        </div>

        <div class="col-md-4 deck-code-box">
            <h2>Código do Deck</h2>
            <p><?= $deck_info['code'] ?></p>
            <button class="btn btn-primary" id="copyButton" onclick="copy_deck()">COPIAR</button>

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#copyButton').click(function () { 
                        copyToClipboard("<?= $deck_info['code'] ?>"); 
                    });

                    function copyToClipboard(text) {
                        var $temp = $("<input>");
                        $("body").append($temp);
                        $temp.val(text).select();
                        document.execCommand("copy");
                        $temp.remove();
                        alert("Código copiado com sucesso!");
                    }
                });
            </script>

        </div>
    </div>

    <div class="row deck_session list-deck-session">

        <div class="col-md-4">
            <?php
            //EXIBINDO O DECK
            echo '<h2>Campeões</h2>';

            foreach ($champions_array as $card) {
                ?>
                <a href='card.php?cardCode=<?= $card['cardCode']; ?>'>
                <div class='card-item' style='background-image: url("img/cards_small_size/<?= $card['cardCode']; ?>-full.jpg");'>
                    <?= $card['qt']; ?>x <?= $card['name']; ?><br>
                </div>
                <img src="img/cards_medium_size/<?= $card['cardCode']; ?>-medium.png">
                </a>
            <?php
            }
            ?>
        </div>

        <div class="col-md-4">
            <?php
            //EXIBINDO O DECK
            echo '<h2>Unidades</h2>';

            foreach ($units_array as $card) {
                ?>
                <a href='card.php?cardCode=<?= $card['cardCode']; ?>'>
                <div class='card-item' style='background-image: url("img/cards_small_size/<?= $card['cardCode']; ?>-full.jpg");'>
                    <?= $card['qt']; ?>x <?= $card['name']; ?><br>
                </div>
                <img src="img/cards_medium_size/<?= $card['cardCode']; ?>-medium.png">
                </a>
            <?php
            }
            ?>
        </div>

        <div class="col-md-4">
            <?php
            echo '<h2>Spells</h2>';

            foreach ($spell_array as $card) {
                ?>
                <a href='card.php?cardCode=<?= $card['cardCode']; ?>'>
                <div class='card-item' style='background-image: url("img/cards_small_size/<?= $card['cardCode']; ?>-full.jpg");'>
                    <?= $card['qt']; ?>x <?= $card['name']; ?><br>
                </div>
                <img src="img/cards_medium_size/<?= $card['cardCode']; ?>-medium.png">
                </a>
            <?php
            }
            ?>
        </div>


    </div>

    <div class="row deck_session">
        <div class="col-md-4 text-center">
            <h2>ARQUÉTIPO</h2>

            <?php  
            switch ($deck_info['archetype']) {
                case 'agressivo':
                    echo '<h3><i class="fas fa-fire-alt"></i> ' . $deck_info['archetype'] . '</h3>';
                    break;

                case 'combo':
                    echo '<h3><i class="fas fa-ruler-combined"></i> ' . $deck_info['archetype'] . '</h3>';
                    break;

                case 'controle':
                    echo '<h3><i class="fas fa-fire-extinguisher"></i> ' . $deck_info['archetype'] . '</h3>';
                    break;

                case 'midrange':
                    echo '<h3><i class="fas fa-align-center"></i> ' . $deck_info['archetype'] . '</h3>';
                    break;
                
                default:
                    echo '<h3><i class="fas fa-question-circle"></i> Indefinido</h3>';
                    break;
            }
            ?>
            
        </div>

        <div class="col-md-4 box-tags">
            <h2>Tags</h2>
            <?php 
            $tags = explode(",", $deck_info['tags']);
            
            foreach ($tags as $tag) {
                if ($tag != "") {
                    echo "<div class='tag'>" . $tag . "</div>";
                }
            }

            ?>
        </div>

        <div class="col-md-4 text-center">
            <h2>Curva de mana</h2>

            <p><i>EM BREVE!</i></p>
        </div>
    </div>
</div>

<?php 
//incluindo sessão de compartilhamento
require_once('share-box.php');
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="fb-root"></div>
            <meta property="fb:app_id" content="183960886382685" />
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=183960886382685&autoLogAppEvents=1" nonce="HptluutG"></script>
            <div class="fb-comments" data-order-by="reverse_time" data-href="<?= $url_atual ?>" data-colorscheme="dark" data-numposts="5" data-width="100%"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".list-deck-session a").hover(function(){
            $(this).find("img").show();
        }, function(){
            $(this).find("img").hide();
        });
    });
</script>

        <?php
        require_once("footer.php"); //rodapé do site
    }else{
        header("Location: deck-gallery.php");
    }
}else{
    header("Location: deck-gallery.php");
}
?>
