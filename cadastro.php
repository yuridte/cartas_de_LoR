<?php
require_once("header.php"); //cabeçalho do site
?>
<div id="background-video" class="intern-pages-video-bg">
    <video autoplay loop autobuffer muted playsinline src="video/<?= $splash_video ?>" id="bg-video"></video>
</div>

<div class="container-fluid margem-top-150">
    <div class="row justify-content-md-center">
        <div class="col-md-6 cadastro-box">
            <h2>Cadastre-se</h2>

            <form action="cadastrar.php" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nomeHelp" placeholder="Digite seu nome">
                    <small id="nomeHelp" class="form-text text-muted">Como você deseja ser reconhecido</small>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="Digite seu e-mail">
                    <small id="emailHelp" class="form-text text-muted">Use um e-mail real para que seja possível recuperar sua senha</small>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" aria-describedby="senhaHelp" placeholder="Senha">
                    <small id="senhaHelp" class="form-text text-muted">Não escolha uma senha fácil de descobrir</small>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description" class="form-control" rows="5" aria-describedby="descricaoHelp" placeholder="Opcional"></textarea>
                    <small id="descricaoHelp" class="form-text text-muted">Fale um pouco sobre você respeitando os outros usuários e as regras de uso do site</small>
                </div>

                <input type="submit" class="btn btn-primary" value="Cadastrar-se">
            </form>

        </div>
    </div>
</div>

<?php
require_once("footer.php"); //rodapé do site
?>