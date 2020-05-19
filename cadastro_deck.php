<?php
require_once("header.php"); //cabeçalho do site
require_once("check_sessao.php"); //check login
?>

<form action="cadastrar_deck.php" method="post">
    <input type="hidden" name="owner_id" id="owner_id" value="<?php echo $_COOKIE['id']; ?>"/>

    <label for="name">Título</label><br/>
    <input type="text" name="name" id="name"><br/><br/>

    <label for="code">Código</label><br/>
    <input type="text" name="code" id="code"><br/><br/>

    <label for="tags">Adicione tags separadas por vírgula</label><br/>
    <input type="text" name="tags" id="tags"><br/><br/>

    <label for="description">Descrição</label><br/>
    <textarea name="description" id="description" cols="30" rows="10" placeholder="Opcional"></textarea><br/><br/>

    <input type="submit" value="Cadastrar-se">
</form>

<?php
require_once("footer.php"); //rodapé do site
?>