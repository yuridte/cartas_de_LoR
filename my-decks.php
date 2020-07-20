<?php
require_once("check_sessao.php"); //check login
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>

<div class="banner banner-my-decks">
    <h1>Meus Decks</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 text-center">
            <?php 
            if (isset($_GET['msg'])) {
                switch ($_GET['msg']) {
                    case 'deck_created':
                        echo '<div class="alert alert-success" role="alert">
                                Deck criado com sucesso!
                            </div>';
                        break;

                    case 'deck_removed':
                        echo '<div class="alert alert-success" role="alert">
                                Deck excluído com sucesso!
                            </div>';
                        break;

                    case 'deck_updated':
                        echo '<div class="alert alert-success" role="alert">
                                Deck atualizado com sucesso!
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

<div class="container margem-top-80 deck-list">
	<div class="row">
		<div class="col-md-3 text-center" id="import-box">
            <div class="importar-deck">
                <a href='cadastro_deck.php'>
                    <img src="img/plus.png"><br><br>
        			<!-- IMPORTAR DECK -->
                    Importar Deck
                </a>
            </div>
		</div>

		<!-- LISTA DE DECKS -->
		<?php 
		$sql = "SELECT * FROM decks WHERE owner_id LIKE '$_COOKIE[id]' ORDER BY last_update DESC;";
		//colocando em array
        $decks_by_time = $dbConn->query($sql)->fetchAll();

        //escrevendo os decks individualmente
        foreach ($decks_by_time as $deck) {
            $regions = explode("|", $deck['regions']);
            ?>

            <div class='col-md-3 text-center '>
                <div class="deck-box-container">
                    <a href='deck.php?id=<?= $deck['id']; ?>'>
                        <div class="deck-box">
                            <div class="regions">
                                <?php 
                                foreach ($regions as $region) {
                                    echo '<img height="60px" title="' . $region . '" src="img/regions/vanilla/icon-' . $region . '.png">';
                                }
                                ?>
                                
                            </div>

                            <div class="letreiro">
                                <span><?= $deck['name']; ?></span>

                                <?php 
                                $sql_user = "SELECT name FROM user WHERE id LIKE '" . $deck['owner_id'] . "';";
                                //colocando em array
                                $user_array = $dbConn->query($sql_user)->fetchAll();

                                //escrevendo os decks individualmente
                                foreach ($user_array as $user) {
                                    ?>
                                    <h3><i><?= $user['name']; ?></i></h3>
                                    <?php
                                }
                                $data_ultima_atualizacao = date('d/m/Y H:i',strtotime($deck['last_update']));
                                ?>
                                <h3><i><?= $data_ultima_atualizacao; ?></i></h3>

                            </div>
                        </div>
                    </a>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>