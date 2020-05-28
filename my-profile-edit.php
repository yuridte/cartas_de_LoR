<?php
require_once("check_sessao.php"); //check login
require_once("initBD.php"); //iniciando conexão com base de dados

if (isset($_POST['acao']) && $_POST['acao'] == "update"){
	extract($_POST);
	
	$msg = "";
	$sql = "UPDATE user SET ";
	
	if ($password != "" && $password == $confirmpassword) {
		# Atualiza tudo
		$password = md5($password);
		$sql .= " password = '$password', ";
	}elseif ($password != "" && $password != $confirmpassword) {
		# Atualiza tudo menos a senha e informa isso ao usuário
		$msg = "pwddiff";
	}

	$sql .= " name = '$name', email = '$email', description = '$description' WHERE id LIKE " . $_COOKIE['id'] . ";";

	try {
		//cadastrando deck
	    $dbConn->beginTransaction();
	    $stmt = $dbConn->prepare($sql);
	    $stmt->execute();
	    $dbConn->commit();

	    //atualizando os cookies
        setcookie("name",$name, strtotime( '+30 days' ));
        setcookie("email",$email, strtotime( '+30 days' ));
        setcookie("description",$description, strtotime( '+30 days' ));
	    
	    ?>
		<script type="text/javascript">
			// window.location.href = "my-profile.php?msg=update&msg2=<?= $msg; ?>";
		</script>
		<?php
	} catch (Exception $e) {
	    //Roll back and show error
	    $sql .=  "Error: " . $e->getMessage();
	    $dbConn->rollBack();
	    ?>
		<script type="text/javascript">
			// window.location.href = "my-profile.php?msg=update&msg2=<?= $msg; ?>";
		</script>
		<?php
	}
}

//chamando cabeçalho
require_once("header.php"); //cabeçalho do site
?>

<div class="banner banner-my-decks">
    <h1>Meu Perfil</h1>
</div>

<div class="container margem-top-80">
	<div class="row justify-content-md-center">
		<div class="col-md-7 profile-box">
			<form method="POST">
				<?php 
				$sql = "SELECT * FROM user WHERE id LIKE '$_COOKIE[id]';";
				//colocando em array
		        $user_array = $dbConn->query($sql)->fetchAll();

		        //escrevendo os decks individualmente
		        foreach ($user_array as $user) {
		        	?>
		        	<h2>EDITAR</h2><br><br>

		        	<!-- ENVIANDO O comando -->
		        	<input type="hidden" name="acao" value="update">

	                <div class="form-group">
	                    <label for="name">Nome</label>
	                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nomeHelp" placeholder="Digite seu nome" value="<?= $user['name'] ?>" required>
	                    <small id="nomeHelp" class="form-text text-muted">Como você deseja ser reconhecido</small>
	                </div>
	                <div class="form-group">
	                    <label for="email">E-mail</label>
	                    <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu e-mail" value="<?= $user['email'] ?>" required>
	                    <small id="emailHelp" class="form-text text-muted">Use um e-mail real para que seja possível recuperar sua senha</small>
	                </div>
	                <div class="form-group">
	                    <label for="password">Nova senha</label>
	                    <input type="password" name="password" id="password" class="form-control" aria-describedby="senhaHelp" placeholder="Senha">
	                    <small id="descricaoHelp" class="form-text text-muted">Deixe em branco para manter senha atual</small>
	                </div>
	                <div class="form-group">
	                    <label for="confirmpassword">Confirme a senha</label>
	                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" aria-describedby="senhaHelp" placeholder="Senha">
	                    <small id="senhaHelp" class="form-text text-muted">Deixe em branco para manter senha atual</small>
	                </div>
	                <div class="form-group">
	                    <label for="description">Descrição</label>
	                    <textarea name="description" id="description" class="form-control" rows="3" aria-describedby="descricaoHelp" placeholder="Opcional"><?= $user['description'] ?></textarea>
	                </div>
	                <input type="submit" class="btn btn-primary" value="ATUALIZAR">
		        	<?php
		        }
				?>
			</form>
		</div>
	</div>
</div>


<?php
require_once("footer.php"); //rodapé do site
?>