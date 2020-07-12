<?php
require_once("check_sessao.php"); //check login
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site

//selecionar usuários (perfil)
if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
}else{
    $user_id = 0;
}

$sql = "SELECT * FROM user WHERE id LIKE '" . $user_id . "';";

//colocando em array
$user_array = $dbConn->query($sql)->fetchAll();

$contador = count($user_array);
?>



<?php 
if ($contador == 0) {
?>
    <div class="banner banner-my-decks">
        <h1>Perfil</h1>
    </div>

    <div class="container margem-top-80">
        <div class="row justify-content-md-center">
            <div class='col-md-8 text-center'>
            <h2>Usuário não encontrado</h2><br>
            <div><a href='index.php'>Voltar para Home</a></div>
            </div>
        </div>
    </div>
<?php
}else{

    //escrevendo os decks individualmente
    foreach ($user_array as $user) {
    ?>

        <div class="banner banner-my-decks">
            <h1><?= $user['name']; ?></h1>
        </div>

        <div class="container profile-container margem-top-80">
            <div class="row justify-content-md-center">
                <div class="col-md-3 profile-box">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                if (isset($_GET['msg'])) {
                                    switch ($_GET['msg']) {
                                        case 'update':
                                            echo '<div class="alert alert-success" role="alert">
                                                    Atualizado com sucesso!
                                                </div>';
                                            break;

                                        case 'error':
                                            echo '<div class="alert alert-danger" role="alert">
                                                    Erro! Por favor tente novamente.
                                                </div>';
                                            break;
                                    }
                                }


                                if (isset($_GET['msg2'])) {
                                    switch ($_GET['msg2']) {
                                        case '':
                                            break;

                                        case 'pwddiff':
                                            echo '<div class="alert alert-danger" role="alert">
                                                    Não atualizamos sua senha pois você inseriu duas diferentes! Atualizamos as demais alterações.
                                                </div>';
                                            break;
                                    }
                                }
                                ?>

                                <h3><?= $user['name']; ?></h3>
                                <p><?= $user['description']; ?></p>

                                <br><br>
                                <?php 
                                if (isset($_COOKIE['id']) && $_COOKIE['id'] == $user_id) {
                                ?>
                                    <a href="my-profile-edit.php"><button class="btn btn-primary">EDITAR &rarr;</button></a>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="container">
                        <div class="row">
                        <!-- LISTA DE DECKS -->
                        <?php
                        $sql = "SELECT * FROM decks WHERE owner_id LIKE '$user_id' ORDER BY last_update DESC;";
                        
                        //colocando em array
                        $decks_by_time = $dbConn->query($sql)->fetchAll();

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
                                                    echo '<img height="50px" title="' . $region . '" src="img/regions/vanilla/icon-' . $region . '.png">';
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
                </div>
            <?php
            }
        }
        ?>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>