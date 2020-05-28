<?php
require_once("check_sessao.php"); //check login
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>

<div class="banner banner-my-decks">
    <h1>Meu Perfil</h1>
</div>

<div class="container margem-top-80">
	<div class="row justify-content-md-center">
		<div class="col-md-7 profile-box">

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

			<?php 
			$sql = "SELECT * FROM user WHERE id LIKE '$_COOKIE[id]';";
			//colocando em array
	        $user_array = $dbConn->query($sql)->fetchAll();

	        //escrevendo os decks individualmente
	        foreach ($user_array as $user) {
	        	?>
	        	<h2>Dados</h2><br><br>
	        	<h3><?= $user['name']; ?></h3>
	        	<h3><?= $user['email']; ?></h3>
	        	<p><?= $user['description']; ?></p>

	        	<?php
	        }
			?>
			<br><br>
			<a href="my-profile-edit.php"><button class="btn btn-primary">EDITAR &rarr;</button></a>

		</div>
	</div>
</div>


<?php
require_once("footer.php"); //rodapé do site
?>