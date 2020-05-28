<?php
require_once("check_sessao.php"); //check login
require_once("initBD.php"); //iniciando conexão com base de dados
require_once("header.php"); //cabeçalho do site
?>

<div class="banner banner-my-decks">
    <h1>Meus Decks</h1>
</div>

<div class="container margem-top-80">
	<div class="row">
		<div class="col-md-4">
			<!-- 
				IMPORTAR DECK
			-->
			Importar
		</div>

		<!-- LISTA DE DECKS -->
		<?php 
		$sql = "SELECT * FROM decks WHERE owner_id LIKE '$_COOKIE[id]' ORDER BY timestamp DESC;";
		//colocando em array
        $decks_by_time = $dbConn->query($sql)->fetchAll();

        //escrevendo os decks individualmente
        foreach ($decks_by_time as $deck) {
        	echo "<div class='col-md-4'>";
        	echo "<a href='deck.php?id=$deck[id]'>";
        	echo $deck['name'];
        	echo "</a>";
        	echo "</div>";
        }
		?>
	</div>
</div>


<?php
require_once("footer.php"); //rodapé do site
?>