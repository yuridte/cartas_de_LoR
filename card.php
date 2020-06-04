<?php 
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php");

if(isset($_GET['cardCode'])) {
    //Preparando consulta a banco de dados
    $cardCode = $_GET['cardCode'];
    $sql = "SELECT * FROM cards WHERE cardCode LIKE '$cardCode';";
    $card = $dbConn->query($sql)->fetchAll();

    foreach ($card as $card_info) {
        extract($card_info);
        ?>

        <div class="banner banner-carta" style="background-image: url('img/cards_medium_size/<?= $cardCode ?>-full-medium.png');">
            <h1><?= $name ?></h1>
        </div>

        <div class="container container-padrao">
            <div class="row justify-content-center">
                <div class="col-md-5 text-center">
                    <img src='img/cards_medium_size/<?= $cardCode ?>-medium.png'/>
                </div>  
                <div class="col-md-7 info-grid">
                    <table>
                        <tr>
                            <td><b>Região: </b></td>
                            <td>
                                <?php 
                                switch ($regionRef) {
                                    case 'Bilgewater':
                                        echo "<img src='img/regions/icon/bilgewater_crest_icon.png' alt='Águas de Sentina'> Águas de Sentina";
                                        break;

                                    case 'Demacia':
                                        echo "<img src='img/regions/icon/demacia_crest_icon.png' alt='Demacia'> Demacia";
                                        break;

                                    case 'Freljord':
                                        echo "<img src='img/regions/icon/freljord_crest_icon.png' alt='Freljord'> Freljord";
                                        break;

                                    case 'Ionia':
                                        echo "<img src='img/regions/icon/ionia_crest_icon.png' alt='Ionia'> Ionia";
                                        break;

                                    case 'Noxus':
                                        echo "<img src='img/regions/icon/noxus_crest_icon.png' alt='Noxus'> Noxus";
                                        break;

                                    case 'PiltoverZaun':
                                        echo "<img src='img/regions/icon/piltover_crest_icon.png' alt='Piltover & Zaun'> Piltover & Zaun";
                                        break;

                                    case 'ShadowIsles':
                                        echo "<img src='img/regions/icon/shadow_isles_crest_icon.png' alt='Ilhas das Sombras'> Ilhas das Sombras";
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tipo: </b></td>
                            <td> <?= $type ?></td>
                        </tr>
                        <?php 
                        if ($type == "Feitiço") {
                        ?>
                        <tr>
                            <td><b>Velocidade do Feitiço: </b></td>
                            <td> 
                                <?php 
                                switch ($spellSpeed) {
                                    case 'Súbito':
                                        echo "<img src='img/keywords/Keyword_Burst.png' alt='Súbito'> ".$spellSpeed;
                                        break;

                                    case 'Rápido':
                                        echo "<img src='img/keywords/Keyword_Fast.png' alt='Rápido'> ".$spellSpeed;
                                        break;

                                    case 'Lento':
                                        echo "<img src='img/keywords/Keyword_Slow.png' alt='Lento'> ".$spellSpeed;
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                         ?>
                        <tr>
                            <td><b>Custo: </b></td>
                            <td> <?= $cost ?></td>
                        </tr>

                        <?php 
                        if ($type == "Unidade") {
                        ?>
                        <tr>
                            <td><b>Ataque: </b></td>
                            <td> <?= $attack ?></td>
                        </tr>
                        <tr>
                            <td><b>Vida: </b></td>
                            <td> <?= $health ?></td>
                        </tr>
                        <?php 
                        }
                        ?>
                        <tr>
                            <td><b>Raridade: </b></td>
                            <td> 
                                <?php 
                                switch ($rarityRef) {
                                    case 'Common':
                                        echo "<img src='img/rarity/common.png' alt='Comum'> Comum";
                                        break;

                                    case 'Rare':
                                        echo "<img src='img/rarity/rare.png' alt='Rara'> Rara";
                                        break;

                                    case 'Epic':
                                        echo "<img src='img/rarity/epic.png' alt='Épica'> Épica";
                                        break;

                                    case 'Champion':
                                        echo "<img src='img/rarity/champion.png' alt='Campeão'> Campeão";
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Descrição: </b></td>
                            <td> <?= $description ?></td>
                        </tr>
                        <tr>
                            <td><b>Arte: </b></td>
                            <td>
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal">Ver arte</button>

                                <!-- Trigger the modal with a button -->
                                <a href="img/cards/<?= $cardCode ?>-full.png" download="img/cards/<?= $cardCode ?>-full.png"><button type="button" class="btn btn-danger btn-md">Baixar wallpaper HD</button></a>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Artista: </b></td>
                            <td> <?= $artistName ?></td>
                        </tr>
                        <tr>
                            <td><b>Texto da arte: </b></td>
                            <td> <?= $flavorText ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-10 text-center">
                    



                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <img src="img/cards_medium_size/<?= $cardCode ?>-full-medium.png">
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal -->

        <!-- Cartas relacionadas  -->
        <?php if ($associatedCardRefs != "") { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 related-cards">
                    <h2>Cartas relacionadas</h2>
                </div>
                    <?php
                    //
                    // cr = Card Relacionado
                    //
                    $cartas_relacionadas = explode("|", $associatedCardRefs);

                    foreach ($cartas_relacionadas as $cr) {
                        $sql_cr = "SELECT * FROM cards WHERE cardCode LIKE '$cr';";

                        $cr = $dbConn->query($sql_cr)->fetchAll();
                        foreach ($cr as $cr_info) {
                            extract($cr_info);
                            ?>

                            <div class="col-md-5 text-center">
                                <img src='img/cards_medium_size/<?= $cardCode ?>-medium.png'/>
                            </div>  
                            <div class="col-md-7 info-grid">
                                <table>
                                    <tr>
                                        <td><b>Região: </b></td>
                                        <td>
                                            <?php 
                                            switch ($regionRef) {
                                                case 'Bilgewater':
                                                    echo "<img src='img/regions/icon/bilgewater_crest_icon.png' alt='Águas de Sentina'> Águas de Sentina";
                                                    break;

                                                case 'Demacia':
                                                    echo "<img src='img/regions/icon/demacia_crest_icon.png' alt='Demacia'> Demacia";
                                                    break;

                                                case 'Freljord':
                                                    echo "<img src='img/regions/icon/freljord_crest_icon.png' alt='Freljord'> Freljord";
                                                    break;

                                                case 'Ionia':
                                                    echo "<img src='img/regions/icon/ionia_crest_icon.png' alt='Ionia'> Ionia";
                                                    break;

                                                case 'Noxus':
                                                    echo "<img src='img/regions/icon/noxus_crest_icon.png' alt='Noxus'> Noxus";
                                                    break;

                                                case 'PiltoverZaun':
                                                    echo "<img src='img/regions/icon/piltover_crest_icon.png' alt='Piltover & Zaun'> Piltover & Zaun";
                                                    break;

                                                case 'ShadowIsles':
                                                    echo "<img src='img/regions/icon/shadow_isles_crest_icon.png' alt='Ilhas das Sombras'> Ilhas das Sombras";
                                                    break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Tipo: </b></td>
                                        <td> <?= $type ?></td>
                                    </tr>
                                    <?php 
                                    if ($type == "Feitiço") {
                                    ?>
                                    <tr>
                                        <td><b>Velocidade do Feitiço: </b></td>
                                        <td> 
                                            <?php 
                                            switch ($spellSpeed) {
                                                case 'Súbito':
                                                    echo "<img src='img/keywords/Keyword_Burst.png' alt='Súbito'> ".$spellSpeed;
                                                    break;

                                                case 'Rápido':
                                                    echo "<img src='img/keywords/Keyword_Fast.png' alt='Rápido'> ".$spellSpeed;
                                                    break;

                                                case 'Lento':
                                                    echo "<img src='img/keywords/Keyword_Slow.png' alt='Lento'> ".$spellSpeed;
                                                    break;
                                                
                                                default:
                                                    # code...
                                                    break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                     ?>
                                    <tr>
                                        <td><b>Custo: </b></td>
                                        <td> <?= $cost ?></td>
                                    </tr>

                                    <?php 
                                    if ($type == "Unidade") {
                                    ?>
                                    <tr>
                                        <td><b>Ataque: </b></td>
                                        <td> <?= $attack ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Vida: </b></td>
                                        <td> <?= $health ?></td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                    <!-- <tr>
                                        <td><b>Raridade: </b></td>
                                        <td> 
                                            <?php 
                                            switch ($rarityRef) {
                                                case 'Common':
                                                    echo "<img src='img/rarity/common.png' alt='Comum'> Comum";
                                                    break;

                                                case 'Rare':
                                                    echo "<img src='img/rarity/rare.png' alt='Rara'> Rara";
                                                    break;

                                                case 'Epic':
                                                    echo "<img src='img/rarity/epic.png' alt='Épica'> Épica";
                                                    break;

                                                case 'Champion':
                                                    echo "<img src='img/rarity/champion.png' alt='Campeão'> Campeão";
                                                    break;
                                                
                                                default:
                                                    # code...
                                                    break;
                                            }
                                             ?>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td><b>Descrição: </b></td>
                                        <td> <?= $description ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Arte: </b></td>
                                        <td>
                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#c<?= $cardCode; ?>">Ver arte</button>

                                            <!-- Trigger the modal with a button -->
                                            <a href="img/cards/<?= $cardCode ?>-full.png" download="img/cards/<?= $cardCode ?>-full.png"><button type="button" class="btn btn-danger btn-md">Baixar wallpaper HD</button></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Artista: </b></td>
                                        <td> <?= $artistName ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Texto da arte: </b></td>
                                        <td> <?= $flavorText ?></td>
                                    </tr>
                                </table>
                            </div>   

                            <!-- Modal -->
                            <div id="c<?= $cardCode; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <img src="img/cards_medium_size/<?= $cardCode ?>-full-medium.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fim Modal -->

                            <div class="col-md-12 separador-cards">
                                <hr>
                            </div>


                            <?php
                        }

                    }

                    ?>

            </div>
        </div>
        <!-- FIM cartas relacionadas -->
        <?php } 

        
        //incluindo sessão de compartilhamento
        require_once('share-box.php');
        ?>

    <?php
    }
}else{
    //redirecionar para home
    //Erro 404
}

require_once("footer.php");
?>