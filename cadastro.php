<?php
require_once("header.php"); //cabeçalho do site
?>

<form action="cadastrar.php" method="post">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name">

    <label for="email">E-mail</label>
    <input type="text" name="email" id="email">

    <label for="password">Senha</label>
    <input type="password" name="password" id="password">

    <label for="description">Descrição</label>
    <textarea name="description" id="description" cols="30" rows="10" placeholder="Opcional"></textarea>

    <input type="submit" value="Cadastrar-se">
</form>

<?php
require_once("footer.php"); //rodapé do site
?>