<?php 
require_once("vendor/autoload.php");
use MikeReinders\RuneTerraPHP\DeckEncoding;

if (isset($_GET['id_deck']) && isset($_GET['action'])) {

    require_once("check_sessao.php"); //check login
    require_once("initBD.php"); //iniciando conexão com base de dados

    //definindo ação
    switch ($_GET['action']) {
        case 'remover':
            //remover
            $sql = "DELETE FROM decks WHERE id = " . $_GET['id_deck'];

            try {
                //cadastrando deck
                $dbConn->beginTransaction();
                $stmt = $dbConn->prepare($sql);
                $stmt->execute();
                $dbConn->commit();
                header("Location:my-decks.php?msg=deck_removed");
            } catch (Exception $e) {
                //Roll back and show error
                $sql .=  "Error: " . $e->getMessage();
                $dbConn->rollBack();
            }

            break;

        case 'editar':
            //editar update
            $sql = "SELECT * FROM decks WHERE id LIKE " . $_GET['id_deck'];
            $deck_array = $dbConn->query($sql)->fetchAll();
            
            foreach ($deck_array as $deck) {
                require_once("header.php"); //cabeçalho do site
                ?>

                <div class="banner banner-deck-creator">
                    <h1>Editar Deck</h1>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 text-center">
                            <?php 
                            if (isset($_GET['msg'])) {
                                switch ($_GET['msg']) {

                                    case 'error_code':
                                        echo '<div class="alert alert-danger" role="alert">
                                                Erro! Código inválido.
                                            </div>';
                                        break;

                                    case 'error':
                                        echo '<div class="alert alert-danger" role="alert">
                                                Erro! Por favor tente novamente.
                                            </div>';
                                        break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="container  margem-top-80">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                        
                        <form action="action_deck.php?id_deck=<?php echo $_GET['id_deck']; ?>&action=update" method="post">
                            <input type="hidden" name="owner_id" id="owner_id" value="<?php echo $_COOKIE['id']; ?>"/>
                            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id_deck']; ?>"/>

                            <div class="form-group">
                                <label for="name">Título</label><br/>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $deck['name'] ?>"><br/><br/>
                            </div>

                            <div class="form-group">
                                <label for="code">Código</label><br/>
                                <input type="text" class="form-control" name="code" id="code" value="<?= $deck['code'] ?>"><br/><br/>
                            </div>

                            <div class="form-group">
                                <label for="code">Arquétipo</label><br/>
                                <select class="form-control" name="archetype" id="archetype">
                                    <option selected value="<?= $deck['archetype'] ?>"><?= $deck['archetype'] ?></option>
                                    <option value="indefinido">Não sei</option>
                                    <option value="agressivo">Agressivo (Aggro)</option>
                                    <option value="combo">Combo</option>
                                    <option value="controle">Controle</option>
                                    <option value="midrange">Midrange</option>
                                </select>
                                <br/><br/>
                            </div>

                            <div class="form-group">
                                <label for="tags">Adicione tags separadas por vírgula</label><br/>
                                <input type="text" class="form-control" name="tags" id="tags" value="<?= $deck['tags'] ?>"><br/><br/>
                            </div>

                            <div class="form-group">
                                <label for="description">Descrição</label><br/>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="7" placeholder="Opcional"><?= $deck['name'] ?></textarea>
                            </div>
                            
                            <br/><br/>

                            <input type="submit" class="btn btn-primary" value="SALVAR">
                        </form>

                        </div>
                    </div>
                </div>
                <?php
                require_once("footer.php"); //rodapé do site
            }

            break;

        case 'update':

            extract($_POST);

            // decodificando...
            try{
                $list_json = DeckEncoding::decode($code);
            } catch (Exception $e) {
                ?>
                <script type="text/javascript">
                    window.location.href = "action_deck.php?id_deck=<?= $id ?>&action=editar&msg=error_code";
                </script>
                <?php
                die("Código Inválido");
            }

            // sql identificando regiões
            $sql_regions = "SELECT DISTINCT regionRef FROM cards WHERE ";

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
            //tirando o último pipe
            $regions = substr($regions, 0, -1);


            $sql = "UPDATE decks SET name = '$name', code = '$code', tags = '$tags', description = '$description', list = '$list', regions = '$regions', last_update = CURRENT_TIMESTAMP, archetype = '$archetype' WHERE id = $id;";

            try {
                //cadastrando deck
                $dbConn->beginTransaction();
                $stmt = $dbConn->prepare($sql);
                $stmt->execute();
                $dbConn->commit();
                header("Location:my-decks.php?msg=deck_updated");
            } catch (Exception $e) {
                //Roll back and show error
                $sql .=  "Error: " . $e->getMessage();
                $dbConn->rollBack();
            }

            break;
        
        default:
            header("Location:my-decks.php");
            break;
    }
}else{
    header("Location:my-decks.php");
}
?>